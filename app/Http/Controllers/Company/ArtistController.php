<?php

namespace App\Http\Controllers\Company;

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
use App\ArtistPermitComment;
use Intervention\Image\ImageManagerStatic as Image;
use League\Flysystem\Filesystem;

class ArtistController extends Controller
{


    public function index()
    {
        return view('permits.artist.index');
    }


    // Artist Permit Dashboard Table One

    public function applied_list()
    {

        $permits = Permit::with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', '!=', 'expired')->get();
        //->has('artistPermitDocument')

        return Datatables::of($permits)->editColumn('issued_date', function ($permits) {
            if ($permits->issued_date) {
                return Carbon::parse($permits->issued_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->editColumn('expired_date', function ($permits) {
            if ($permits->expired_date) {
                return Carbon::parse($permits->expired_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->addColumn('action', function ($permit) {
            if ($permit->permit_status == 'approved') {
                return '<a href="' . route('make_payment', $permit->permit_id) . '" class="btn btn-sm btn-success">Payment</a>';
            } else if ($permit->permit_status == 'pending') {
                return '<button onClick="cancel_permit(' . $permit->permit_id . ')" data-toggle="modal" data-target="#cancel_permit" class="btn btn-sm btn-dark">Cancel</button>&emsp;<a href="viewPermit/' . $permit->permit_id . '"><i class="kt-font-dark flaticon-edit-1 fs-1_5em"></i></a>';
            } else if ($permit->permit_status == 'rejected') {
                return '<button onClick="rejected_permit(' . $permit->permit_id . ')" data-toggle="modal" data-target="#rejected_permit" class="btn btn-sm btn-warning">Rejected</a>';
            } else if ($permit->permit_status == 'cancelled') {
                return '<button onClick="show_cancelled(' . $permit->permit_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="btn btn-sm btn-danger">Cancelled</a>';
            }
        })->addColumn('details', function ($permit) {
            return '<button type="button" target="_blank" class="btn btn-link btn-sm" data-toggle="modal" data-target="#artist_details" onclick="show_details(' . $permit->permit_id . ')" >details</button>';
        })->rawColumns(['action', 'details'])->make(true);

        // ->editColumn('created_at', function ($permit) {
        //     if ($permit->created_at) {
        //         return $permit->created_at->format('d-m-Y');
        //     } else {
        //         return '';
        //     }
        // })
    }

    // Artist Permit Dashboard Table Two

    public function existing_list()
    {
        $permits = Permit::with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('company_id', Auth::user()->EmpClientId)->where('permit_status', 'expired')->get();


        return Datatables::of($permits)->editColumn('created_at', function ($permits) {
            if ($permits->created_at) {
                return $permits->created_at->format('d-m-Y');
            } else {
                return 'none';
            }
        })->editColumn('issued_date', function ($permits) {
            if ($permits->issued_date) {
                return Carbon::parse($permits->issued_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->editColumn('expired_date', function ($permits) {
            if ($permits->expired_date) {
                return Carbon::parse($permits->expired_date)->format('d-m-Y');
            } else {
                return 'none';
            }
        })->addColumn('action', function ($permit) {
            return '<a href="' . route('extend_permit', $permit->permit_id) . '"  class="btn btn-sm btn-default">Extend</a>';
        })->addColumn('details', function ($permit) {
            return '<button type="button" target="_blank" class="btn btn-link btn-sm" data-toggle="modal" data-target="#artist_details" onclick="show_details(' . $permit->permit_id . ')">details</button>';
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

    // Extend Permit Link

    public function extend_permit()
    {
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();
        return view('permits.artist.extend', $data_bundle);
    }

    // To Fetch Artist Details

    public function fetch_artist_details(Request $request)
    {
        $id = $request->permit_id;
        $artists = ArtistPermit::with('artist',  'permit', 'permitType', 'artistPermitDocument')->where('permit_id', $id)->get();
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
        request()->validate([
            'cancel_reason' => 'required'
        ]);
        $id = $request->input('permit_id');
        Permit::where('permit_id', $id)->update(['cancel_reason' => $request->input('cancel_reason'), 'permit_status' => 'cancelled']);
        return redirect('company/artist_permits');
    }

    // To Apply New Permit Page

    public function create()
    {
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['areas'] = Areas::all();
        return view('permits.artist.create', $data_bundle);
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
            $ext = $request->files->get('doc_file_' . $request->id)->getClientOriginalExtension();
            $path  = Storage::putFileAs('files/' . $number, $request->files->get('doc_file_' . $request->id), $name);
            session([$number . '_doc_file_' . $request->id => $path, $number . '_ext_' . $request->id => $ext]);
        }
    }

    public function deleteDocuments(Request $request)
    {
        $req = str_replace(" ", "_", $request->reqName);
        // dd('files/' . $request->artistNo . '/' . $req);
        $status = Storage::delete('files/' . $request->artistNo . '/' . $req);
        return $status;
    }

    public function store(Request $request)
    {

        $permitDetails = json_decode($request->permitD, true);
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);
        $last_permit_no = Permit::latest()->first();
        $new_permit_no = sprintf("%03d", $last_permit_no  ? $last_permit_no->permit_id + 1 : 1);

        $permit = Permit::create([
            'work_location' => $permitDetails['workLocation'],
            'issued_date' => $permitDetails['fromDate'] ? Carbon::parse($permitDetails['fromDate'])->toDateTimeString() : '',
            'expired_date' => $permitDetails['toDate'] ? Carbon::parse($permitDetails['toDate'])->toDateTimeString() : '',
            'permit_number' => $new_permit_no,
            'created_at' => Carbon::now()->toDateTimeString(),
            'permit_status' => 'pending',
            'created_by' => Auth::user()->user_id,
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
                    'passport_number' => $artistDetails[$i]['passport'],
                    'artist_status' => 'active',
                    'uid_number' => $artistDetails[$i]['uidNumber'],
                    'uid_expiry_date' => $artistDetails[$i]['uidExp'] ? Carbon::parse($artistDetails[$i]['uidExp'])->toDateString() : '',
                    'pp_expiry_date' => $artistDetails[$i]['ppExp'] ? Carbon::parse($artistDetails[$i]['ppExp'])->toDateString() : '',
                    'visa_type' => $artistDetails[$i]['visaType'],
                    'visa_number' => $artistDetails[$i]['visaNumber'],
                    'visa_expiry_date' => $artistDetails[$i]['visaExp'] ? Carbon::parse($artistDetails[$i]['visaExp'])->toDateString() : '',
                    'sponser_name' => $artistDetails[$i]['spName'],
                    'id_no' => $artistDetails[$i]['idNo'],
                    'language' => $artistDetails[$i]['language'],
                    'religion' => $artistDetails[$i]['religion'],
                    'gender' => $artistDetails[$i]['gender'],
                    'emirate' => $artistDetails[$i]['city'],
                    'area' => $artistDetails[$i]['area'],
                    'address' => $artistDetails[$i]['address'],
                    'birthdate' => $artistDetails[$i]['dob'] ? Carbon::parse($artistDetails[$i]['dob'])->toDateString() : '',
                    'mobile_number' => $artistDetails[$i]['mobile'],
                    'phone_number' => $artistDetails[$i]['landline'],
                    'email' => $artistDetails[$i]['email'],
                    'updated_by' => Auth::user()->user_id,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);

                $artist = Artist::where('person_code', $artistDetails[$i]['code'])->first();
            } else {

                $last_person_code = Artist::orderBy('artist_id', 'desc')->value('person_code');

                if ($last_person_code == null) {
                    $code = 2000;
                } else {
                    $code = $last_person_code + 1;
                }

                $artist = Artist::create([
                    'firstname_en' => $artistDetails[$i]['fname_en'],
                    'firstname_ar' => $artistDetails[$i]['fname_ar'],
                    'lastname_en' => $artistDetails[$i]['lname_en'],
                    'lastname_ar' => $artistDetails[$i]['lname_ar'],
                    'nationality' => $artistDetails[$i]['nationality'],
                    'passport_number' => $artistDetails[$i]['passport'],
                    'artist_status' => 'active',
                    'uid_number' => $artistDetails[$i]['uidNumber'],
                    'uid_expiry_date' => $artistDetails[$i]['uidExp'] ? Carbon::parse($artistDetails[$i]['uidExp'])->toDateString() : '',
                    'pp_expiry_date' => $artistDetails[$i]['ppExp'] ? Carbon::parse($artistDetails[$i]['ppExp'])->toDateString() : '',
                    'visa_type' => $artistDetails[$i]['visaType'],
                    'visa_number' => $artistDetails[$i]['visaNumber'],
                    'visa_expiry_date' => $artistDetails[$i]['visaExp'] ? Carbon::parse($artistDetails[$i]['visaExp'])->toDateString() : '',
                    'sponser_name' => $artistDetails[$i]['spName'],
                    'id_no' => $artistDetails[$i]['idNo'],
                    'language' => $artistDetails[$i]['language'],
                    'religion' => $artistDetails[$i]['religion'],
                    'gender' => $artistDetails[$i]['gender'],
                    'emirate' => $artistDetails[$i]['city'],
                    'area' => $artistDetails[$i]['area'],
                    'address' => $artistDetails[$i]['address'],
                    'birthdate' => $artistDetails[$i]['dob'] ? Carbon::parse($artistDetails[$i]['dob'])->toDateString() : '',
                    'mobile_number' => $artistDetails[$i]['mobile'],
                    'phone_number' => $artistDetails[$i]['landline'],
                    'person_code' => $code,
                    'email' => $artistDetails[$i]['email'],
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


                $artistPermit = ArtistPermit::create([
                    'artist_permit_status' => 'active',
                    'artist_id' => $artist->artist_id,
                    'permit_id' => $permit->permit_id,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'profession' => $artistDetails[$i]['profession'],
                    'original_pic' => $newPathLink,
                    'thumbnail_pic' => $newThumbPathLink,
                ]);

                session()->forget([$i . '_pic_file', $i . '_thumb_file', $i . '_ext']);
            }

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

                    session()->forget([$i . '_doc_file_' . $j, $i . '_ext_' . $j]);
                }
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

    // Make Payment Function

    public function makepayment($id)
    {
        // $data_bundle['profession'] = Profession::all();
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();
        // $artist_id = ArtistPermit::where('permit_id', $id)->value('artist_id');
        // $data_bundle['artist_details'] = Artist::with(['artistPermit' => function ($q) use ($id) {
        //     $q->where('permit_id', $id);
        // },  'permit', 'artistPermit.artistPermitDocument', 'artistPermit.permitType'])->get();
        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'permit', 'artistPermitDocument', 'permitType')->where('permit_id', $id)->get();
        return view('permits.artist.payment', $data_bundle);
    }

    // Payment Gateway


    public function payment_gateway(Request $request)
    {
        return view('permits.artist.paymentgateway');
    }


    public function happiness_meter($id)
    {
        return view('permits.happinessmeter', ['id' => $id]);
    }

    // START VIEW PERMIT

    public function viewPermit($id)
    {
        $data_bundle['id'] = $id;
        $data_bundle['permit_details'] =  Permit::find($id);
        $data_bundle['comment'] = ArtistPermitComment::where('artist_permit_id', $id)->get();
        return view('permits.artist.view_permit', $data_bundle);
    }

    public function getArtistsInPermit(Request $request)
    {
        $id = $request->id;
        $permits = ArtistPermit::with('artist', 'artistPermitDocument', 'permitType')->where('permit_id', $id)->where('artist_permit_status', 'active')->get();
        $total_artists = $permits->count();
        return Datatables::of($permits)->addColumn('action', function ($permit) use ($total_artists) {
            $fname = $permit->artist['firstname_en'] ? $permit->artist['firstname_en'] : '';
            $lname = $permit->artist['lasttname_en'] ? $permit->artist['lasttname_en'] : '';
            return '<a href="../edit_artist/' . $permit->artist_id . '" class="kt-font-info flaticon-edit-1 fs-1_5em"></a>&emsp;<a data-toggle="modal" data-target="#delartistmodal" onclick="delArtist(' . $permit->artist_id . ',' . $permit->permit_id . ',' . $total_artists . ',\'' . $fname . '\',\'' . $lname . '\')" class="kt-font-danger flaticon-delete fs-1_5em"></a>';
        })->rawColumns(['action'])->make(true);
    }

    public function delete_artist_from_permit(Request $request)
    {
        Artistpermit::where('artist_id', $request->del_artist_id)->where('permit_id', $request->del_permit_id)->update(['artist_permit_status' => 'inactive']);
        $result = ['success', 'Artist Removed successfully ', 'Success'];
        return redirect('company/viewPermit/' . $request->del_permit_id)->with('message', $result);
    }


    // END VIEW PERMIT

    // START EDIT PERMIT

    public function edit_artist($id)
    {
        // session()->forget(['1_pic_file', '1_ext', '1_thumb_file', '1_doc_file_2', '1_ext_2', '1_doc_file_1', '1_ext_1']);

        // dd(session()->all());

        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['artist_details'] = Artist::with('artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.permitType')->where('artist_id', $id)->first();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['areas'] = Areas::all();
        return view('permits.artist.edit_artist', $data_bundle);
    }

    // END EDIT PERMIT

    public function submit_happiness(Request $request)
    {
        $id = $request->permit_id;
        $rating = $request->rating;

        // $device = Device::findOrFail($id);

        $artists = ArtistPermit::findOrFail($id);

        $artists->update([
            'meter' => $rating
        ]);

        return view('permits.happinessmeter', ['id' => $id]);
    }

    public function get_files_uploaded(Request $request)
    {
        $permit_id = $request->artist_permit;
        $reqName =  $request->reqName;
        $artist_documents = ArtistPermitDocument::where('artist_permit_id', $permit_id)->where('document_name', $reqName)->get();
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

    public function update_artist_permit(Request $request)
    {

        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);

        $artist = Artist::where('artist_id', $artistDetails[1]['id'])->update([
            'firstname_en' => $artistDetails[1]['fname_en'],
            'firstname_ar' => $artistDetails[1]['fname_ar'],
            'lastname_en' => $artistDetails[1]['lname_en'],
            'lastname_ar' => $artistDetails[1]['lname_ar'],
            'nationality' => $artistDetails[1]['nationality'],
            'passport_number' => $artistDetails[1]['passport'],
            'artist_status' => 'active',
            'uid_number' => $artistDetails[1]['uidNumber'],
            'uid_expiry_date' => $artistDetails[1]['uidExp'] ? Carbon::parse($artistDetails[1]['uidExp'])->toDateString() : '',
            'pp_expiry_date' => $artistDetails[1]['ppExp'] ? Carbon::parse($artistDetails[1]['ppExp'])->toDateString() : '',
            'visa_type' => $artistDetails[1]['visaType'],
            'visa_number' => $artistDetails[1]['visaNumber'],
            'visa_expiry_date' => $artistDetails[1]['visaExp'] ? Carbon::parse($artistDetails[1]['visaExp'])->toDateString() : '',
            'sponser_name' => $artistDetails[1]['spName'],
            'id_no' => $artistDetails[1]['idNo'],
            'language' => $artistDetails[1]['language'],
            'religion' => $artistDetails[1]['religion'],
            'gender' => $artistDetails[1]['gender'],
            'emirate' => $artistDetails[1]['city'],
            'area' => $artistDetails[1]['area'],
            'address' => $artistDetails[1]['address'],
            'birthdate' => $artistDetails[1]['dob'] ? Carbon::parse($artistDetails[1]['dob'])->toDateString() : '',
            'mobile_number' => $artistDetails[1]['mobile'],
            'phone_number' => $artistDetails[1]['landline'],
            'email' => $artistDetails[1]['email'],
            'updated_by' => Auth::user()->user_id,
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        $artist = Artist::where('person_code', $artistDetails[1]['code'])->first();

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);

        $pic_ext = session('1_ext');

        if (Storage::exists(session('1_pic_file'))) {

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

            Storage::move(session('1_pic_file'), $newPath);
            Storage::move(session('1_thumb_file'), $newThumbPath);

            ArtistPermit::where('artist_permit_id', $artistDetails[1]['permit_id'])->update([
                'profession' => $artistDetails[1]['profession'],
                'original_pic' => $newPathLink,
                'thumbnail_pic' => $newThumbPathLink,
            ]);

            session()->forget(['1_pic_file', '1_thumb_file', '1_ext']);
        }

        $requirements = Requirement::where('requirement_type', 'artist')->get();
        $requirement_names = [];
        foreach ($requirements as $req) {
            array_push($requirement_names, $req->requirement_name);
        }
        $total = $requirements->count();

        for ($j = 1; $j <= $total; $j++) {
            if (Storage::exists(session('1_doc_file_' . $j))) {

                $ext = session('1_ext_' . $j);

                $check_path = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id;


                if (Storage::exists($check_path)) {
                    $file_count = count(Storage::files($check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = $j;
                }

                $newPath = 'public/' . $company_name . '/artist_permit/' . $artist->artist_id . '/document_' . $next_file_no . '.' . $ext;
                $newPathLink = $company_name . '/artist_permit/' . $artist->artist_id . '/document_' . $next_file_no . '.' . $ext;


                Storage::move(session('1_doc_file_' . $j), $newPath);
                Storage::delete(session('1_doc_file_' . $j));

                ArtistPermitDocument::create([
                    'issued_date' => $documentDetails[1][$j] != null ? Carbon::parse($documentDetails[1][$j]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $documentDetails[1][$j] != null ? Carbon::parse($documentDetails[1][$j]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'artist_permit_id' => $artistDetails[1]['permit_id'],
                    'path' =>  $newPathLink,
                    'document_name' => $requirement_names[$j - 1],
                    'status' => 'active'
                ]);

                session()->forget(['1_doc_file_' . $j, '1_ext_' . $j]);
            }
        }




        if ($artist) {
            $result = ['success', 'Artist Details Updated Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function edit_add_new_artist($id)
    {
        $data_bundle['requirements'] = Requirement::where('requirement_type', 'artist')->get();
        $data_bundle['countries'] = Countries::all()->pluck('name.common')->sort();
        $data_bundle['permitTypes'] = PermitType::where('permit_type', 'artist')->where('status', 1)->get();
        $data_bundle['languages'] = Language::all();
        $data_bundle['religions'] = Religion::all();
        $data_bundle['emirates'] = Emirates::all();
        $data_bundle['areas'] = Areas::all();
        $data_bundle['permit_id'] = $id;
        return view('permits.artist.edit_add_artist', $data_bundle);
    }


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
}
