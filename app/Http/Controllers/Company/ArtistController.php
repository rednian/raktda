<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Countries;
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
use App\Language;
use App\Religion;
use App\Emirates;
use App\Profession;
use App\Areas;
use App\VisaType;
use App\ArtistTempData;
use App\ArtistTempDocument;
use App\PermitComment;
use PDF;
use App\Transaction;
use Intervention\Image\ImageManagerStatic as Image;

class ArtistController extends Controller
{

    public function index()
    {
        return view('permits.artist.index');
    }

    // Artist Permit Dashboard Table One

    public function fetch_applied()
    {
        return $this->datatable_function('applied');
    }

    public function fetch_valid()
    {
        return $this->datatable_function('valid');
    }

    function datatable_function($status)
    {
        $permits = Permit::with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->where('created_by', Auth::user()->user_id);
        if ($status == 'applied') {
            $permits->where('permit_status', '!=', 'active');
        } else if ($status == 'valid') {
            $permits->where('permit_status', 'active');
        }
        $permits->get();

        return Datatables::of($permits)->editColumn('created_at', function ($permits) {
            if ($permits->created_at) {
                return  $permits->created_at;
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
        })->editColumn('artist_count', function ($permits) {
            return  count($permits->artistPermit);
        })->addColumn('action', function ($permit) use ($status) {
            switch ($status) {
                case 'applied':
                    if ($permit->permit_status == 'approved-unpaid') {
                        return '<a href="' . route('company.make_payment', $permit->permit_id) . '"  title="Payments"><span class="kt-badge kt-badge--success kt-badge--inline">Payment</span></a>';
                    } else if ($permit->permit_status == 'new' && $permit->lock == '') {
                        return '<a href="' . route('artist.permit', ['id' => $permit->permit_id, 'status' => 'edit']) . '"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a><span onClick="cancel_permit(' . $permit->permit_id . ',\'' . $permit->reference_number . '\')" data-toggle="modal" data-target="#cancel_permit" class="kt-badge kt-badge--danger kt-badge--inline">Cancel</span>';
                    } else if ($permit->permit_status == 'modification request') {
                        return '<a href="' . route('artist.permit', ['id' => $permit->permit_id, 'status' => 'edit']) . '"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a>';
                    } else if ($permit->permit_status == 'rejected') {
                        return '<span onClick="rejected_permit(' . $permit->permit_id . ')" data-toggle="modal" data-target="#rejected_permit" class="kt-badge kt-badge--info kt-badge--inline">Rejected</span>';
                    } else if ($permit->permit_status == 'cancelled') {
                        return '<span onClick="show_cancelled(' . $permit->permit_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="kt-badge kt-badge--info kt-badge--inline">Cancelled</span>';
                    }
                    break;
                case 'valid':
                    $issued_date = strtotime($permit->issued_date);
                    $expired_date = strtotime($permit->expired_date);
                    $today = strtotime(date('Y-m-d 00:00:00'));
                    $diff = abs($today - $issued_date) / 60 / 60 / 24;
                    $expDiff = abs($today - $expired_date) / 60 / 60 / 24;
                    $amendBtn = ($diff < 10) ? '<a href="'  . route('artist.permit', ['id' => $permit->permit_id, 'status' => 'amend']) .  '" title="Amend"><span  class="kt-badge kt-badge--warning kt-badge--inline kt-margin-b-5">Amend</span></a>' : '';
                    $renewBtn = ($expDiff <= 2) ? '<a href="'  . route('artist.permit', ['id' => $permit->permit_id, 'status' => 'renew']) .  '" title="Renew"><span  class="kt-badge kt-badge--success kt-badge--inline">Renew</span></a>' : '';
                    $pn = Permit::where('permit_number', 'like', "$permit->permit_number%")->latest()->first()->permit_number;
                    if ($pn != $permit->permit_number) {
                        $renewBtn = '';
                    }
                    return  '<span class="d-flex flex-column">' . $amendBtn . $renewBtn . '</span>';
                    break;
            }
        })->addColumn('permit_status', function ($permit) {
            return  $permit->permit_status;
        })->addColumn('details', function ($permit) use ($status) {
            $from = '';
            switch ($status) {
                case 'applied':
                    $from = 'applied';
                    break;
                case 'valid':
                    $from = 'valid';
                    break;
            }
            return '<a href="' . route('company.get_permit_details', $permit->permit_id) .  '?tab=' . $from . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
        })->addColumn('download', function ($permit) {
            return '<a href="' . route('company.download_permit', $permit) . '" target="_blank" title="Download"><span class="fa fa-file-download fa-2x"></i></a>';
        })->rawColumns(['action', 'details', 'download'])->make(true);
    }

    public function get_permit_details($id, Request $request)
    {
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.profession', 'artistPermit.artistPermitDocument')->where('permit_id', $id)->first();
        $data_bundle['tab'] = $request->tab;
        // dd($data_bundle['permit_details']);
        return view('permits.artist.view_details', $data_bundle);
    }

    // to add artist to permit

    function preLoadData()
    {
        $data['requirements'] = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
        $data['countries'] = Countries::orderBy('nationality_en', 'asc')->get();
        $data['visatypes'] = VisaType::orderBy('visa_type_en', 'asc')->get();
        $data['languages'] = Language::orderBy('name_en', 'asc')->get();
        $data['religions'] = Religion::orderBy('name_en', 'asc')->get();
        $data['emirates'] = Emirates::orderBy('name_en', 'asc')->get();
        $data['areas'] = Areas::orderBy('area_en', 'asc')->get();
        $data['profession'] = Profession::orderBy('name_en', 'asc')->get();
        return $data;
    }

    public function add_new_artist($id = null)
    {
        $data = $this->preLoadData();
        // dd(session()->all());
        $user_id = Auth::user()->user_id;
        $from_d = session($user_id . '_apn_from_date');
        $to_d = session($user_id . '_apn_to_date');
        $location = session($user_id . '_apn_location');

        if ($id == null) {
            $last_array = ArtistTempData::where([
                ['issue_date', $from_d],
                ['expiry_date', $to_d],
                ['work_location', $location],
                ['company_id', Auth::user()->EmpClientId],
                ['created_by', Auth::user()->user_id],
            ])->latest()->first();
            if ($last_array) {
                $new_permit_id = $last_array->permit_id + 1;
            } else {
                $new_permit_id = 1;
            }
        } else {
            $new_permit_id = $id;
        }

        $data['permit_id'] = $new_permit_id;
        return view('permits.artist.new.add_artist', $data);
    }

    public function storePermitDetails(Request $request)
    {
        $user_id = Auth::user()->user_id;
        session([$user_id . '_apn_from_date' => $request->from]);
        session([$user_id . '_apn_to_date' => $request->to]);
        session([$user_id . '_apn_location' => $request->loc]);
    }


    // To Fetch Artist Details

    public function fetch_artist_temp_data(Request $request)
    {
        $id = $request->artist_temp_id;
        $artists = ArtistTempData::with('Nationality', 'Profession')->where('id', $id)->first();
        return $artists;
    }

    // Show Cancelled Reason

    public function show_cancelled(Request $request)
    {
        $id = $request->id;
        $artists = Permit::where('permit_id', $id)->get();
        return $artists;
    }

    public function show_rejected($id)
    {
        $comment_details = PermitComment::where('permit_id', $id)->latest()->first();
        return $comment_details;
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
        return redirect()->route('artist.index')->with('message', $message);
    }

    // To Apply New Permit Page

    public function create($id = null)
    {
        $user_id =  Auth::user()->user_id;
        if (!$id) {
            session()->forget([
                $user_id . '_apn_from_date',
                $user_id . '_apn_to_date',
                $user_id . '_apn_location',
            ]);
        }
        $data_bundle['artist_details'] = ArtistTempData::where([
            ['permit_id', $id],
            ['company_id', Auth::user()->EmpClientId],
            ['created_by', Auth::user()->user_id],
        ])->with('profession', 'nationality', 'ArtistTempDocument')->get();

        $data_bundle['permit_id'] = $id;

        return view('permits.artist.new.create', $data_bundle);
    }

    public function uploadPhoto(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $file = $request->file('pic_file');
        $ext = $file->getClientOriginalExtension();
        $fileName = $request->file('pic_file')->getClientOriginalName();
        $original =  $user_id . '/temp/original';
        $path  = Storage::putFileAs('public/' . $original, $request->files->get('pic_file'), $fileName);
        $thumbImg = Image::make($request->file('pic_file')->getRealPath());
        $thumbImg->resize(300, 200,  function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::makeDirectory('public/' . $user_id . '/temp/thumb');
        $thumbPath = storage_path() . '/app/public/' . $user_id . '/temp/thumb/' . $fileName;
        $thumbImg->save($thumbPath);
        $thumbSavedPath = 'public/' . $user_id . '/temp/thumb/' . $fileName;
        session([$user_id . '_pic_file' => $path, $user_id . '_ext' => $ext, $user_id . '_thumb_file' => $thumbSavedPath]);

        return json_encode($file);
    }

    public function uploadDocument(Request $request)
    {
        // $name = str_replace(" ", "_", $request->reqName);
        $user_id = Auth::user()->user_id;
        $reqId = $request->reqId;
        $file = $request->files->get('doc_file_' . $request->id);
        $ext = $request->files->get('doc_file_' . $request->id)->getClientOriginalExtension();
        $date = date('d_m_Y_H_i_s');
        $path  = Storage::putFileAs('public/' . $user_id . '/temp/' . $reqId, $request->files->get('doc_file_' . $request->id), 'document_' . $request->id . '_' . $date . '.' . $ext);
        session([$user_id . '_doc_file_' . $reqId => $path, $user_id . '_ext_' . $reqId => $ext]);

        return response()->json(['filepath' => $path, 'id' => $reqId]);
        // return json_encode($file);
    }


    public function deleteDocuments(Request $request)
    {
        // $req = str_replace(" ", "_", $request->reqName);
        // $status = Storage::delete('files/' . $request->artistNo . '/' . $req);
        // return $status;
    }

    public function generatePermitNumber()
    {
        $last_permit_d = Permit::orderBy('created_at', 'desc')->where('permit_number', 'not like', '%-%')->first();

        if (!isset($last_permit_d->permit_number)) {
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

    public function delete_artist_from_temp(Request $request)
    {
        $del_temp_id  = $request->del_temp_id;
        $permit_id = $request->del_permit_id;

        ArtistTempData::where('id', $del_temp_id)->delete();
        ArtistTempDocument::where('temp_data_id', $del_temp_id)->delete();
        return redirect('company/add_new_permit/' . $permit_id);
    }

    public function add_artist_temp(Request $request)
    {
        $permitDetails = $request->permitD;
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);
        $date_time = date('d_m_Y_H_i_s');
        $permit_id = $request->permit_id;

        $artistTempData  = ArtistTempData::create([
            'firstname_en' => $artistDetails['fname_en'],
            'firstname_ar' => $artistDetails['fname_ar'],
            'lastname_en' => $artistDetails['lname_en'],
            'lastname_ar' => $artistDetails['lname_ar'],
            'nationality' => $artistDetails['nationality'],
            'gender' => $artistDetails['gender'],
            'uid_number' => $artistDetails['uidNumber'],
            'birthdate' => $artistDetails['dob'] ? Carbon::parse($artistDetails['dob'])->toDateString() : '',
            'uid_expire_date' => $artistDetails['uidExp'] ? Carbon::parse($artistDetails['uidExp'])->toDateString() : '',
            'passport_number' => $artistDetails['passport'],
            'passport_expire_date' => $artistDetails['ppExp'] ? Carbon::parse($artistDetails['ppExp'])->toDateString() : '',
            'visa_type' => $artistDetails['visaType'],
            'visa_number' => $artistDetails['visaNumber'],
            'visa_expire_date' => $artistDetails['visaExp'] ? Carbon::parse($artistDetails['visaExp'])->toDateString() : '',
            'sponsor_name_en' => $artistDetails['spName'],
            'emirates_id' => $artistDetails['idNo'],
            'language' => $artistDetails['language'],
            'religion' => $artistDetails['religion'],
            'profession_id' => $artistDetails['profession'],
            'city' => $artistDetails['city'],
            'area' => $artistDetails['area'],
            'address_en' => $artistDetails['address'],
            'mobile_number' => $artistDetails['mobile'],
            'phone_number' => $artistDetails['landline'],
            'email' => $artistDetails['email'],
            'permit_id' =>  $permit_id,
            'person_code' => 0,
            'po_box' => $artistDetails['po_box'],
            'fax_number' => $artistDetails['fax_no'],
            'status' => 0,
            'is_old_artist' => $artistDetails['is_old_artist'],
            'artist_permit_status' => 'unchecked',
            'issue_date' => $permitDetails['from'] ? Carbon::parse($permitDetails['from'])->toDateString() : '',
            'expiry_date' => $permitDetails['to'] ? Carbon::parse($permitDetails['to'])->toDateString() : '',
            'work_location' => $permitDetails['location'],
            'company_id' => Auth::user()->EmpClientId,
            'created_by' => Auth::user()->user_id,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        $temp_id = $artistTempData->id;
        if ($artistDetails['id']) {
            $artistTempData->artist_id = $artistDetails['id'];
        } else {
            $artistTempData->artist_id = $temp_id;
        }

        $userid = Auth::user()->user_id;
        $pic_ext = session($userid .   '_ext');

        if (Storage::exists(session($userid . '_pic_file'))) {

            $check_path = 'public/' . $userid . '/artist/temp/' . $temp_id . '/photos';

            if (Storage::exists($check_path)) {
                $file_count = count(Storage::files($check_path));
                $file_nos = $file_count / 2;
                $next_file_no = $file_nos + 1;
            } else {
                $next_file_no = 1;
            }

            $newPath = 'public/' . $userid . '/artist/temp/' . $temp_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newPathLink = $userid . '/artist/temp/' . $temp_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newThumbPath = 'public/' . $userid . '/artist/temp/' . $temp_id . '/photos/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newThumbPathLink = $userid . '/artist/temp/' . $temp_id . '/photos/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

            Storage::move(session($userid . '_pic_file'), $newPath);
            Storage::move(session($userid . '_thumb_file'), $newThumbPath);

            $request->session()->forget($userid . '_pic_file');
            $request->session()->forget($userid . '_thumb_file');
            $request->session()->forget($userid . '_ext');
        } else {
            $getArtistPics = ArtistPermit::where('artist_id', $artistDetails['id'])->latest()->first();
            $newPathLink = $getArtistPics->original;
            $newThumbPathLink = $getArtistPics->thumbnail;
        }

        $artistTempData->original = $newPathLink;
        $artistTempData->thumbnail = $newThumbPathLink;
        $artistTempData->save();

        $issued_date = strtotime(date('Y-m-d', strtotime($permitDetails['from'])));
        $expired_date = strtotime(date('Y-m-d', strtotime($permitDetails['to'])));
        $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);
        if ($diff < 30) {
            $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->where('term', 'short')->get();
        } else {
            $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
        }

        $requirement_ids = [];
        foreach ($requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements->count();

        for ($j = 0; $j < $total; $j++) {

            $l = $requirement_ids[$j];
            $m = $j + 1;

            if (Storage::exists(session($userid . '_doc_file_' . $l))) {

                $ext = session($userid . '_ext_' . $l);

                $check_path = 'public/' . $userid . '/artist/temp/' . $temp_id;

                if (Storage::exists($check_path)) {
                    $file_count = count(Storage::files($check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = 1;
                }

                $newPath = 'public/' . $userid . '/artist/temp/' . $temp_id . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;
                $newPathLink = $userid . '/artist/temp/' . $temp_id . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                Storage::move(session($userid  . '_doc_file_' . $l), $newPath);
                Storage::delete(session($userid  . '_doc_file_' . $l));

                $request->session()->forget([$userid . '_doc_file_' . $l, $userid . '_ext_' . $l]);
            } else {
                $artistsD = ArtistPermitDocument::where('artist_permit_id', $artistDetails['ap_id'])->latest()->first();
                if ($artistsD) {
                    $newPathLink = $artistsD->path;
                } else {
                    $newPathLink = '';
                }
            }

            ArtistTempDocument::create([
                'issued_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['issue_date'])->toDateTimeString() : '',
                'expired_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['exp_date'])->toDateTimeString() : '',
                'created_at' =>  Carbon::now()->toDateTimeString(),
                'created_by' =>  Auth::user()->user_id,
                'temp_data_id' => $temp_id,
                'permit_id' => $permit_id,
                'path' =>  $newPathLink,
                'requirement_id' => $l,
                'status' => 'active'
            ]);
        }


        if ($artistTempData) {
            $result = ['success', 'Artist Added Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function clear_the_temp_data(Request $request)
    {
        $permit_id = $request->permit_id;
        $from = $request->from;
        $user_id = Auth::user()->user_id;

        if ($from == 'amend' || $from == 'renew' || $from == 'edit') {
            $rows = ArtistTempData::where('permit_id', $permit_id)->where('created_by', $user_id)->get();
            $temp_ids = [];
            foreach ($rows as $row) {
                array_push($temp_ids, $row->id);
            }
            ArtistTempData::where('permit_id', $permit_id)->where('created_by', $user_id)->delete();
            foreach ($temp_ids as $temp_id) {
                ArtistTempDocument::where('temp_data_id', $temp_id)->delete();
            }
            Permit::where('permit_id', $permit_id)->where('created_by', $user_id)->update(['is_edit' => 0]);
        } else if ($from == 'add_new') {
            $rows = ArtistTempData::where('permit_id', $permit_id)->where('created_by', $user_id)->where('status', '!=', 5)->get();
            $temp_ids = [];
            foreach ($rows as $row) {
                array_push($temp_ids, $row->id);
            }
            ArtistTempData::where('permit_id', $permit_id)->where('created_by', $user_id)->where('status', '!=', 5)->delete();
            foreach ($temp_ids as $temp_id) {
                ArtistTempDocument::where('temp_data_id', $temp_id)->delete();
            }
        }

        return;
    }

    public function store(Request $request)
    {
        $temp_permit_id = $request->temp_permit_id;
        $user_id = Auth::user()->user_id;
        $date_time = date('d_m_Y_H_i_s');
        $currentDateTime = Carbon::now()->toDateTimeString();

        $artist_temp_data = ArtistTempData::where([
            ['permit_id', $temp_permit_id],
            ['created_by', $user_id]
        ])->latest()->get();

        $artists_total = count($artist_temp_data);

        $work_location = $artist_temp_data[0]->work_location;
        $issue_date = $artist_temp_data[0]->issue_date;
        $expiry_date = $artist_temp_data[0]->expiry_date;

        $new_refer_no = $this->generateReferenceNumber();
        $permit = '';
        $from = ($artists_total > 0) ? $artist_temp_data[0]->process : '';

        if ($artists_total > 0) {

            $permit = Permit::create([
                'work_location' => $work_location,
                'issued_date' => $issue_date,
                'expired_date' => $expiry_date,
                'reference_number' => $new_refer_no,
                'permit_status' => 'new',
                'user_id' => $user_id,
                'created_by' => $user_id,
                'created_at' => $currentDateTime,
                'company_id' => Auth::user()->EmpClientId
            ]);

            $temp_ids = [];

            foreach ($artist_temp_data as $data) {

                array_push($temp_ids, $data->id);
                if ($data->status == 1) {
                    if ($data->artist_permit_id) {
                        ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update([
                            'artist_permit_status' => 'inactive'
                        ]);
                    }
                } else {
                    $updateArray = array(
                        'profession_id' => $data->profession_id,
                        'passport_number' => $data->passport_number,
                        'uid_number' => $data->uid_number,
                        'uid_expire_date' => $data->uid_expire_date,
                        'passport_expire_date' => $data->passport_expire_date,
                        'visa_type_id' => $data->visa_type,
                        'visa_number' => $data->visa_number,
                        'visa_expire_date' => $data->visa_expire_date,
                        'sponsor_name_en' => $data->sponsor_name_en,
                        'language_id' => $data->language,
                        'religion_id' => $data->religion,
                        'emirate_id' => $data->city,
                        'fax_number' => $data->fax_number,
                        'po_box' => $data->po_box,
                        'area_id' => $data->area,
                        'address_en' => $data->address_en,
                        'mobile_number' => $data->mobile_number,
                        'phone_number' => $data->phone_number,
                        'email' => $data->email,
                        'identification_number' => $data->emirates_id,
                        'updated_at' => $currentDateTime,
                        'updated_by' => $user_id,
                        'artist_permit_status' => $data->artist_permit_status,
                        'firstname_ar' => $data->firstname_ar,
                        'lastname_ar' => $data->lastname_ar,
                        'firstname_en' => $data->firstname_en,
                        'lastname_en' => $data->lastname_en,
                        'gender_id' => $data->gender,
                        'country_id' => $data->nationality,
                        'birthdate' => $data->birthdate,
                    );

                    $org = explode('/', $data->original);

                    // isset($org[2]) ? $is_temp = $org[2] : '';

                    if ($org[2] == 'temp') {

                        $pic_ext = '';

                        $exttt = end($org);
                        $ext = explode('.', $exttt);
                        $pic_ext = $ext[1];

                        $check_path = 'public/' .  $user_id . '/artist/' .  $data->artist_id . '/photos';

                        if (Storage::exists($check_path)) {
                            $file_count = count(Storage::files($check_path));
                            $file_nos = $file_count / 2;
                            $next_file_no = $file_nos + 1;
                        } else {
                            $next_file_no = 1;
                        }

                        $newPath = 'public/' . $user_id . '/artist/' . $data->artist_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
                        $newPathLink = $user_id . '/artist/' . $data->artist_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
                        $newThumbPath = 'public/' . $user_id . '/artist/' . $data->artist_id . '/photos/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
                        $newThumbPathLink = $user_id . '/artist/' . $data->artist_id . '/photos/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

                        $oldPath = 'public/' . $data->original;
                        $oldThumbPath = 'public/' . $data->thumbnail;

                        Storage::move($oldPath, $newPath);
                        Storage::move($oldThumbPath, $newThumbPath);
                    } else {
                        $newPathLink = $data->original;
                        $newThumbPathLink = $data->thumbnail;
                    }

                    $updateArray['original'] = $newPathLink;
                    $updateArray['thumbnail'] = $newThumbPathLink;

                    if ($data->artist_permit_id) {
                        if ($from == 'renew') {
                            $artistPermit =   ArtistPermit::create($updateArray);
                            $artistPermit->permit_id = $permit->permit_id;
                            $artistPermit->artist_id = $data->artist_id;
                            $artistPermit->created_at = $currentDateTime;
                            $artistPermit->created_by =  $user_id;
                            $artistPermit->save();
                        } else {
                            $artistPermit =  ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update($updateArray);
                        }
                        $artistID = $data->artist_id;
                        $artistPermitId = $data->artist_permit_id;
                        $artist_temp_document = ArtistTempDocument::where('artist_permit_id', $data->artist_permit_id)->get();
                    } else {
                        $artistPermit =   ArtistPermit::create($updateArray);
                        if ($data->is_old_artist == 1) {
                            $a = Artist::create([
                                'artist_status' => 'active',
                                'person_code' => $this->generatePersonCode(),
                                'created_at' => $currentDateTime,
                                'created_by' => $user_id
                            ]);
                            $artist_id = $a->artist_id;
                        } else {
                            $artist_id = $data->artist_id;
                        }
                        $artistPermit->permit_id = $permit->permit_id;
                        $artistPermit->artist_id = $artist_id;
                        $artistPermit->created_at = $currentDateTime;
                        $artistPermit->created_by =  $user_id;
                        $artistPermit->save();
                        $artistID = $artist_id;
                        $artistPermitId = $artistPermit->artist_permit_id;
                    }

                    $issued_date = strtotime($issue_date);
                    $expired_date = strtotime($expiry_date);
                    $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                    if ($diff < 30) {
                        $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->where('term', 'short')->get();
                    } else {
                        $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
                    }

                    $requirement_ids = [];
                    foreach ($requirements as $req) {
                        array_push($requirement_ids, $req->requirement_id);
                    }
                    $total = $requirements->count();

                    for ($j = 0; $j < $total; $j++) {

                        $l = $requirement_ids[$j];
                        $m = $j + 1;

                        $artist_temp_document = ArtistTempDocument::where('temp_data_id', $data->id)->where('requirement_id', $l)->orderBy('created_at', 'desc')->first();

                        $temp_path = $artist_temp_document->path;

                        if (!empty($artist_temp_document) && $artist_temp_document->doc_id == null) {

                            $te_pth = explode('/', $temp_path);

                            $extt = end($te_pth);
                            $exttt = explode('.', $extt);
                            $ext = $exttt[1];

                            $check_path = 'public/' . $user_id . '/artist/' . $artistID;

                            if (Storage::exists($check_path)) {
                                $file_count = count(Storage::files($check_path));
                                $next_file_no = $file_count + 1;
                            } else {
                                $next_file_no = 1;
                            }

                            $newPath = 'public/' . $user_id . '/artist/' . $artistID . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;
                            $newPathLink = $user_id . '/artist/' . $artistID . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                            $oldPath = 'public/' . $temp_path;

                            Storage::move($oldPath, $newPath);

                            ArtistPermitDocument::create([
                                'issued_date' => $artist_temp_document->issued_date,
                                'expired_date' => $artist_temp_document->expired_date,
                                'created_at' =>  Carbon::now()->toDateTimeString(),
                                'created_by' =>  Auth::user()->user_id,
                                'path' =>  $newPathLink,
                                'requirement_id' => $l,
                                'artist_permit_id' => $artistPermitId
                            ]);
                        }

                        Storage::delete($temp_path);
                    }
                }
            }

            if ($from == 'renew') {
                Permit::where('permit_id', $temp_permit_id)->update(['is_edit' => 0]);
                $permit->permit_number = $artist_temp_data[0]->permit_number;
                $permit->request_type = 'renew';
                $permit->save();
            } else {
                $permit->request_type = 'new';
                $permit->save();
            }

            ArtistTempData::where([
                ['permit_id', $temp_permit_id],
                ['created_by', $user_id]
            ])->delete();

            foreach ($temp_ids as $temps) {
                ArtistTempDocument::where('temp_data_id', $temps)->delete();
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
        $reqId =  $request->reqId;
        $artist_documents = ArtistPermitDocument::with('requirement')->where('artist_permit_id', $permit_id)->where('requirement_id', $reqId)->orderBy('created_at', 'desc')->first();
        return $artist_documents;
    }

    public function get_uploaded_artist_photo($code)
    {
        $artist_documents = Artist::with('artistPermit')->where('person_code', $code)->get();
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

    public function add_artist_to_permit($from, $id)
    {
        $data_bundle = $this->preLoadData();
        $data_bundle['permit_details'] = Permit::with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->where('permit_id', $id)->first();
        $data_bundle['permit_id'] = $id;
        $data_bundle['from'] = $from;
        return view('permits.artist.add_artist_to_permit', $data_bundle);
    }

    /* Helper functions */

    public function fetch_areas($id)
    {
        $areas = Areas::where('emirates_id', $id)->get();
        return $areas;
    }

    public function searchCode(Request $request)
    {
        $permit_id = $request->permit_id;
        $code = $request->code;
        $user_id = Auth::user()->user_id;
        $code_exists = ArtistTempData::where([
            ['permit_id', $permit_id],
            ['person_code', $code],
            ['created_by', $user_id],
        ])->exists();
        $artist_d = [];
        if (!$code_exists) {
            $artist_d = Artist::with('artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.Nationality', 'artistPermit.visaType')->where('person_code', $code)->first();
        }
        return $artist_d;
    }

    public function download_file(Request $request)
    {
        $permit_no = $request->artist_permit;
        $doc_name = $request->name;

        $filePath = ArtistPermitDocument::where('requirement_id', $doc_name)->where('artist_permit_id', $permit_no)->value('path');
        $headers = array(
            'Content-Type: image/jpeg , image/png , application/pdf',
        );

        return Storage::download(url('storage/' . $filePath), 'download', $headers);
    }

    public function fetch_artist_details(Request $request)
    {
        $ap_id = $request->ap_id;
        $artistPermitDetails = ArtistPermit::with('artist', 'artistPermitDocument', 'profession', 'Nationality', 'visaType')->where('artist_permit_id', $ap_id)->first();
        return $artistPermitDetails;
    }

    public function get_files_by_artist_permit_id(Request $request)
    {
        $artist_permit_id = $request->artist_permit_id;
        $reqName =  $request->reqName;
        $artist_documents = ArtistPermitDocument::where('artist_permit_id', $artist_permit_id)->where('requirement_id', $reqName)->orderBy('created_at', 'desc')->get();
        return $artist_documents;
    }

    public function get_photo_by_artist_permit_id($artist_permit_id)
    {
        $artist_documents = ArtistPermit::where('artist_permit_id', $artist_permit_id)->get();
        return $artist_documents;
    }


    public function delete_artist(Request $request)
    {
        $from = $request->del_artist_from;
        $permit_id = $request->del_permit_id;
        $temp_id = $request->del_temp_id;

        // Artistpermit::where('artist_permit_id', $artist_permit_id)->update(['artist_permit_status' => 'inactive']);
        ArtistTempData::where('id', $temp_id)->update(['status' => 1]);
        $result = ['success', 'Artist Removed successfully ', 'Success'];
        switch ($from) {
            case 'amend':
                $route_back = 'company/amend_permit/' . $permit_id;
                break;
            case 'renew':
                $route_back = 'company/renew_permit/' . $permit_id;
                break;
            case 'edit':
                $route_back = 'company/edit_permit/' . $permit_id;
                break;
            default:
                break;
        }
        // dd($route_back);
        return redirect(url($route_back))->with('message', $result);
    }

    public function update_artist_temp(Request $request)
    {
        $temp_id = $request->temp_id;
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);
        $date_time = date('d_m_Y_H_i_s');

        $artists = ArtistTempData::where('id', $temp_id)->update([
            'firstname_en' => $artistDetails['fname_en'],
            'firstname_ar' => $artistDetails['fname_ar'],
            'lastname_en' => $artistDetails['lname_en'],
            'lastname_ar' => $artistDetails['lname_ar'],
            'nationality' => $artistDetails['nationality'],
            'gender' => $artistDetails['gender'],
            'birthdate' => $artistDetails['dob'] ? Carbon::parse($artistDetails['dob'])->toDateString() : '',
            'profession_id' => $artistDetails['profession'],
            'uid_number' => $artistDetails['uidNumber'],
            'passport_number' => $artistDetails['passport'],
            'uid_expire_date' => $artistDetails['uidExp'] ? Carbon::parse($artistDetails['uidExp'])->toDateString() : '',
            'passport_expire_date' => $artistDetails['ppExp'] ? Carbon::parse($artistDetails['ppExp'])->toDateString() : '',
            'visa_type' => $artistDetails['visaType'],
            'visa_number' => $artistDetails['visaNumber'],
            'visa_expire_date' => $artistDetails['visaExp'] ? Carbon::parse($artistDetails['visaExp'])->toDateString() : '',
            'sponsor_name_en' => $artistDetails['spName'],
            'emirates_id' => $artistDetails['idNo'],
            'language' => $artistDetails['language'],
            'religion' => $artistDetails['religion'],
            'city' => $artistDetails['city'],
            'area' => $artistDetails['area'],
            'address_en' => $artistDetails['address'],
            'mobile_number' => $artistDetails['mobile'],
            'phone_number' => $artistDetails['landline'],
            'po_box' => $artistDetails['po_box'],
            'fax_number' => $artistDetails['fax_number'],
            'email' => $artistDetails['email'],
        ]);

        $userid = Auth::user()->user_id;

        $pic_ext = session($userid . '_ext');

        if (Storage::exists(session($userid . '_pic_file'))) {

            $check_path = 'public/' . $userid . '/artist/temp/' . $temp_id . '/photos';

            if (Storage::exists($check_path)) {
                $file_count = count(Storage::files($check_path));
                $file_nos = $file_count / 2;
                $next_file_no = $file_nos + 1;
            } else {
                $next_file_no = 1;
            }

            $newPath = 'public/' . $userid . '/artist/temp/' . $temp_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newPathLink = $userid . '/artist/temp/' . $temp_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newThumbPath = 'public/' . $userid . '/artist/temp/' . $temp_id . '/photos/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newThumbPathLink = $userid . '/artist/temp/' . $temp_id . '/photos/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

            Storage::move(session($userid .  '_pic_file'), $newPath);
            Storage::move(session($userid . '_thumb_file'), $newThumbPath);

            $request->session()->forget([$userid . '_pic_file', $userid . '_thumb_file', $userid . '_ext']);

            $imgArr = array(
                'original' => $newPathLink,
                'thumbnail' => $newThumbPathLink
            );

            ArtistTempData::where('id', $temp_id)->update($imgArr);
        }

        $issued_date = strtotime($request->issue_d);
        $expired_date = strtotime($request->expiry_d);
        $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
        if ($diff < 30) {
            $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->where('term', 'short')->get();
        } else {
            $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
        }

        $requirement_ids = [];
        foreach ($requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements->count();

        for ($j = 0; $j < $total; $j++) {

            $l = $requirement_ids[$j];
            $m = $j + 1;

            if (Storage::exists(session($userid . '_doc_file_' . $l))) {

                $ext = session($userid . '_ext_' . $l);

                $check_path = 'public/' . $userid . '/artist/temp/' . $temp_id;

                if (Storage::exists($check_path)) {
                    $file_count = count(Storage::files($check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = 1;
                }

                $newPath = 'public/' . $userid . '/artist/temp/' . $temp_id . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;
                $newPathLink = $userid . '/artist/temp/' . $temp_id . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                Storage::move(session($userid .  '_doc_file_' . $l), $newPath);
                Storage::delete(session($userid .  '_doc_file_' . $l));

                $request->session()->forget([$userid . '_doc_file_' . $l, $userid . '_ext_' . $l]);

                ArtistTempDocument::where('requirement_id', $l)
                    ->where('temp_data_id', $temp_id)
                    ->update(['status' => 1]);

                ArtistTempDocument::create([
                    'issued_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'path' =>  $newPathLink,
                    'permit_id' => $request->permitId,
                    'requirement_id' => $l,
                    'temp_data_id' => $temp_id,
                    'status' => 3
                ]);
            } else {
                $add = ArtistTempDocument::where('temp_data_id', $temp_id)->where('requirement_id', $l)->orderBy('created_at', 'desc')->first();

                if ($documentDetails[$m] != null) {
                    if ($add->issued_date != Carbon::parse($documentDetails[$m]['issue_date'])->toDateString() || $add->expired_date != Carbon::parse($documentDetails[$m]['exp_date'])->toDateString()) {
                        ArtistTempDocument::create([
                            'issued_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['issue_date'])->toDateTimeString() : '',
                            'expired_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['exp_date'])->toDateTimeString() : '',
                            'created_at' =>  Carbon::now()->toDateTimeString(),
                            'created_by' =>  Auth::user()->user_id,
                            'artist_permit_id' => $add->artist_permit_id,
                            'path' =>  $add->path,
                            'permit_id' => $add->permit_id,
                            'doc_id' => $add->doc_id,
                            'requirement_id' => $l,
                            'temp_data_id' => $temp_id,
                            'status' => 3
                        ]);
                    }
                }
            }
        }

        if ($artists) {
            $result = ['success', 'Artist Updated Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function permit($id, $status)
    {
        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.profession')->where('permit_id', $id)->first();

        Permit::where('permit_id', $id)->update(["lock" => Carbon::now()->toDateTimeString()]);

        $edit = $permit_details->is_edit;

        if ($edit == 0) {

            ArtistTempData::where('permit_id', $id)->delete();
            ArtistTempDocument::where('permit_id', $id)->delete();

            foreach ($permit_details->artistPermit as $pd) {

                $artist_temp = ArtistTempData::create([
                    'firstname_en' => $pd->firstname_en,
                    'firstname_ar' =>  $pd->firstname_ar,
                    'lastname_en' =>  $pd->lastname_en,
                    'lastname_ar' =>  $pd->lastname_ar,
                    'nationality' =>  $pd->country_id,
                    'gender' =>  $pd->gender_id,
                    'birthdate' =>  $pd->birthdate ? Carbon::parse($pd->birthdate)->toDateString() : '',
                    'artist_id' => $pd->artist_id,
                    'permit_id' => $pd->permit_id,
                    'profession_id' => $pd->profession_id,
                    'original' => $pd->original,
                    'thumbnail' => $pd->thumbnail,
                    'passport_number' => $pd->passport_number,
                    'uid_number' => $pd->uid_number,
                    'uid_expire_date' => $pd->uid_expire_date ? Carbon::parse($pd->uid_expire_date)->toDateString() : '',
                    'passport_expire_date' => $pd->passport_expire_date ? Carbon::parse($pd->passport_expire_date)->toDateString() : '',
                    'visa_type' => $pd->visa_type_id,
                    'visa_number' => $pd->visa_number,
                    'visa_expire_date' => $pd->visa_expire_date ? Carbon::parse($pd->visa_expire_date)->toDateString() : '',
                    'sponsor_name_en' => $pd->sponsor_name_en,
                    'sponsor_name_ar' => $pd->sponsor_name_ar,
                    'language' => $pd->language_id,
                    'religion' => $pd->religion_id,
                    'city' => $pd->emirate_id,
                    'fax_number' => $pd->fax_number,
                    'po_box' => $pd->po_box,
                    'area' => $pd->area_id,
                    'address_en' => $pd->address_en,
                    'address_ar' => $pd->address_ar,
                    'mobile_number' => $pd->mobile_number,
                    'phone_number' => $pd->phone_number,
                    'status' => 0,
                    'email' => $pd->email,
                    'emirates_id' => $pd->identification_number,
                    'artist_permit_id' => $pd->artist_permit_id,
                    'person_code' => $pd->artist['person_code'],
                    'is_old_artist' => 2,
                    'artist_permit_status' => $pd->artist_permit_status,
                    'issue_date' => $permit_details->issued_date,
                    'expiry_date' => $permit_details->expired_date,
                    'work_location' => $permit_details->work_location,
                    'company_id' => $permit_details->company_id,
                    'created_by' => $permit_details->created_by,
                    'process' => $status,
                ]);

                if ($status == 'renew') {
                    $old_permit_number = $permit_details->permit_number;
                    $number = explode('-', $old_permit_number);
                    $new_pn = isset($number[1]) ? $number[0] . '-' . $number[1] + 1 : $old_permit_number . '-' . '01';
                    $artist_temp->permit_number = $new_pn;
                } else {
                    $artist_temp->permit_number =  $permit_details->permit_number;
                }

                $artist_temp->save();

                $permit_doc_details = \App\ArtistPermitDocument::where('artist_permit_id', $pd->artist_permit_id)->orderBy('created_at', 'desc')->get()->unique('requirement_id');


                foreach ($permit_doc_details as $ap) {
                    ArtistTempDocument::create([
                        'status' => 2,
                        'issued_date' => $ap->issued_date,
                        'expired_date' => $ap->expired_date,
                        'path' => $ap->path,
                        'requirement_id' => $ap->requirement_id,
                        'artist_permit_id' => $ap->artist_permit_id,
                        'permit_id' => $pd->permit_id,
                        'temp_data_id' => $artist_temp->id,
                        'doc_id' => $ap->permit_document_id,
                        'created_at' => $ap->created_at,
                        'updated_at' => $ap->updated_at
                    ]);
                }
            }
        }


        Permit::where('permit_id', $id)->update(['is_edit' => 1]);

        $data_bundle['permit_details'] =  Permit::where('permit_id', $id)->first();
        $data_bundle['artist_details'] = ArtistTempData::where('permit_id', $id)->where('status', 0)->get();
        $data_bundle['staff_comments'] = PermitComment::where('permit_id', $id)->where('type', 1)->get();
        $routeTo = '';
        if ($status == 'edit') {
            $routeTo = 'permits.artist.edit_permit';
        } else if ($status == 'amend') {
            $routeTo = 'permits.artist.amend_permit';
        } else if ($status == 'renew') {
            $routeTo = 'permits.artist.renew_permit';
        }
        return view($routeTo, $data_bundle);
    }


    // function add_to_artist_temp_data(Request $request)
    // {

    //     $permit_id = $request->permit_id;
    //     $artistDetails = json_decode($request->artistD, true);
    //     $documentDetails = json_decode($request->documentD, true);

    //     $tempData = ArtistTempData::create([
    //         'firstname_en' => $artistDetails['fname_en'],
    //         'firstname_ar' => $artistDetails['fname_ar'],
    //         'lastname_en' => $artistDetails['lname_en'],
    //         'lastname_ar' => $artistDetails['lname_ar'],
    //         'nationality' => $artistDetails['nationality'],
    //         'gender' => $artistDetails['gender'],
    //         'uid_number' => $artistDetails['uidNumber'],
    //         'birthdate' => $artistDetails['dob'] ? Carbon::parse($artistDetails['dob'])->toDateString() : '',
    //         'uid_expire_date' => $artistDetails['uidExp'] ? Carbon::parse($artistDetails['uidExp'])->toDateString() : '',
    //         'passport_number' => $artistDetails['passport'],
    //         'passport_expire_date' => $artistDetails['ppExp'] ? Carbon::parse($artistDetails['ppExp'])->toDateString() : '',
    //         'visa_type' => $artistDetails['visaType'],
    //         'visa_number' => $artistDetails['visaNumber'],
    //         'visa_expire_date' => $artistDetails['visaExp'] ? Carbon::parse($artistDetails['visaExp'])->toDateString() : '',
    //         'sponsor_name_en' => $artistDetails['spName'],
    //         'emirates_id' => $artistDetails['idNo'],
    //         'language' => $artistDetails['language'],
    //         'religion' => $artistDetails['religion'],
    //         'profession_id' => $artistDetails['profession'],
    //         'city' => $artistDetails['city'],
    //         'area' => $artistDetails['area'],
    //         'address_en' => $artistDetails['address'],
    //         'mobile_number' => $artistDetails['mobile'],
    //         'phone_number' => $artistDetails['landline'],
    //         'email' => $artistDetails['email'],
    //         'permit_id' => $permit_id,
    //         'created_at' => Carbon::now()->toDateTimeString(),
    //         'person_code' => 0,
    //         'po_box' => $artistDetails['po_box'],
    //         'fax_number' => $artistDetails['fax_number'],
    //         'status' => 0,
    //         'is_old_artist' => $artistDetails['is_old_artist'],
    //         'artist_permit_status' => 'unchecked'
    //     ]);

    //     $tempData->artist_id = $artistDetails['is_old_artist']  == 2 ? $artistDetails['artist_id'] : '';
    //     $tempData->artist_permit_id = $artistDetails['is_old_artist']  == 2 ? $artistDetails['artist_permit_id'] : '';

    //     $tempData->save();

    //     $company_array = Company::find(Auth::user()->EmpClientId);
    //     $company_name = str_replace(' ', '_', $company_array->company_name);
    //     $company_name = strtolower($company_name);

    //     $userid = Auth::user()->user_id;

    //     $pic_ext = session($userid . '_ext');

    //     if (Storage::exists(session($userid .  '_pic_file'))) {

    //         $check_path = 'public/' . $company_name . '/artist_permit/temp/' . $tempData->id . '/photos';

    //         if (Storage::exists($check_path)) {
    //             $file_count = count(Storage::files($check_path));
    //             $file_nos = $file_count / 2;
    //             $next_file_no = $file_nos + 1;
    //         } else {
    //             $next_file_no = 1;
    //         }

    //         $date = date('d_m_Y_H_i_s');

    //         $newPath = 'public/' . $company_name . '/artist_permit/temp/' . $tempData->id . '/photos/photo_' . $next_file_no . '_' . $date . '.' . $pic_ext;
    //         $newPathLink = $company_name . '/artist_permit/temp/' . $tempData->id . '/photos/photo_' . $next_file_no . '_' . $date . '.' . $pic_ext;
    //         $newThumbPath = 'public/' . $company_name . '/artist_permit/temp/' . $tempData->id . '/photos/thumb_' . $next_file_no . '_' . $date  . '.' . $pic_ext;
    //         $newThumbPathLink = $company_name . '/artist_permit/temp/' . $tempData->id . '/photos/thumb_' . $next_file_no . '_' . $date . '.' . $pic_ext;

    //         Storage::move(session($userid .  '_pic_file'), $newPath);
    //         Storage::move(session($userid . '_thumb_file'), $newThumbPath);

    //         session()->forget([$userid . '_pic_file', $userid . '_thumb_file', $userid .  '_ext']);

    //         $tempData->original  = $newPathLink;
    //         $tempData->thumbnail = $newThumbPathLink;
    //         $tempData->save();
    //     }


    //     $issued_date = strtotime($request->from);
    //     $expired_date = strtotime($request->to);
    //     $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
    //     if ($diff < 30) {
    //         $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->where('term', 'short')->get();
    //     } else {
    //         $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
    //     }

    //     $requirement_ids = [];
    //     foreach ($requirements as $req) {
    //         array_push($requirement_ids, $req->requirement_id);
    //     }
    //     $total = $requirements->count();

    //     for ($j = 0; $j < $total; $j++) {

    //         $l = $requirements[$j];
    //         $m = $j + 1;

    //         if (Storage::exists(session($userid .  '_doc_file_' . $l))) {

    //             $ext = session($userid . '_ext_' . $l);

    //             $check_path = 'public/' . $company_name . '/artist_permit/temp/' . $tempData->id;

    //             if (Storage::exists($check_path)) {
    //                 $file_count = count(Storage::files($check_path));
    //                 $next_file_no = $file_count + 1;
    //             } else {
    //                 $next_file_no = 1;
    //             }
    //             $date = date('d_m_Y_H_i_s');
    //             $newPath = 'public/' . $company_name . '/artist_permit/temp/' . $tempData->id . '/document_' . $next_file_no . '_' . $date . '.' . $ext;
    //             $newPathLink = $company_name . '/artist_permit/temp/' . $tempData->id . '/document_' . $next_file_no . '_' . $date . '.' . $ext;
    //             Storage::move(session($userid . '_doc_file_' . $l), $newPath);
    //             Storage::delete(session($userid .  '_doc_file_' . $l));
    //             session()->forget([$userid .  '_doc_file_' . $l, $userid . '_ext_' . $l]);
    //         } else {
    //             $artistsD = ArtistPermitDocument::where('artist_permit_id', $tempData->artist_permit_id)->latest()->first();
    //             $newPathLink = $artistsD->path;
    //         }

    //         ArtistTempDocument::create([
    //             'issued_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['issue_date'])->toDateTimeString() : '',
    //             'expired_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['exp_date'])->toDateTimeString() : '',
    //             'created_at' =>  Carbon::now()->toDateTimeString(),
    //             'created_by' =>  Auth::user()->user_id,
    //             'artist_permit_id' => 0,
    //             'permit_id' => $permit_id,
    //             'temp_data_id' => $tempData->id,
    //             'doc_id' => 0,
    //             'path' =>  $newPathLink,
    //             'requirement_id' => $l,
    //             'status' => 3
    //         ]);
    //     }

    //     if ($tempData) {
    //         $result = ['success', 'Artist Added Successfully', 'Success'];
    //     } else {
    //         $result = ['error', 'Error, Please Try Again', 'Error'];
    //     }

    //     return response()->json(['message' => $result]);
    // }

    public function edit_artist($id, $from)
    {
        $permit_id = ArtistTempData::where('id', $id)->value('permit_id');
        $data_bundle = $this->preLoadData();
        $data_bundle['artist_details'] = ArtistTempData::with('Nationality', 'Profession')->where('id', $id)->first();
        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'permit', 'artistPermitDocument', 'profession')->where('permit_id', $permit_id)->first();
        $data_bundle['from'] = $from;
        $url = '';
        if ($from == 'amend') {
            $url = 'permits.artist.replace_artist';
        } else {
            $url = 'permits.artist.common.edit_artist';
        }
        return view($url, $data_bundle);
    }

    public function update_checklist($id)
    {
        ArtistPermitCheck::where('artist_permit_id', $id)->update(['status' => 1]);
    }

    public function fetch_drafts()
    {
        $user_id = Auth::user()->user_id;
        $drafts = ArtistTempData::with('profession')->where([
            ['status', 5],
            ['created_by', $user_id],
        ])->groupBy('permit_id')->get();
        //->has('artistPermitDocument')

        return Datatables::of($drafts)->editColumn('created_at', function ($draft) {
            if ($draft->created_at) {
                return  $draft->created_at;
            } else {
                // return 'none';
            }
        })->editColumn('issued_date', function ($draft) {
            if ($draft->issue_date) {
                return  Carbon::parse($draft->issue_date)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->editColumn('expired_date', function ($draft) {
            if ($draft->expiry_date) {
                return  Carbon::parse($draft->expiry_date)->format('d-M-Y');
            } else {
                return 'None';
            }
        })->addColumn('action', function ($permit) {
            return '<a href="' . route('company.view_draft_details', $permit->permit_id) . '"><span class="kt-badge kt-badge--warning kt-badge--inline">View / Update</span></a>';
        })->addColumn('details', function ($permit) {
            return '<a href="' . route('company.get_draft_details', $permit->permit_id) . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    public function get_draft_details($permit_id)
    {
        $user_id = Auth::user()->user_id;
        $data['draft_details'] = ArtistTempData::with('profession')->where([
            ['status', 5],
            ['created_by', $user_id],
        ])->where('permit_id', $permit_id)->get();
        return view('permits.artist.view_draft_details', $data);
    }

    public function view_draft_details($id)
    {
        $user_id = Auth::user()->user_id;
        $data['artist_details'] = ArtistTempData::with('profession', 'nationality', 'ArtistTempDocument')->where([
            ['status', 5],
            ['created_by', $user_id],
        ])->where('permit_id', $id)->get();

        $data['permit_id'] = $id;

        return view('permits.artist.draft_view', $data);
    }

    public function add_draft(Request $request)
    {
        $temp_permit_id = $request->temp_permit_id;
        $user_id = Auth::user()->user_id;

        $update = ArtistTempData::where([
            ['permit_id', $temp_permit_id],
            ['created_by', $user_id]
        ])->update([
            'status' => 5
        ]);

        if ($update) {
            $result = ['success', 'Draft Saved Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function edit_artist_draft($temp_id)
    {
        $permit_id = ArtistTempData::where('id', $temp_id)->value('permit_id');

        $data_bundle = $this->preLoadData();
        $data_bundle['artist_details'] = ArtistTempData::with('Nationality', 'Profession')->where('id', $temp_id)->first();
        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'permit', 'artistPermitDocument', 'profession')->where('permit_id', $permit_id)->first();
        return view('permits.artist.draft.edit_artist', $data_bundle);
    }



    public function update_permit(Request $request)
    {
        $permit_id = $request->permit_id;

        $artist_temp_data = ArtistTempData::with('ArtistTempDocument')->where('permit_id', $permit_id)->get();
        $user_id = Auth::user()->user_id;
        $date_time = date('d_m_Y_H_i_s');

        foreach ($artist_temp_data as $data) {
            if ($data->status == 1) {
                if ($data->artist_permit_id) {
                    ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update([
                        'type' => 'remove',
                        'deleted_at' => Carbon::now()
                    ]);
                }
            } else {

                $updateArray = array(
                    'firstname_ar' => $data->firstname_ar,
                    'lastname_ar' => $data->lastname_ar,
                    'firstname_en' => $data->firstname_en,
                    'lastname_en' => $data->lastname_en,
                    'gender_id' => $data->gender,
                    'country_id' => $data->nationality,
                    'birthdate' => $data->birthdate,
                    'profession_id' => $data->profession_id,
                    'passport_number' => $data->passport_number,
                    'uid_number' => $data->uid_number,
                    'uid_expire_date' => $data->uid_expire_date,
                    'passport_expire_date' => $data->passport_expire_date,
                    'visa_type_id' => $data->visa_type,
                    'visa_number' => $data->visa_number,
                    'visa_expire_date' => $data->visa_expire_date,
                    'sponsor_name_en' => $data->sponsor_name_en,
                    'language_id' => $data->language,
                    'religion_id' => $data->religion,
                    'emirate_id' => $data->city,
                    'fax_number' => $data->fax_number,
                    'po_box' => $data->po_box,
                    'area_id' => $data->area,
                    'address_en' => $data->address_en,
                    'mobile_number' => $data->mobile_number,
                    'phone_number' => $data->phone_number,
                    'email' => $data->email,
                    'identification_number' => $data->emirates_id,
                    'updated_at' => Carbon::now()->toDateTimeString(),
                    'updated_by' => $user_id,
                    'artist_permit_status' => $data->artist_permit_status
                );

                $org = explode('/', $data->original);

                // isset($org[2]) ? $is_temp = $org[2] : '';

                if ($org[2] == 'temp') {

                    $exttt = end($org);
                    $ext = explode('.', $exttt);
                    $pic_ext = $ext[1];


                    $check_path = 'public/' .  $user_id . '/artist/' .  $data->artist_id . '/photos';

                    if (Storage::exists($check_path)) {
                        $file_count = count(Storage::files($check_path));
                        $file_nos = $file_count / 2;
                        $next_file_no = $file_nos + 1;
                    } else {
                        $next_file_no = 1;
                    }

                    $newPath = 'public/' . $user_id . '/artist/' . $data->artist_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
                    $newPathLink = $user_id . '/artist/' . $data->artist_id . '/photos/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
                    $newThumbPath = 'public/' . $user_id . '/artist/' . $data->artist_id . '/photos/thumb_' . '_' . $date_time . $next_file_no . '.' . $pic_ext;
                    $newThumbPathLink = $user_id . '/artist/' . $data->artist_id . '/photos/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

                    $oldPath = 'public/' . $data->original;
                    $oldThumbPath = 'public/' . $data->thumbnail;

                    Storage::move($oldPath, $newPath);
                    Storage::move($oldThumbPath, $newThumbPath);
                } else {
                    $newPathLink = $data->original;
                    $newThumbPathLink = $data->thumbnail;
                }

                $updateArray['original'] = $newPathLink;
                $updateArray['thumbnail'] = $newThumbPathLink;

                if ($data->artist_permit_id) {

                    $artistPermit =  ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update($updateArray);
                    $artistID = $data->artist_id;
                    $artistPermitId = $data->artist_permit_id;
                    $artist_temp_document = ArtistTempDocument::where('artist_permit_id', $data->artist_permit_id)->get();
                    // $artist_old_documents = ArtistPermitDocument::where('artist_permit_id', $data->artist_permit_id)->get();
                } else {
                    $artistPermit =   ArtistPermit::create($updateArray);
                    if ($data->is_old_artist == 1) {
                        $a = Artist::create([
                            'artist_status' => 'active',
                            'person_code' => $this->generatePersonCode(),
                            'created_at' => Carbon::now()->toDateTimeString(),
                            'created_by' => Auth::user()->user_id
                        ]);

                        $artist_id = $a->artist_id;
                    } else {
                        $artist_id = $data->artist_id;
                    }
                    $artistPermit->permit_id = $data->permit_id;
                    $artistPermit->artist_id = $artist_id;
                    $artistPermit->created_at = Carbon::now()->toDateTimeString();
                    $artistPermit->created_by =  $user_id;
                    $artistPermit->save();
                    $artistID = $artist_id;
                    $artistPermitId = $artistPermit->artist_permit_id;
                }

                $issued_date = strtotime($data->issue_date);
                $expired_date = strtotime($data->expiry_date);

                $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                if ($diff < 30) {
                    $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->where('term', 'short')->get();
                } else {
                    $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
                }

                $requirement_ids = [];
                foreach ($requirements as $req) {
                    array_push($requirement_ids, $req->requirement_id);
                }
                $total = $requirements->count();

                for ($j = 0; $j < $total; $j++) {

                    $l = $requirement_ids[$j];
                    $m = $j + 1;

                    $artist_temp_document = ArtistTempDocument::where('temp_data_id', $data->id)->where('requirement_id', $l)->orderBy('created_at', 'desc')->first();

                    if (!empty($artist_temp_document) && $artist_temp_document->doc_id == null) {

                        $temp_path = $artist_temp_document->path;
                        $te_pth = explode('/', $temp_path);

                        $exttt = end($te_pth);
                        $ex = explode('.', $exttt);
                        $ext = $ex[1];


                        $check_path = 'public/' . $user_id . '/artist/' . $artistID;

                        if (Storage::exists($check_path)) {
                            $file_count = count(Storage::files($check_path));
                            $next_file_no = $file_count + 1;
                        } else {
                            $next_file_no = 1;
                        }

                        $newPath = 'public/' . $user_id . '/artist/' . $artistID . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;
                        $newPathLink = $user_id . '/artist/' . $artistID . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                        $oldPath = 'public/' . $temp_path;

                        Storage::move($oldPath, $newPath);

                        ArtistPermitDocument::create([
                            'issued_date' => $artist_temp_document->issued_date,
                            'expired_date' => $artist_temp_document->expired_date,
                            'created_at' =>  Carbon::now()->toDateTimeString(),
                            'created_by' =>  Auth::user()->user_id,
                            'path' =>  $newPathLink,
                            'requirement_id' => $artist_temp_document->requirement_id,
                            'artist_permit_id' => $artistPermitId
                        ]);
                    }
                }
            }
        }

        $old_permit_status = Permit::where('permit_id', $permit_id)->value('permit_status');

        if ($old_permit_status == 'modification request') {
            $result = Permit::where('permit_id', $permit_id)->update(['permit_status' => 'modified', 'is_edit' => 0, 'lock' => null]);
        } else if ($old_permit_status == 'active') {
            $result = Permit::where('permit_id', $permit_id)->update(['permit_status' => 'new', 'is_edit' => 0, 'request_type' => 'amend']);
        } else {
            $result = Permit::where('permit_id', $permit_id)->update(['permit_status' => 'new', 'is_edit' => 0]);
        }

        if ($result) {
            ArtistTempData::where('permit_id', $permit_id)->delete();
            ArtistTempDocument::where('permit_id', $permit_id)->delete();
            $message = ['success', 'Permit Added Successfully', 'Success'];
        } else {
            $message = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $message]);
    }

    public function get_temp_photo_temp_id($id)
    {
        $artist_documents = ArtistTempData::where('id', $id)->get();
        return $artist_documents;
    }

    public function get_temp_files_by_temp_id(Request $request)
    {
        $temp_id = $request->temp_id;
        $reqid =  $request->reqId;
        $artist_documents = ArtistTempDocument::with('requirement')->where('temp_data_id', $temp_id)->where('requirement_id', $reqid)->orderBy('created_at', 'desc')->first();
        return $artist_documents;
    }

    public function update_is_edit($id)
    {
        Permit::where('permit_id', $id)->update(['is_edit' => 0, "lock" => null]);
        return true;
    }


    public function download_permit(Permit $permit)
    {
        $data['company_details'] = Company::find(Auth::user()->EmpClientId);
        $data['artist_details'] = $permit->artistPermit()->with('artist', 'profession', 'Nationality')->get();
        $data['permit_details'] = $permit;

        $permitNumber = $permit->permit_number;

        $pdf = PDF::loadView('permits.artist.permit_print', $data, [], [
            'title' => 'Artist Permit',
            'default_font_size' => 10
        ]);
        return $pdf->stream('Permit-' . $permitNumber . '.pdf');
    }

    // Make Payment Function

    public function make_payment($id)
    {
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->where('permit_id', $id)->first();
        return view('permits.artist.payment', $data_bundle);
    }

    // Payment Gateway


    public function payment_gateway(Permit $permit)
    {
        $id = $permit->permit_id;
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->where('permit_id', $id)->first();
        return view('permits.artist.payment_gateway', $data_bundle);
    }

    public function payment(Permit $permit)
    {
        $transArr = Transaction::create([
            'transaction_type' => 'artist',
            'transaction_date' => Carbon::now(),
            'company_id' => Auth::user()->EmpClientId,
        ]);

        foreach ($permit->artistPermit() as $artist) {
            $transArr->artistPermitTransaction()->create([
                'vat' => $artist->profession->amount * 0.05,
                'amount' => $artist->profession->amount,
                'artist_permit_id' => $artist->artist_permit_id,
                'transaction_id' => $transArr->transaction_id
            ]);
        }

        $permit_number = $this->generatePermitNumber();

        $issued_date = strtotime($permit->issued_date);
        $expired_date = strtotime($permit->exprired_date);
        $today_date = strtotime(date('Y-m-d'));

        $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);

        if ($issued_date <= $today_date) {
            $new_issued_date = date('Y-m-d');
            $new_expiry_date = date('Y-m-d', strtotime($new_issued_date . ' + ' . $diff . ' days'));
            $permit->update(['issued_date' =>  $new_issued_date, 'expired_date' => $new_expiry_date]);
        }

        $permit->update(['permit_status' => 'active', 'permit_number' => $permit_number]);

        if ($transArr) {
            $result = ['success', 'Payment Done Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return redirect('company/happiness_center/' . $permit->permit_id);
    }

    public function happiness_center($id)
    {
        return view('permits.artist.happinessmeter', ['id' => $id]);
    }

    public function submit_happiness(Request $request)
    {
        $id = $request->permit_id;
        $rating = $request->rating;

        $artists = ArtistPermit::findOrFail($id);

        $artists->update([
            'meter' => $rating
        ]);

        return view('permits.happinessmeter', ['id' => $id]);
    }
}
