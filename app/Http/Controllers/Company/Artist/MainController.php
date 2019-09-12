<?php

namespace App\Http\Controllers\Company\Artist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use PragmaRX\Countries\Package\Countries;
use Carbon\Carbon;
use App\Artist;
use App\ArtistPermitDocument;
use App\ArtistPermit;
use App\Permit;
use Auth;
use Excel;
use Yajra\Datatables\Datatables;
use App\Requirement;
use App\Company;
use App\PermitType;
use App\Language;
use App\Religion;
use App\Emirates;
use App\Areas;
use App\VisaType;
use App\ArtistTempData;
use App\ArtistTempDocument;
use Intervention\Image\ImageManagerStatic as Image;

class MainController extends Controller
{

    public function index()
    {
        return view('permits.artist.index');
    }

    // Artist Permit Dashboard Table One

    public function fetch_applied_artists()
    {

        $permits = Permit::with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', '!=', 'expired')->get();
        //->has('artistPermitDocument')

        return Datatables::of($permits)->editColumn('created_at', function ($permits) {
            if ($permits->created_at) {
                return  $permits->created_at;
            } else {
                // return 'none';
            }
        })->editColumn('issued_date', function ($permits) {
            if ($permits->issued_date) {
                return  Carbon::parse($permits->issued_date)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->editColumn('expired_date', function ($permits) {
            if ($permits->expired_date) {
                return  Carbon::parse($permits->expired_date)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->addColumn('action', function ($permit) {
            if ($permit->permit_status == 'approved') {
                return '<a href="' . route('company.make_payment', $permit->permit_id) . '"  title="Payments"><span class="kt-badge kt-badge--success kt-badge--inline">Payment</span></a>';
            } else if ($permit->permit_status == 'pending') {
                return '<span onClick="cancel_permit(' . $permit->permit_id . ',\'' . $permit->permit_number . '\')" data-toggle="modal" data-target="#cancel_permit" class="kt-badge kt-badge--danger kt-badge--inline">Cancel</span';
            } else if ($permit->permit_status == 'edit') {
                return '<a href="edit_permit/' . $permit->permit_id . '"><span class="kt-badge kt-badge--warning kt-badge--inline">Edit </span></a>';
            } else if ($permit->permit_status == 'rejected') {
                return '<span onClick="rejected_permit(' . $permit->permit_id . ')" data-toggle="modal" data-target="#rejected_permit" class="kt-badge kt-badge--info kt-badge--inline">Rejected</span>';
            } else if ($permit->permit_status == 'cancelled') {
                return '<span onClick="show_cancelled(' . $permit->permit_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="kt-badge kt-badge--info kt-badge--inline">Cancelled</span>';
            }
        })->addColumn('permit_status', function ($permit) {
            return  $permit->permit_status;
        })->addColumn('details', function ($permit) {
            return '<a href="' . route('company.get_permit_details', $permit->permit_id) . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    public function get_permit_details($id)
    {
        // $data_bundle['permit_number'] = $id;
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.permitType', 'artistPermit.artistPermitDocument')->where('permit_id', $id)->first();
        return view('permits.artist.view_details', $data_bundle);
    }

    // Artist Permit Dashboard Table Two

    public function fetch_existing_artists()
    {
        $permits = Permit::with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', 'active')->get();

        return Datatables::of($permits)->editColumn('created_at', function ($permits) {
            if ($permits->created_at) {
                return $permits->created_at;
            } else {
                // return 'none';
            }
        })->editColumn('issued_date', function ($permits) {
            if ($permits->issued_date) {
                return Carbon::parse($permits->issued_date)->format('d-M-Y');
            } else {
                return 'none';
            }
        })->editColumn('expired_date', function ($permits) {
            if ($permits->expired_date) {
                return Carbon::parse($permits->expired_date)->format('d-M-Y');
            } else {
                return 'none';
            }
        })->addColumn('action', function ($permit) {
            $issued_date = strtotime($permit->issued_date);
            $expired_date = strtotime($permit->expired_date);
            $today = strtotime(date('Y-m-d 00:00:00'));
            $diff = abs($today - $issued_date) / 60 / 60 / 24;
            $expDiff = abs($today - $expired_date) / 60 / 60 / 24;
            $amendBtn = ($diff <= 10) ? '<a href="' . route('company.amend_permit', $permit->permit_id) . '" title="Amend"><span  class="kt-badge kt-badge--warning kt-badge--inline kt-margin-b-5">Amend</span></a>&nbsp;'
                : '';
            $renewBtn = ($expDiff <= 2) ? '<a href="' . route('company.renew_permit', $permit->permit_id) . '" title="Renew"><span  class="kt-badge kt-badge--success kt-badge--inline">Renew</span></a>' : '';
            return $amendBtn . $renewBtn;
        })->addColumn('details', function ($permit) {
            return '<a href="' . route('company.get_permit_details', $permit->permit_id) . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    // Function for Excel Export

    public function export_applied_artist_permits()
    {

        $permits = Permit::latest();
        $permits->with('artist', 'artistPermit')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', '!=', 'expired')->get();

        return Excel::create('Export', function ($excel) use ($permits) {
            $excel->setTitle('Export');
            $excel->sheet('Sheet 1', function ($sheet) use ($permits) {
                $sheet->setOrientation('landscape');
                $sheet->appendRow(['Permit No.', 'From Date', 'To Date', 'Work Location', 'Applied On']);
                $permits->chunk(500, function ($fs) use ($sheet) {
                    foreach ($fs as $f) {
                        $row = [];
                        $row[] = $f->permit_number;
                        $row[] = $f->issued_date ? Carbon::parse($f->issued_date)->format('d-m-Y') : '';
                        $row[] = $f->expired_date ? Carbon::parse($f->expired_date)->format('d-m-Y') : '';
                        $row[] = $f->work_location;
                        $row[] = $f->created_at ? $f->created_at->format('d-m-Y') : '';
                        $sheet->appendRow($row);
                    }
                });
            });
        })->download('xlsx');
    }

    public function export_existing_artist_permits()
    {
        $permits = Permit::latest();
        $permits->with('artist', 'artistPermit')->where('company_id', Auth::user()->EmpClientId)->where('permit_status',  'expired')->get();

        return Excel::create('Export', function ($excel) use ($permits) {
            $excel->setTitle('Export');
            $excel->sheet('Sheet 1', function ($sheet) use ($permits) {
                $sheet->setOrientation('landscape');
                $sheet->appendRow(['Permit No.', 'From Date', 'To Date', 'Work Location', 'Applied On']);
                $permits->chunk(500, function ($fs) use ($sheet) {
                    foreach ($fs as $f) {
                        $row = [];
                        $row[] = $f->permit_number;
                        $row[] = $f->issued_date ? Carbon::parse($f->issued_date)->format('d-m-Y') : '';
                        $row[] = $f->expired_date ? Carbon::parse($f->expired_date)->format('d-m-Y') : '';
                        $row[] = $f->work_location;
                        $row[] = $f->created_at ? $f->created_at->format('d-m-Y') : '';
                        $sheet->appendRow($row);
                    }
                });
            });
        })->download('xlsx');
    }


    // To Fetch Artist Details

    public function fetch_artist_temp_data(Request $request)
    {
        // $artist_id = $request->artist_id;
        // $artist_permit_id = $request->artist_permit_id;
        $id = $request->artist_temp_id;
        // $artists = ArtistPermit::with('artist',  'permit', 'permitType', 'artistPermitDocument')->where('permit_id', $id)->get();
        // $artists = ArtistPermit::with('artist', 'permit', 'artistPermitDocument', 'permitType')->where('artist_permit_id', $artist_permit_id)->first();
        $artists = ArtistTempData::with('artistPermitDocument', 'permitType')->where('id', $id)->first();
        return $artists;
    }

    // Show Cancelled Reason

    public function show_cancelled(Request $request)
    {
        $id = $request->id;
        $artists = Permit::where('permit_id', $id)->get();
        return $artists;
    }

    // To Cancel Permit Popup Submit

    public function cancel_permit(Request $request)
    {
        $insval = array(
            'cancel_reason' => $request->input('cancel_reason'),
            'updated_by' => Auth::user()->user_id,
            'permit_status' => 'cancelled'
        );
        $id = $request->input('permit_id');
        $result = Permit::where('permit_id', $id)->update($insval);
        $message = $result ? ['success', 'Permit Cancelled successfully ', 'Success'] : ['error', 'Error, Please Try Again', 'Error'];
        return redirect('company/artist_permits')->with('message', $message);
    }

    // To Apply New Permit Page

    public function create()
    {
        $code =  $this->generatePersonCode();
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('demonym')->sort();
        $data_bundle['visatypes'] = VisaType::all();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['areas'] = Areas::all();
        return view('permits.artist.new.create', $data_bundle);
    }


    public function uploadDocuments(Request $request)
    {
        $name = str_replace(" ", "_", $request->reqName);
        $number = $request->artistNo;
        if ($request->id == 0) {
            $file = $request->file('pic_file');
            $ext = $file->getClientOriginalExtension();
            $fileName = $request->file('pic_file')->getClientOriginalName();

            $original = 'original';
            $path  = Storage::putFileAs('files/' . $number . '/' . $original, $request->files->get('pic_file'), $fileName);
            $thumbImg = Image::make($request->file('pic_file')->getRealPath());
            $thumbImg->resize(300, 200,  function ($constraint) {
                $constraint->aspectRatio();
            });
            Storage::makeDirectory('files/' . $number . '/thumb');
            $thumbPath = storage_path() . '/app/files/' . $number . '/thumb/' . $fileName;
            $thumbImg->save($thumbPath);
            $thumbSavedPath = 'files/' . $number . '/thumb/' . $fileName;
            session([$number . '_pic_file' => $path, $number . '_ext' => $ext, $number . '_thumb_file' => $thumbSavedPath]);
        } else {
            $file = $request->files->get('doc_file_' . $request->id);
            $ext = $request->files->get('doc_file_' . $request->id)->getClientOriginalExtension();
            $path  = Storage::putFileAs('files/' . $number, $request->files->get('doc_file_' . $request->id), $name);
            session([$number . '_doc_file_' . $request->id => $path, $number . '_ext_' . $request->id => $ext]);
        }
        return json_encode($file);
    }

    public function deleteDocuments(Request $request)
    {
        $req = str_replace(" ", "_", $request->reqName);
        // dd('files/' . $request->artistNo . '/' . $req);
        $status = Storage::delete('files/' . $request->artistNo . '/' . $req);
        return $status;
    }

    public function generatePermitNumber()
    {
        $last_permit_d = Permit::latest()->first();
        if (empty($last_permit_d)) {
            $new_permit_no = sprintf("AP%04d",  1);
        } else {
            $last_pn = $last_permit_d->permit_number;
            $n = substr($last_pn, 2);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_permit_no = sprintf("AP%0" . $x . "d", $n + 1);
        }
        return $new_permit_no;
    }

    public function generateReferenceNumber()
    {
        $last_permit_d = Permit::latest()->first();
        if (empty($last_permit_d)) {
            $new_refer_no = sprintf("RNA%04d",  1);
        } else {
            $last_rn = $last_permit_d->reference_number;
            $n = substr($last_rn, 3);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_refer_no = sprintf("RNA%0" . $x . "d", $n + 1);
        }

        return $new_refer_no;
    }

    public function store(Request $request)
    {

        $permitDetails = json_decode($request->permitD, true);
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);

        $new_permit_no = $this->generatePermitNumber();
        $new_refer_no = $this->generateReferenceNumber();

        $permit = Permit::create([
            'work_location' => $permitDetails['workLocation'],
            'issued_date' => $permitDetails['fromDate'] ? Carbon::parse($permitDetails['fromDate'])->toDateString() : '',
            'expired_date' => $permitDetails['toDate'] ? Carbon::parse($permitDetails['toDate'])->toDateString() : '',
            'permit_number' => $new_permit_no,
            'reference_number' => $new_refer_no,
            'permit_status' => 'pending',
            'request_type' => 'new',
            'user_id' => Auth::user()->user_id,
            'created_by' => Auth::user()->user_id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'company_id' => Auth::user()->EmpClientId
        ]);


        for ($i = 1; $i <= count($artistDetails); $i++) {

            $is_old = $artistDetails[$i]['is_old_artist'];

            if ($is_old == 2) {
                Artist::where('person_code', $artistDetails[$i]['code'])->update([
                    'firstname_en' => $artistDetails[$i]['fname_en'],
                    'firstname_ar' => $artistDetails[$i]['fname_ar'],
                    'lastname_en' => $artistDetails[$i]['lname_en'],
                    'lastname_ar' => $artistDetails[$i]['lname_ar'],
                    'nationality' => $artistDetails[$i]['nationality'],
                    'gender' => $artistDetails[$i]['gender'],
                    'birthdate' => $artistDetails[$i]['dob'] ? Carbon::parse($artistDetails[$i]['dob'])->toDateString() : '',
                    'artist_status' => 'active',
                    'updated_by' => Auth::user()->user_id,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);

                $artist = Artist::where('person_code', $artistDetails[$i]['code'])->first();
            } else {

                $code =  $this->generatePersonCode();

                $artist = Artist::create([
                    'person_code' => $code,
                    'firstname_en' => $artistDetails[$i]['fname_en'],
                    'firstname_ar' => $artistDetails[$i]['fname_ar'],
                    'lastname_en' => $artistDetails[$i]['lname_en'],
                    'lastname_ar' => $artistDetails[$i]['lname_ar'],
                    'nationality' => $artistDetails[$i]['nationality'],
                    'gender' => $artistDetails[$i]['gender'],
                    'birthdate' => $artistDetails[$i]['dob'] ? Carbon::parse($artistDetails[$i]['dob'])->toDateString() : '',
                    'artist_status' => 'active',
                    'updated_by' => Auth::user()->user_id,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'created_by' => Auth::user()->user_id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                ]);
            }

            $company_array = Company::find(Auth::user()->EmpClientId);
            $company_name = str_replace(' ', '_', $company_array->company_name);
            $company_name = strtolower($company_name);

            $pic_ext = session($i . '_ext');

            if (Storage::exists(session($i . '_pic_file'))) {

                $check_path = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/photos';

                if (Storage::exists($check_path)) {
                    $file_count = count(Storage::files($check_path));
                    $file_nos = $file_count / 2;
                    $next_file_no = $file_nos + 1;
                } else {
                    $next_file_no = 1;
                }

                $newPath = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
                $newPathLink = $company_name . '/artist_permit/' . $artist->artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
                $newThumbPath = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;
                $newThumbPathLink = $company_name . '/artist_permit/' . $artist->artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;

                Storage::move(session($i . '_pic_file'), $newPath);
                Storage::move(session($i . '_thumb_file'), $newThumbPath);

                session()->forget([$i . '_pic_file', $i . '_thumb_file', $i . '_ext']);
            } else {
                $getArtistPics = ArtistPermit::where('artist_id', $artist->artist_id)->latest()->first();
                $newPathLink = $getArtistPics->original;
                $newThumbPathLink = $getArtistPics->thumbnail;
            }

            $artistPermit = ArtistPermit::create([
                'artist_permit_status' => 'active',
                'artist_id' => $artist->artist_id,
                'permit_id' => $permit->permit_id,
                'created_at' => Carbon::now()->toDateTimeString(),
                'permit_type_id' => $artistDetails[$i]['profession'],
                'original' => $newPathLink,
                'thumbnail' => $newThumbPathLink,
                'passport_number' => $artistDetails[$i]['passport'],
                'uid_number' => $artistDetails[$i]['uidNumber'],
                'uid_expire_date' => $artistDetails[$i]['uidExp'] ? Carbon::parse($artistDetails[$i]['uidExp'])->toDateString() : '',
                'passport_expire_date' => $artistDetails[$i]['ppExp'] ? Carbon::parse($artistDetails[$i]['ppExp'])->toDateString() : '',
                'visa_type' => $artistDetails[$i]['visaType'],
                'visa_number' => $artistDetails[$i]['visaNumber'],
                'visa_expire_date' => $artistDetails[$i]['visaExp'] ? Carbon::parse($artistDetails[$i]['visaExp'])->toDateString() : '',
                'sponsor_name_en' => $artistDetails[$i]['spName'],
                'language' => $artistDetails[$i]['language'],
                'religion' => $artistDetails[$i]['religion'],
                'city' => $artistDetails[$i]['city'],
                'fax_number' => $artistDetails[$i]['fax_no'],
                'po_box' => $artistDetails[$i]['po_box'],
                'area' => $artistDetails[$i]['area'],
                'address_en' => $artistDetails[$i]['address'],
                'mobile_number' => $artistDetails[$i]['mobile'],
                'phone_number' => $artistDetails[$i]['landline'],
                'email' => $artistDetails[$i]['email'],
                'emirates_id' => $artistDetails[$i]['idNo']
            ]);

            $requirements = Requirement::where('requirement_type', 'artist')->get();
            $requirement_names = [];
            foreach ($requirements as $req) {
                array_push($requirement_names, $req->requirement_name);
            }
            $total = $requirements->count();

            for ($j = 1; $j <= $total; $j++) {
                if (Storage::exists(session($i . '_doc_file_' . $j))) {

                    $ext = session($i . '_ext_' . $j);

                    $check_path = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id;

                    if (Storage::exists($check_path)) {
                        $file_count = count(Storage::files($check_path));
                        $next_file_no = $file_count + 1;
                    } else {
                        $next_file_no = $j;
                    }

                    $newPath = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/document_' . $next_file_no . '.' . $ext;
                    $newPathLink = $company_name . '/artist_permit/' . $artist->artist_id . '/document_' . $next_file_no . '.' . $ext;

                    Storage::move(session($i . '_doc_file_' . $j), $newPath);
                    Storage::delete(session($i . '_doc_file_' . $j));

                    session()->forget([$i . '_doc_file_' . $j, $i . '_ext_' . $j]);
                } else {
                    $artistsD = ArtistPermitDocument::where('artist_permit_id', $artistDetails[$i]['id'])->latest()->first();
                    $newPathLink = $artistsD->path;
                }

                ArtistPermitDocument::create([
                    'issued_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'artist_permit_id' => $artistPermit->artist_permit_id,
                    'path' =>  $newPathLink,
                    'document_name' => $requirement_names[$j - 1],
                    'status' => 'active'
                ]);
            }
        }

        if ($permit) {
            $result = ['success', 'Permit Applied Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function clear_the_temp()
    {
        Storage::deleteDirectory('files');
    }

    function generatePersonCode()
    {

        $last_person_code = Artist::orderBy('artist_id', 'desc')->value('person_code');

        if ($last_person_code == null) {
            $code = 2000;
        } else {
            $code = $last_person_code + 1;
        }

        // call the same function if the barcode exists already
        if ($this->personCodeExists($code)) {
            return $this->generatePersonCode();
        }

        // otherwise, it's valid and can be used
        return $code;
    }

    function personCodeExists($code)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Artist::where('person_code', $code)->exists();
    }


    // fetch files uploaded

    public function get_files_uploaded(Request $request)
    {
        $permit_id = $request->artist_permit;
        $reqName =  $request->reqName;
        $artist_documents = ArtistPermitDocument::where('artist_permit_id', $permit_id)->where('document_name', $reqName)->orderBy('created_at', 'desc')->get();
        return $artist_documents;
    }

    public function get_files_uploaded_with_code($code)
    {
        $artist_documents = Artist::with('artistPermit')->where('person_code', $code)->get();
        return $artist_documents;
    }

    public function delete_uploaded_file(Request $request)
    {
        $req = str_replace(" ", "_", $request->reqName);
        // dd('files/' . $request->artistNo . '/' . $req);
        $status = Storage::delete('files/' . $request->artistNo . '/' . $req);
        return $status;
    }

    public function add_artist_to_permit($id, $from)
    {
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('demonym')->sort();
        $data_bundle['visatypes'] = VisaType::all();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['areas'] = Areas::all();
        $data_bundle['permit_details'] = Permit::with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('permit_id', $id)->first();
        $data_bundle['permit_id'] = $id;
        $data_bundle['from'] = $from;
        return view('permits.artist.add_artist_to_permit', $data_bundle);
    }

    /* Drafts Functions */

    public function insert_artist_data_into_drafts(Request $request)
    {
        $compID = Auth::user()->EmpClientId;
        $companyHasDraft = companyArtistDraft::where('companyID', $compID)->count();

        switch ($request->step) {
            case 2:
                $ppty = 'stepOne';
                break;
            case 3:
                $ppty = 'stepTwo';
                break;
            case 4:
                $ppty = 'stepThree';
                break;
            default:
                $ppty = '';
                break;
        }

        $lastDraftRow = companyArtistDraft::latest()->first();

        if ($lastDraftRow != null) {
            $lastReferNo = $lastDraftRow->value('referNo');
            $newReferNo = 'RF' . sprintf("%05d", $lastReferNo + 1);
        } else {
            $newReferNo = 'RF' . sprintf("%05d", 1);
        }

        if ($companyHasDraft == 0) {
            companyArtistDraft::create([
                $ppty => $request->data,
                'section' => $request->section,
                'referNo' => $newReferNo,
                'companyID' => $compID,
                'userId' => Auth::user()->user_id,
                'created_at' => Carbon::now()->toDateTimeString()
            ]);
        } else {
            companyArtistDraft::where('companyID', $compID)->update([
                $ppty => $request->data,
                'section' => $request->section,
                'referNo' => $newReferNo,
                'companyID' => $compID,
                'userId' => Auth::user()->user_id,
                'updated_at' => Carbon::now()->toDateTimeString()
            ]);
        }
    }


    public function fetch_artist_data_from_drafts()
    {
        $compID = Auth::user()->EmpClientId;
        $userID = Auth::user()->user_id;
        $draftData = companyArtistDraft::where('companyID', $compID)->where('userId', $userID)->latest()->first();

        return $draftData;
    }

    /* End Drafts Function*/


    /* Helper functions */

    public function fetch_areas($id)
    {
        $areas = Areas::where('emirates_id', $id)->get();
        return $areas;
    }

    public function searchCode($id)
    {
        $artist_d = Artist::with('artistPermit', 'artistPermit.artistPermitDocument')->where('person_code', $id)->first();
        return $artist_d;
    }

    public function download_file(Request $request)
    {
        $permit_no = $request->artist_permit;
        $doc_name = $request->name;

        $filePath = ArtistPermitDocument::where('document_name', $doc_name)->where('artist_permit_id', $permit_no)->value('path');

        // dd(url('storage/' . $filePath));

        $headers = array(
            'Content-Type: image/jpeg , image/png , application/pdf',
        );

        // return Response::download(url('storage/' . $filePath));
        // return response()->download(url('storage/' . $filePath));
        return Storage::download(url('storage/' . $filePath), 'download', $headers);
        // return response()->download(storage_path('app/' . $filePath));
    }

    public function fetch_artist_details(Request $request)
    {
        $ap_id = $request->ap_id;
        $artistPermitDetails = ArtistPermit::with('artist', 'permitType', 'artistPermitDocument')->where('artist_permit_id', $ap_id)->first();
        return $artistPermitDetails;
    }

    public function get_files_by_artist_permit_id(Request $request)
    {
        $artist_permit_id = $request->artist_permit_id;
        $reqName =  $request->reqName;
        $artist_documents = ArtistPermitDocument::where('artist_permit_id', $artist_permit_id)->where('document_name', $reqName)->orderBy('created_at', 'desc')->get();
        return $artist_documents;
    }

    public function get_photo_by_artist_permit_id($artist_permit_id)
    {
        $artist_documents = ArtistPermit::where('artist_permit_id', $artist_permit_id)->get();
        return $artist_documents;
    }



    // Temp Data functions

    public function delete_artist(Request $request)
    {
        $from = $request->del_artist_from;
        $permit_id = $request->del_permit_id;
        $artist_permit_id = $request->del_artist_permit_id;
        // Artistpermit::where('artist_permit_id', $artist_permit_id)->update(['artist_permit_status' => 'inactive']);
        ArtistTempData::where('artist_permit_id', $artist_permit_id)->update(['status' => 1]);
        $result = ['success', 'Artist Removed successfully ', 'Success'];
        switch ($from) {
            case 'amend':
                $route_back = './company/amend_permit/' . $permit_id;
                break;
            case 'renew':
                $route_back = './company/renew_permit/' . $permit_id;
                break;
            case 'edit':
                $route_back = './company/edit_permit/' . $permit_id;
                break;
            default:
                break;
        }
        // dd($route_back);
        return redirect($route_back)->with('message', $result);
    }

    public function update_artist_temp_data(Request $request)
    {

        $artist_permit_id = $request->permitId;
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);

        $i = 1;

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);

        $pic_ext = session($i . '_ext');

        if (Storage::exists(session($i . '_pic_file'))) {

            $check_path = 'public/' . $company_name . '/artist_permit/' . $artistDetails[$i]['id'] . '/photos';

            if (Storage::exists($check_path)) {
                $file_count = count(Storage::files($check_path));
                $file_nos = $file_count / 2;
                $next_file_no = $file_nos + 1;
            } else {
                $next_file_no = 1;
            }

            $newPath = 'public/' . $company_name . '/artist_permit/' . $artistDetails[$i]['id'] . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
            $newPathLink = $company_name . '/artist_permit/' . $artistDetails[$i]['id'] . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
            $newThumbPath = 'public/' . $company_name . '/artist_permit/' . $artistDetails[$i]['id'] . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;
            $newThumbPathLink = $company_name . '/artist_permit/' . $artistDetails[$i]['id'] . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;

            Storage::move(session($i . '_pic_file'), $newPath);
            Storage::move(session($i . '_thumb_file'), $newThumbPath);

            session()->forget([$i . '_pic_file', $i . '_thumb_file', $i . '_ext']);
        } else {
            $getArtistPics = ArtistTempData::where('artist_permit_id', $artist_permit_id)->latest()->first();
            $newPathLink = $getArtistPics->original;
            $newThumbPathLink = $getArtistPics->thumbnail;
        }


        $artists = ArtistTempData::where('artist_permit_id', $artist_permit_id)->update([
            'firstname_en' => $artistDetails[$i]['fname_en'],
            'firstname_ar' => $artistDetails[$i]['fname_ar'],
            'lastname_en' => $artistDetails[$i]['lname_en'],
            'lastname_ar' => $artistDetails[$i]['lname_ar'],
            'nationality' => $artistDetails[$i]['nationality'],
            'gender' => $artistDetails[$i]['gender'],
            'birthdate' => $artistDetails[$i]['dob'] ? Carbon::parse($artistDetails[$i]['dob'])->toDateString() : '',
            'permit_type_id' => $artistDetails[$i]['profession'],
            'original' => $newPathLink,
            'thumbnail' => $newThumbPathLink,
            'uid_number' => $artistDetails[$i]['uidNumber'],
            'passport_number' => $artistDetails[$i]['passport'],
            'uid_expire_date' => $artistDetails[$i]['uidExp'] ? Carbon::parse($artistDetails[$i]['uidExp'])->toDateString() : '',
            'passport_expire_date' => $artistDetails[$i]['ppExp'] ? Carbon::parse($artistDetails[$i]['ppExp'])->toDateString() : '',
            'visa_type' => $artistDetails[$i]['visaType'],
            'visa_number' => $artistDetails[$i]['visaNumber'],
            'visa_expire_date' => $artistDetails[$i]['visaExp'] ? Carbon::parse($artistDetails[$i]['visaExp'])->toDateString() : '',
            'sponsor_name_en' => $artistDetails[$i]['spName'],
            'emirates_id' => $artistDetails[$i]['idNo'],
            'language' => $artistDetails[$i]['language'],
            'religion' => $artistDetails[$i]['religion'],
            'city' => $artistDetails[$i]['city'],
            'area' => $artistDetails[$i]['area'],
            'address_en' => $artistDetails[$i]['address'],
            'mobile_number' => $artistDetails[$i]['mobile'],
            'phone_number' => $artistDetails[$i]['landline'],
            'po_box' => $artistDetails[$i]['po_box'],
            'fax_number' => $artistDetails[$i]['fax_number'],
            'email' => $artistDetails[$i]['email'],

        ]);


        $requirements = Requirement::where('requirement_type', 'artist')->get();
        $requirement_names = [];
        foreach ($requirements as $req) {
            array_push($requirement_names, $req->requirement_name);
        }
        $total = $requirements->count();

        for ($j = 1; $j <= $total; $j++) {
            if (Storage::exists(session($i . '_doc_file_' . $j))) {

                $ext = session($i . '_ext_' . $j);

                $check_path = 'public/' . $company_name . '/artist_permit/' . $artistDetails[$i]['id'];

                if (Storage::exists($check_path)) {
                    $file_count = count(Storage::files($check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = $j;
                }

                $newPath = 'public/' . $company_name . '/artist_permit/' . $artistDetails[$i]['id'] . '/document_' . $next_file_no . '.' . $ext;
                $newPathLink = $company_name . '/artist_permit/' . $artistDetails[$i]['id'] . '/document_' . $next_file_no . '.' . $ext;

                Storage::move(session($i . '_doc_file_' . $j), $newPath);
                Storage::delete(session($i . '_doc_file_' . $j));

                session()->forget([$i . '_doc_file_' . $j, $i . '_ext_' . $j]);
            } else {
                $artistsD = ArtistPermitDocument::where('artist_permit_id', $artist_permit_id)->latest()->first();
                $newPathLink = $artistsD->path;
            }

            ArtistTempDocument::create([
                'issued_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['issue_date'])->toDateTimeString() : '',
                'expired_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['exp_date'])->toDateTimeString() : '',
                'created_at' =>  Carbon::now()->toDateTimeString(),
                'created_by' =>  Auth::user()->user_id,
                'artist_permit_id' => $artist_permit_id,
                'path' =>  $newPathLink,
                'document_name' => $requirement_names[$j - 1]
            ]);
        }

        if ($artists) {
            $result = ['success', 'Artist Updated Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    function add_to_artist_temp_data(Request $request)
    {

        $permit_id = $request->permit_id;
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);

        $i = 1;
        $is_old = $artistDetails[$i]['is_old_artist'];
        $tempData = ArtistTempData::create([
            'firstname_en' => $artistDetails[$i]['fname_en'],
            'firstname_ar' => $artistDetails[$i]['fname_ar'],
            'lastname_en' => $artistDetails[$i]['lname_en'],
            'lastname_ar' => $artistDetails[$i]['lname_ar'],
            'nationality' => $artistDetails[$i]['nationality'],
            'gender' => $artistDetails[$i]['gender'],
            'uid_number' => $artistDetails[$i]['uidNumber'],
            'birthdate' => $artistDetails[$i]['dob'] ? Carbon::parse($artistDetails[$i]['dob'])->toDateString() : '',
            'uid_expire_date' => $artistDetails[$i]['uidExp'] ? Carbon::parse($artistDetails[$i]['uidExp'])->toDateString() : '',
            'passport_number' => $artistDetails[$i]['passport'],
            'passport_expire_date' => $artistDetails[$i]['ppExp'] ? Carbon::parse($artistDetails[$i]['ppExp'])->toDateString() : '',
            'visa_type' => $artistDetails[$i]['visaType'],
            'visa_number' => $artistDetails[$i]['visaNumber'],
            'visa_expire_date' => $artistDetails[$i]['visaExp'] ? Carbon::parse($artistDetails[$i]['visaExp'])->toDateString() : '',
            'sponsor_name_en' => $artistDetails[$i]['spName'],
            'emirates_id' => $artistDetails[$i]['idNo'],
            'language' => $artistDetails[$i]['language'],
            'religion' => $artistDetails[$i]['religion'],
            'permit_type_id' => $artistDetails[$i]['profession'],
            'city' => $artistDetails[$i]['city'],
            'area' => $artistDetails[$i]['area'],
            'address_en' => $artistDetails[$i]['address'],
            'mobile_number' => $artistDetails[$i]['mobile'],
            'phone_number' => $artistDetails[$i]['landline'],
            'email' => $artistDetails[$i]['email'],
            'permit_id' => $permit_id,
            'created_at' => Carbon::now()->toDateTimeString(),
            'person_code' => 0,
            'po_box' => $artistDetails[$i]['po_box'],
            'fax_number' => $artistDetails[$i]['fax_number'],
            'status' => 0
        ]);

        if (isset($artistDetails[$i]['artist_id'])) {
            $tempData->artist_id = $artistDetails[$i]['artist_id'];
        } else {
            $tempData->artist_id = $tempData->id;
        }

        $tempData->artist_permit_id = $tempData->artist_id;

        $tempData->save();

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);

        $pic_ext = session($i . '_ext');

        if (Storage::exists(session($i . '_pic_file'))) {

            $check_path = 'public/' . $company_name . '/artist_permit/' . $tempData->artist_id . '/photos';

            if (Storage::exists($check_path)) {
                $file_count = count(Storage::files($check_path));
                $file_nos = $file_count / 2;
                $next_file_no = $file_nos + 1;
            } else {
                $next_file_no = 1;
            }

            $newPath = 'public/' . $company_name . '/artist_permit/' . $tempData->artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
            $newPathLink = $company_name . '/artist_permit/' . $tempData->artist_id . '/photos/photo_' . $next_file_no . '.' . $pic_ext;
            $newThumbPath = 'public/' . $company_name . '/artist_permit/' . $tempData->artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;
            $newThumbPathLink = $company_name . '/artist_permit/' . $tempData->artist_id . '/photos/thumb_' . $next_file_no . '.' . $pic_ext;

            Storage::move(session($i . '_pic_file'), $newPath);
            Storage::move(session($i . '_thumb_file'), $newThumbPath);

            session()->forget([$i . '_pic_file', $i . '_thumb_file', $i . '_ext']);
        } else {
            $artistsD = ArtistPermit::where('artist_id', $tempData->artist_id)->latest()->first(); // change artist id
            $newPathLink = $artistsD->original;
            $newThumbPathLink = $artistsD->thumbnail;
        }

        $tempData->original  = $newPathLink;
        $tempData->thumbnail = $newThumbPathLink;
        $tempData->save();

        $requirements = Requirement::where('requirement_type', 'artist')->get();
        $requirement_names = [];
        foreach ($requirements as $req) {
            array_push($requirement_names, $req->requirement_name);
        }
        $total = $requirements->count();

        for ($j = 1; $j <= $total; $j++) {
            if (Storage::exists(session($i . '_doc_file_' . $j))) {

                $ext = session($i . '_ext_' . $j);

                $check_path = 'public/' . $company_name . '/artist_permit/' . $tempData->artist_id;

                if (Storage::exists($check_path)) {
                    $file_count = count(Storage::files($check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = $j;
                }

                $newPath = 'public/' . $company_name . '/artist_permit/' . $tempData->artist_id . '/document_' . $next_file_no . '.' . $ext;
                $newPathLink = $company_name . '/artist_permit/' . $tempData->artist_id . '/document_' . $next_file_no . '.' . $ext;


                Storage::move(session($i . '_doc_file_' . $j), $newPath);
                Storage::delete(session($i . '_doc_file_' . $j));



                session()->forget([$i . '_doc_file_' . $j, $i . '_ext_' . $j]);
            } else {
                $artistsD = ArtistPermitDocument::where('artist_permit_id', $tempData->artist_id)->latest()->first();
                $newPathLink = $artistsD->path;
            }

            ArtistTempDocument::create([
                'issued_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['issue_date'])->toDateTimeString() : '',
                'expired_date' => $documentDetails[$i][$j] != null ? Carbon::parse($documentDetails[$i][$j]['exp_date'])->toDateTimeString() : '',
                'created_at' =>  Carbon::now()->toDateTimeString(),
                'created_by' =>  Auth::user()->user_id,
                'artist_permit_id' => $tempData->id,
                'path' =>  $newPathLink,
                'document_name' => $requirement_names[$j - 1],
                'status' => 'active'
            ]);
        }

        if ($tempData) {
            $result = ['success', 'Artist Added Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function move_temp_to_permit(Request $request)
    {
        $permit_id = $request->permit_id;

        $artist_temp_data = ArtistTempData::with('ArtistTempDocument')->where('permit_id', $permit_id)->get();

        // $artists_of_permit = ArtistPermit::with('permit')->where('permit_id', $permit_id)->get();

        foreach ($artist_temp_data as $data) {
            if ($data->status == 1) {
                ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update([
                    'artist_permit_status' => 'inactive'
                ]);
            } else {

                $updateArray = [
                    // 'artist_id' => $data->artist_id,
                    // 'permit_id' => $data->permit_id,
                    'permit_type_id' => $data->permit_type_id,
                    'original' => $data->original,
                    'thumbnail' => $data->thumbnail,
                    'passport_number' => $data->passport_number,
                    'uid_number' => $data->uid_number,
                    'uid_expire_date' => $data->uid_expire_date ? Carbon::parse($data->uid_expire_date)->toDateString() : '',
                    'passport_expire_date' => $data->passport_expire_date ? Carbon::parse($data->passport_expire_date)->toDateString() : '',
                    'visa_type' => $data->visa_type,
                    'visa_number' => $data->visa_number,
                    'visa_expire_date' => $data->visa_expire_date ? Carbon::parse($data->visa_expire_date)->toDateString() : '',
                    'sponsor_name_en' => $data->sponsor_name_en,
                    'language' => $data->language,
                    'religion' => $data->religion,
                    'city' => $data->city,
                    'fax_number' => $data->fax_number,
                    'po_box' => $data->po_box,
                    'area' => $data->area,
                    'address_en' => $data->address_en,
                    'mobile_number' => $data->mobile_number,
                    'phone_number' => $data->phone_number,
                    'email' => $data->email,
                    'emirates_id' => $data->emirates_id,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'updated_by' => Auth::user()->user_id
                ];

                if ($data->artist_permit_id) {
                    $artistPermit =  ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update($updateArray);
                    $artist_temp_document = ArtistTempDocument::where('artist_permit_id', $data->artist_permit_id)->get();
                    $artist_old_documents = ArtistPermitDocument::where('artist_permit_id', $data->artist_permit_id)->get();
                } else {
                    $artistPermit =   ArtistPermit::create($updateArray);
                    $artistPermit->created_at = Carbon::now()->toDateTimeString();
                    $artistPermit->created_by =  Auth::user()->user_id;
                    $artistPermit->save();

                    $artist_temp_document = ArtistTempDocument::where('artist_permit_id', $data->id)->get();
                }

                foreach ($artist_temp_document as $atd) {
                    ArtistPermitDocument::create([
                        'issued_date' => $atd->issued_date != null ? Carbon::parse($atd->issued_date)->toDateString() : '',
                        'expired_date' => $atd->expired_date != null ? Carbon::parse($atd->expired_date)->toDateString() : '',
                        'created_at' =>  Carbon::now()->toDateTimeString(),
                        'created_by' =>  Auth::user()->user_id,
                        'path' =>  $atd->path,
                        'document_name' => $atd->document_name,
                        'artist_permit_id' => $artistPermit->artist_permit_id
                    ]);

                    if ($data->artist_permit_id) {
                        foreach ($artist_old_documents as $aod) {
                            ArtistPermitDocument::where('permit_document_id', $aod->permit_document_id)->update(['status' => 'inactive']);
                        }
                    }
                }
            }
        }

        $result = Permit::where('permit_id', $permit_id)->update(['permit_status' => 'pending']);
        if ($result) {
            $message = ['success', 'Permit Re-Submitted Successfully', 'Success'];
        } else {
            $message = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $message]);
    }
}
