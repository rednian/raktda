<?php

namespace App\Http\Controllers\Company;

use Auth;
use Excel;
use URL;
use Cookie;
use DB;
use PDF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use App\Country;
use Carbon\Carbon;
use App\Artist;
use App\ArtistPermitDocument;
use App\ArtistPermit;
use App\Permit;
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
use App\GeneralSetting;
use App\Happiness;
use App\EventTruck;
use App\EventTransaction;
use App\EventLiquor;
use App\CompanyComment;
use App\Transaction;
use App\PermitReference;
use Intervention\Image\ImageManagerStatic as Image;

class ArtistController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        Permit::where('created_by', Auth::user()->user_id)->update(['is_edit' => 0]);
        ArtistTempData::where('created_by', Auth::user()->user_id )->where('status' , 0)->delete();
        Permit::whereDate('expired_date', '<', Carbon::now())->update(['permit_status' => 'expired']);
        return view('permits.artist.index');
    }

    // Artist Permit Dashboard Table One

    public function fetch_applied(Request $request)
    {
        if($request->ajax())
        {   
            return $this->datatable_function('applied');
        }
    }

    public function fetch_valid(Request $request)
    {
        if($request->ajax())
        {
            return $this->datatable_function('valid');
        }
    }

    function datatable_function($status)
    {
        $permits = Permit::where('created_by', Auth::user()->user_id);
        if ($status == 'applied') {
            $permits->whereNotIn('permit_status', ['active', 'expired']);
        } else if ($status == 'valid') {
            $permits->whereIn('permit_status', ['active', 'expired']);
        }
        $permits->orderBy('created_at', 'desc')->get();

        $amend_grace = getSettings()->artist_permit_grace_period_amendment;
        $renew_grace = getSettings()->artist_permit_grace_period_renew;

        //with('artist', 'artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->

        return Datatables::of($permits)->editColumn('issued_date', function ($permits) {
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
        })->editColumn('term', function ($permits) {
            $term = '';
            if($permits->term == 'long')
            {
                return __('Long Term');
            }else {
                return __('Short Term');
            }
            // return ucwords($permits->term);
        })->editColumn('work_location', function ($permits) {
            return getLangId() == 1 ? $permits->work_location : $permits->work_location_ar ;
        })->editColumn('permit_id', function ($permits) use ($status) {
            // $noofapproved = 0;
            // $total = count($permits->artistPermit);
            // foreach ($permits->artistPermit as $ap) {
            //     if ($ap->artist_permit_status == 'approved') {
            //         $noofapproved++;
            //     }
            // }
            // if ($status == 'valid') {
            //     return 'Approved ' . $noofapproved . ' of ' . $total;
            // } else {
                return  $permits->artistPermit;
            // }
        })->addColumn('action', function ($permit) use ($status, $amend_grace, $renew_grace) {
            if(check_is_blocked()['status'] == 'blocked'){
                return ;
            }
            $approved_artist = false;
            foreach ($permit->artistPermit as $ap) {
                if ($ap->artist_permit_status == 'approved') {
                    $approved_artist = true;
                }
            }
            switch ($status) {
                case 'applied':
                    if ($permit->permit_status == 'approved-unpaid') {
                         if($permit->event) {
                              if($permit->event->firm == 'government' || $permit->event->exempt_payment == 1)
                              {
                                return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.happiness_center', $permit->permit_id) . '" ><span class="kt-badge kt-badge--success kt-badge--inline">'.__('Happiness').'</span></a>';
                              }
                         }
                        return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.make_payment', $permit->permit_id) . '" ><span class="kt-badge kt-badge--success kt-badge--inline">'.__('Payment').'</span></a>';
                    } else if ($permit->permit_status == 'new') { //&& $permit->lock == ''
                       
                    } else if ($permit->permit_status == 'modification request') {
                        $pay_btn = '';
                        if ($approved_artist) {
                            if($permit->event) {
                                if($permit->event->firm == 'government')
                                {
                                    $pay_btn = '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.happiness_center', $permit->permit_id) . '" ><span class="kt-badge kt-badge--info kt-badge--inline">'.__('Happiness').'</span></a>';
                                }
                            }else {
                                $pay_btn = '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.make_payment', $permit->permit_id) . '"><span class="kt-badge kt-badge--success kt-badge--inline">'.__('Payment').'</span></a>';
                            }
                        }
                        return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('artist.permit', ['id' => $permit->permit_id, 'status' => 'edit']) . '"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">'.__('Edit').'</span></a>' . $pay_btn;
                    } else if ($permit->permit_status == 'rejected') {
                        return '<span onClick="rejected_permit(' . $permit->permit_id . ')" data-toggle="modal" data-target="#rejected_permit" class="kt-badge kt-badge--info kt-badge--inline">'.__('Rejected').'</span>';
                    } else if ($permit->permit_status == 'cancelled') {
                        return '<span onClick="show_cancelled(' . $permit->permit_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="kt-badge kt-badge--info kt-badge--inline">'.__('Cancelled').'</span>';
                    }
                    break;
                case 'valid':
                    $issued_date = strtotime($permit->issued_date);
                    $expired_date = strtotime($permit->expired_date);
                    $today = strtotime(date('Y-m-d 00:00:00'));
                    $diff = abs($today - $issued_date) / 60 / 60 / 24;
                    $expDiff = abs($today - $expired_date) / 60 / 60 / 24;
                    $amendBtn = ($diff < $amend_grace) ? '<a href="'  . \Illuminate\Support\Facades\URL::signedRoute('artist.permit', ['id' => $permit->permit_id, 'status' => 'amend']) .  '"><span  class="kt-badge kt-badge--warning kt-badge--inline kt-margin-b-5">'.__('Amend').'</span></a>' : '';
                    $renewBtn = ($expDiff <= $renew_grace) ? '<a href="'  . \Illuminate\Support\Facades\URL::signedRoute('artist.permit', ['id' => $permit->permit_id, 'status' => 'renew']) .  '"><span  class="kt-badge kt-badge--success kt-badge--inline">'.__('Renew').'</span></a>' : '';
                    if($permit->permit_number)
                    {
                        $pn = Permit::where('permit_number', 'like', "$permit->permit_number%")->latest()->first();
                        if ($pn->permit_number ? $pn->permit_number != $permit->permit_number : '') {
                            $renewBtn = '';
                        }
                    }
                    
                    if($permit->status == 'expired'){
                        return '<div class="alert-text">'.__('Expired').'</div>';
                    }
                    return  '<span class="d-flex flex-column">' . $amendBtn . $renewBtn . '</span>';
                    break;
            }
        })->addColumn('permit_status', function ($permit) {
            $status = $permit->permit_status;
            $ret_status = '';
            if($status == 'modified' || $status == 'new' || $status == 'need approval' || $status == 'processing') {
                $ret_status = __('Pending'); 
            }else if($status == 'approved-unpaid') {
                $ret_status = __('Approved');
            }else if($status == 'modification request') {
                $ret_status = __('Bounce Back');
            }else { 
                $ret_status = $permit->permit_status;
            }
            return  $ret_status;
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
            return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.get_permit_details', [ 'id' =>$permit->permit_id , 'tab' => $from ]).'" title="'.__('View Details').'" class="kt-font-dark"><i class="fa fa-file fs-16"></i></a>';
        })->addColumn('download', function ($permit) {
            return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.download_permit', $permit) . '" target="_blank" title="'.__('Download Permit').'"><i class="fa fa-file-download fs-16"></i></a>';
        })->rawColumns(['action', 'details', 'download', 'permit_id'])->make(true);
    }

    public function get_permit_details(Request $request, $id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.profession', 'artistPermit.artistPermitDocument', 'event')->where('created_by', Auth::user()->user_id)->where('permit_id', $id)->first();
        if(is_null($data_bundle['permit_details'])){
            return abort(401);
        }
        $data_bundle['tab'] = $request->tab;
        // dd($data_bundle['permit_details']);
        return view('permits.artist.view_details', $data_bundle);
    }

    public function check_artist_exists(Request $request)
    {
        $query = ArtistPermit::where([
            'firstname_en' => $request->fname,
            'lastname_en' => $request->lname,
            'country_id' => $request->nationality,
            'birthdate' => Carbon::parse($request->dob)->toDateString()
        ])->with('artist', 'artistPermitDocument', 'Nationality', 'visaType');

        $pro_ids = Profession::where('is_multiple', 0)->pluck('profession_id');
        $has_single_permit = false;

        if ($query->exists()) {
            $data = $query->latest()->first();
            $hasCond = false;
            $artist_id = $data->artist_id;
            if($artist_id)
            {
                foreach($pro_ids as $id){
                    $has_valid_single_permit = ArtistPermit::with(['permit' => function($q){
                        $q->where('permit_status', 'active');
                    }])->where('artist_id', $artist_id)->where('profession_id', $id)->exists();
                    if($has_valid_single_permit){
                        $hasCond = true;
                    }
                }
            }
            if($hasCond == true){
                $has_single_permit = true;
            }
            $isArtist = true;
        } else {
            $data = [];
            $isArtist = false;
        }

        return response()->json(['isArtist' => $isArtist , 'has_single_permit' => $has_single_permit, 'data' => $data]);
    }

    public function checkArtistProfession(Request $request)
    {
        $artist_id = $request->artist_id;
        $profession = $request->profession;

        $permitExists = Permit::with(['artistPermit' => function($q) {
            $q->where('artist_id', $artist_id);
        }])->where('permit_status', 'active')->exists();

        $pro_ids = Profession::where('is_multiple', 0)->pluck('profession_id')->toArray();   
        
        $action = 'allowed';
        
        if(in_array($profession, $pro_ids) && $permitExists) {
            $action = 'notallowed';
        }

        return response()->json(['response' => $action]);
    }

    public function check_artist_exists_in_permit(Request $request)
    {
        $artist_id = $request->artist_id;
        $permit_id = $request->permit_id;

        $artist_exists = ArtistTempData::where('permit_id', $permit_id)->where('artist_id', $artist_id)->exists();
        $res = 'no';
        if($artist_exists)
        {
            $res = 'yes';
        }
        return $res ;
    }

    // to add artist to permit

    function preLoadData()
    {
        $data['requirements'] = Requirement::where('requirement_type', 'artist')->where('status', 1)->orderBy('term', 'desc')->get();
        $data['countries'] = Country::orderBy('nationality_en', 'asc')->get();
        $data['visatypes'] = VisaType::orderBy('visa_type_en', 'asc')->get();
        $data['languages'] = Language::orderBy('name_en', 'asc')->get();
        $data['religions'] = Religion::orderBy('name_en', 'asc')->get();
        $data['emirates'] = Emirates::orderBy('name_en', 'asc')->get();
        $data['areas'] = Areas::orderBy('area_en', 'asc')->get();
        $data['profession'] = Profession::orderBy('name_en', 'asc')->get();
        return $data;
    }

    public function add_new_artist($id = null, $from = null)
    {
        $data = $this->preLoadData();
        // dd(session()->all());
        $user_id = Auth::user()->user_id;
        $from_d = session($user_id . '_apn_from_date');
        $to_d = session($user_id . '_apn_to_date');
        $location = session($user_id . '_apn_location');

        $type = Auth::user()->type;


        if ($id == null) {
            $last_array = ArtistTempData::where([
                ['issue_date', $from_d],
                ['expiry_date', $to_d],
                ['work_location', $location],
                ['created_by', Auth::user()->user_id],
            ]);

            if ($type == 1) {
                $last_array->where('company_id', Auth::user()->EmpClientId);
            }

            $last_array->latest()->first();

            $oldpermitcount = ArtistTempData::where(
                'created_by',
                Auth::user()->user_id
            )->distinct('permit_id')->count();

            if ($last_array) {
                $new_permit_id = $oldpermitcount + 1;
            } else {
                $new_permit_id = 1;
            }
        } else {
            $new_permit_id = $id;
        }

        $data['permit_id'] = $new_permit_id;
        $data['from'] = $from;
        return view('permits.artist.new.add_artist', $data);
    }

    public function storePermitDetails(Request $request)
    {
        $user_id = Auth::user()->user_id;
        session([$user_id . '_apn_from_date' => $request->from]);
        session([$user_id . '_apn_to_date' => $request->to]);
        session([$user_id . '_apn_location' => $request->loc]);
        session([$user_id . '_apn_location_ar' => $request->loc_ar]);
        session([$user_id . '_apn_is_event' => $request->isEvent]);
        if ($request->isEvent == 1) {
            session([$user_id . '_apn_event_id' => $request->eventId]);
        } else {
            session()->forget([$user_id . '_apn_event_id']);
        }
 
        return;  
    }

    function makeSessionForgetPermitDetails()
    {
        $user_id = Auth::user()->user_id;
        session()->forget([$user_id . '_apn_from_date', $user_id . '_apn_to_date', $user_id . '_apn_location', $user_id . '_apn_location_ar',$user_id . '_apn_is_event', $user_id . '_apn_event_id']);
    }


    // To Fetch Artist Details

    public function fetch_artist_temp_data(Request $request)
    {
        $id = $request->artist_temp_id;
        $artists = ArtistTempData::with('Nationality', 'Profession', 'visaType')->where('created_by', Auth::user()->user_id)->where('id', $id)->first();
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
        try{ 
            DB::beginTransaction();
            $id = $request->input('permit_id');
            // $crnt_status = Permit::where('permit_id',  $id)->first()->permit_status;
            $insval = array(
                'cancel_reason' => $request->input('cancel_reason'),
                'cancel_by' => Auth::user()->user_id    ,
                'permit_status' => 'cancelled'
            );
            $result = Permit::where('permit_id', $id)->update($insval);
            DB::commit();
            $message = ['success', __('Permit Cancelled successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $message = ['error', __('Error, Please Try Again'), 'Error'];
        }
        return redirect()->route('artist.index')->with('message', $message);
    }

    // To Apply New Permit Page

    public function create(Request $request, $id = null)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        
        $last_page = URL::previous();

        $view_artist_url_check = str_contains($last_page, url('company/artist/temp/details'));
        $edit_artist_url_check = str_contains($last_page, url('company/artist/edit'));

        $existTemp = ArtistTempData::where([
            ['created_by', Auth::user()->user_id],
        ])->groupBy('permit_id')->latest()->first();

        if ($existTemp) {
            $id = $existTemp->permit_id;
        }

        // $add_artist_url = url('company/artist/add_new/' . $id);
        // $add_permit_url = url('company/artist/new/' . $id);
        
        $add_artist_url = URL::signedRoute('company.add_new_artist' , [ 'id' => $id ]);
        $add_permit_url = URL::signedRoute('company.add_new_permit' , [ 'id' => $id]);

        if ($add_permit_url != $last_page && $last_page != $add_artist_url && !$view_artist_url_check && !$edit_artist_url_check) {
            ArtistTempData::where('permit_id', 1)->where('status', '!=', 5)->where('created_by', Auth::user()->user_id)->delete();
            $this->makeSessionForgetPermitDetails();
            if ($existTemp) {
                $id = (int) $existTemp->permit_id + 1;
            }
        }

        /*  if (!$id) {
            session()->forget([
                $user_id . '_apn_from_date',
                $user_id . '_apn_to_date',
                $user_id . '_apn_location',
            ]);
            ArtistTempData::where([
                ['status', '!=', 5],
                ['company_id', $comp_id],
                ['created_by', Auth::user()->user_id],
            ])->delete();
        }*/

        $events = \App\Event::where('created_by', Auth::user()->user_id);

        $data_bundle['events'] = $events->orderBy('name_en', 'asc')->whereNotIn('status', ['cancelled', 'rejected', 'expired', 'draft'])->get();

        //->whereDate('issued_date', '>=', Carbon::now())

        $data_bundle['artist_details'] = ArtistTempData::where([
            ['permit_id', $id],
            ['created_by', Auth::user()->user_id],
        ])->whereNotIn('status', [5, 1])->with('profession', 'nationality', 'ArtistTempDocument')->get();

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

  
    public function get_status($id)
    {
        $permit = Permit::where('permit_id', $id)->first();
        // return Permit::where('permit_id', $id)->first()->permit_status;
        if(!is_null($permit->lock))
        {
            $to = Carbon::createFromFormat('Y-m-d H:i:s', $permit->lock);
            $from = Carbon::now();

            $diff_in_minutes = $from->diffInMinutes($to);

            if($diff_in_minutes < 5){
                // $request->session()->flash('lock', $permit);
                return response()->json(['message' => ['danger', __('Opps! Someone is currently checking the permit. Please try again later.'), 'Information'] , 'lock' => 'yes']);
            }else {
                return response()->json(['lock' => 'no']);
            }
        }else {
            return response()->json(['lock' => 'no']);
        }
    }


    public function add_artist_temp(Request $request)
    {
        $permitDetails = $request->permitD;
        $artistDetails = json_decode($request->artistD, true);
        $documentDetails = json_decode($request->documentD, true);
        $date_time = date('d_m_Y_H_i_s');
        $permit_id = $request->permit_id;

        $toURL = '';
        try {
            
            if($request->btnOption == 1){
                if($request->from  == 'draft'){
                    $toURL = URL::signedRoute('company.view_draft_details', [ 'id' => $permit_id]) ;
                }else if ($request->event == 'event') {
                    $toURL = URL::signedRoute('event.add_artist', [ 'id' => $permit_id]) ;
                }else {
                    $toURL = URL::signedRoute('company.add_new_permit', [ 'id' => $permit_id]);
                }
            }else if($request->btnOption == 2) {
                $toURL = URL::signedRoute('company.add_new_artist', ['id' => $permit_id]);
            }

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
            'person_code' => $artistDetails['code'],
            'po_box' => $artistDetails['po_box'],
            'fax_number' => $artistDetails['fax_no'],
            'is_old_artist' => $artistDetails['is_old_artist'],
            'artist_permit_status' => 'unchecked',
            'issue_date' => $permitDetails['from'] ? Carbon::parse($permitDetails['from'])->toDateString() : '',
            'expiry_date' => $permitDetails['to'] ? Carbon::parse($permitDetails['to'])->toDateString() : '',
            'work_location' => $permitDetails['location'],
            'work_location_ar' => $permitDetails['location_ar'],
            'company_id' => Auth::user()->type == 1 ? Auth::user()->EmpClientId : '',
            'created_by' => Auth::user()->user_id,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        if ($permitDetails['is_event'] == 1) {
            $artistTempData->event_id = $permitDetails['event_id'];
        }


        $temp_id = $artistTempData->id;
        if ($artistDetails['artist_id']) {
            $artistTempData->artist_id = $artistDetails['artist_id'];
        } else {
            $artistTempData->artist_id = $temp_id;
        }

        $userid = Auth::user()->user_id;
        $pic_ext = session($userid .   '_ext');

        if (Storage::exists(session($userid . '_pic_file'))) {

            $check_path = $userid . '/artist/temp/' . $temp_id . '/photos';

            if (Storage::exists('public/' . $check_path)) {
                $file_count = count(Storage::files('public/' . $check_path));
                $file_nos = $file_count / 2;
                $next_file_no = $file_nos + 1;
            } else {
                $next_file_no = 1;
            }

            $newPathLink = $check_path.'/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newThumbPathLink = $check_path.'/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

            if(!Storage::exists('public/'.$newPathLink)){
                Storage::move(session($userid . '_pic_file'), 'public/'.$newPathLink);
            }
            if(!Storage::exists('public/'.$newThumbPathLink)){
                Storage::move(session($userid . '_thumb_file'), 'public/'.$newThumbPathLink);
            }

            $request->session()->forget($userid . '_pic_file');
            $request->session()->forget($userid . '_thumb_file');
            $request->session()->forget($userid . '_ext');
        } else {
            $getArtistPics = ArtistPermit::where('artist_id', $artistDetails['artist_id'])->latest()->first();
            $newPathLink = $getArtistPics->original;
            $newThumbPathLink = $getArtistPics->thumbnail;
        }

        if ($request->from == 'draft') {
            $artistTempData->status = 5;
        } else {
            $artistTempData->status = 0;
        }

        $artistTempData->original = $newPathLink;
        $artistTempData->thumbnail = $newThumbPathLink;
        $artistTempData->save();

        // $issued_date = strtotime(date('Y-m-d', strtotime($permitDetails['from'])));
        // $expired_date = strtotime(date('Y-m-d', strtotime($permitDetails['to'])));
        // $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);
        // if ($diff < 30) {
        //     $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->where('term', 'short')->get();
        // } else {
        $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
        // }

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

                $check_path =  $userid . '/artist/temp/' . $temp_id;

                if (Storage::exists('public/' .$check_path)) {
                    $file_count = count(Storage::files('public/' .$check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = 1;
                }

                $newPathLink = $check_path . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                if(!Storage::exists('public/'.$newPathLink))
                {
                    Storage::move(session($userid  . '_doc_file_' . $l), 'public/'.$newPathLink);
                }

                Storage::delete(session($userid  . '_doc_file_' . $l));

                $request->session()->forget([$userid . '_doc_file_' . $l, $userid . '_ext_' . $l]);

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
            } else {
                if ($artistDetails['is_old_artist'] == 2) {
                    $artistsD = ArtistPermitDocument::where('artist_permit_id', $artistDetails['artist_permit_id'])->where('requirement_id', $l)->latest()->first();
                    if ($artistsD) {
                        $newPathLink = $artistsD->path;

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
                }
            }
        }

            DB::commit();
		
            $result = ['success', __('Artist Added Successfully'), 'Success'];
        
        } catch (Exception $e) {
            DB::rollBack();
            
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        return response()->json(['message' => $result , 'toURL' => $toURL]);
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
        $toURL = '';
        try {

            DB::beginTransaction();
        
        $temp_permit_id = $request->temp_permit_id;
        $user_id = Auth::user()->user_id;
        $date_time = date('d_m_Y_H_i_s');
        $currentDateTime = Carbon::now()->toDateTimeString();
        $fromWhere = $request->fromWhere ;
        if( $fromWhere == 'event')
        {
            $toURL = URL::signedRoute('event.index').'#applied';
        }else if( $fromWhere == 'renew')
        {
            $toURL = URL::signedRoute('artist.index').'#valid';
        }else 
        {
            $toURL =URL::signedRoute('artist.index').'#applied';
        }

        $artist_temp_data = ArtistTempData::where([
            ['permit_id', $temp_permit_id],
            ['created_by', $user_id]
        ])->when($request->fromWhere == 'new' || $request->fromWhere == 'event', function ($q) use ($request){
            $q->where('status', '!=', '5');
          })->get();

        $artists_total = count($artist_temp_data);

        $work_location = $request->loc;
        $work_location_ar = $request->loc_ar;
        $issue_date = Carbon::parse($request->from)->toDateString();
        $expiry_date = Carbon::parse($request->to)->toDateString();

       
        $new_refer_no = $this->generateArtistReferenceNumber();
        $permit = '';
        $from = '';
        if(isset($request->fromWhere)){
            $from = $request->fromWhere ;
        }

        if ($artists_total > 0) {

            $permit = Permit::create([
                'work_location' => $work_location,
                'work_location_ar' => $work_location_ar,
                'issued_date' => $issue_date,
                'expired_date' => $expiry_date,
                'reference_number' => $new_refer_no,
                'permit_status' => 'new',
                'user_id' => $user_id,
                'created_by' => $user_id,
                'created_at' => $currentDateTime,
                'term' => $request->term,
                'company_id' => Auth::user()->type == 1 ? Auth::user()->EmpClientId : ''
            ]);

            if (isset($request->event_id)) {
                $permit->event_id = $request->event_id;
            }



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
                        'artist_permit_status' => 'unchecked',
                        'firstname_ar' => $data->firstname_ar,
                        'lastname_ar' => $data->lastname_ar,
                        'firstname_en' => $data->firstname_en,
                        'lastname_en' => $data->lastname_en,
                        'gender_id' => $data->gender,
                        'country_id' => $data->nationality,
                        'birthdate' => $data->birthdate,
                    );


                    if ($data->artist_permit_id) {
                        if ($from == 'renew') {
                            $artistPermit =   ArtistPermit::create($updateArray);
                            $artistPermit->permit_id = $permit->permit_id;
                            $artistPermit->artist_id = $data->artist_id;
                            $artistPermit->created_at = $currentDateTime;
                            $artistPermit->created_by =  $user_id;
                            $artistPermitId = $artistPermit->artist_permit_id;
                        } else {
                            $artistPermit =  ArtistPermit::where('artist_permit_id', $data->artist_permit_id)->update($updateArray);
                            $artistPermitId = $data->artist_permit_id;
                        }
                        $artistID = $data->artist_id;
                        $artist_temp_document = ArtistTempDocument::where('artist_permit_id', $data->artist_permit_id)->get();

                    } else {
                        
                        if ($data->is_old_artist == 1) {
                            $artistTable = Artist::create([
                                'artist_status' => 'active',
                                'person_code' => $this->generatePersonCode(),
                                'created_at' => $currentDateTime,
                                'created_by' => $user_id
                            ]);
                           
                            $artist_id = $artistTable->artist_id;
                            // $artistTable->companies()->sync($request->user()->company->company_id); 
                            // $request->user()->company->artist()->sync($artist_id); 
                            // $request->user()->company->artists()->where('artist_id', '!=', $artist_id)->attach($artist_id);
                        } else {
                            $artist_id = $data->artist_id;
                        }
                        $updateArray['permit_id'] = $permit->permit_id;
                        $updateArray['artist_id'] = $artist_id;
                        $updateArray['created_at'] =  $currentDateTime;
                        $updateArray['created_by'] =  $user_id;
                        $artistPermit =  ArtistPermit::create($updateArray);
                        $artistID = $artist_id;
                        $artistPermitId = $artistPermit->artist_permit_id;

                    }

                    // if($request->user()->company->artists()->where('artist.artist_id', '!=', $artist_id)->exists()){
                    //     $request->user()->company->artists()->attach($artist_id);
                    // } 

                    $org = [];

                    if($data->original)
                    {
                        $org = explode('/', $data->original);
                    }
                    

                    // isset($org[2]) ? $is_temp = $org[2] : '';

                    if ($org[2] == 'temp') {

                        $pic_ext = '';

                        $exttt = end($org);
                        $ext = explode('.', $exttt);
                        $pic_ext = $ext[1];

                        $check_path =   $user_id . '/artist/' .  $artistPermitId . '/photos';

                        if (Storage::exists('public/' .$check_path)) {
                            $file_count = count(Storage::files('public/' .$check_path));
                            $file_nos = $file_count / 2;
                            $next_file_no = $file_nos + 1;
                        } else {
                            $next_file_no = 1;
                        }

                        $newPathLink = $check_path.'/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

                        $newThumbPathLink = $check_path.'/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

                        $oldPath = 'public/' . $data->original;
                        $oldThumbPath = 'public/' . $data->thumbnail;

                        if(!Storage::exists('public/'.$newPathLink)){
                            Storage::move($oldPath, 'public/'.$newPathLink);
                        }
                        if(!Storage::exists('public/'.$newThumbPathLink)){
                            Storage::move($oldThumbPath, 'public/'.$newThumbPathLink);
                        }
                        

                    } else {
                        $newPathLink = $data->original;
                        $newThumbPathLink = $data->thumbnail;
                    }

                    $artistPermit->original = $newPathLink;
                    $artistPermit->thumbnail = $newThumbPathLink;

                    $artistPermit->save();

                    $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();

                    $requirement_ids = [];
                    foreach ($requirements as $req) {
                        array_push($requirement_ids, $req->requirement_id);
                    }
                    $total = $requirements->count();

                    // dump($requirement_ids);


                    for ($j = 0; $j < $total; $j++) {

                        $l = $requirement_ids[$j];
                        $m = $j + 1;

                        $artist_temp_document = ArtistTempDocument::where('temp_data_id', $data->id)->where('requirement_id', $l)->orderBy('created_at', 'desc')->first();


                        if (!empty($artist_temp_document) && $artist_temp_document->doc_id == null) {

                            $temp_path = $artist_temp_document->path;

                            $te_pth = explode('/', $temp_path);

                            $extt = end($te_pth);
                            $exttt = explode('.', $extt);
                            $ext = $exttt[1];

                            $check_path =  $user_id . '/artist/' . $artistPermitId . '/'  . $l;

                            $file_count = count(Storage::files('public/' .$check_path));

                            if ($file_count == 0) {
                                $next_file_no = 1;
                            } else {
                                $next_file_no = $file_count + 1;
                            }
                            
                            $newPathLink = $check_path . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                            if(!Storage::exists('public/'.$newPathLink))
                            {
                                Storage::move('public/' . $temp_path, 'public/'.$newPathLink);
                            }
                            

                            ArtistPermitDocument::create([
                                'issued_date' => $artist_temp_document->issued_date,
                                'expired_date' => $artist_temp_document->expired_date,
                                'created_at' =>  Carbon::now()->toDateTimeString(),
                                'created_by' =>  Auth::user()->user_id,
                                'path' =>  $newPathLink,
                                'requirement_id' => $l,
                                'artist_permit_id' => $artistPermitId
                            ]);

                            Storage::delete($temp_path);
                        }

                        
                    }
                }
            }

            if ($from == 'renew') {
                Permit::where('permit_id', $temp_permit_id)->update(['is_edit' => 0]);
                $permit->permit_reference_id = Permit::where('permit_id', $temp_permit_id)->value('permit_reference_id');
                $permit->rivision_number = (int) Permit::where('permit_id', $temp_permit_id)->value('rivision_number') + 1;
                $permit->permit_number = $artist_temp_data[0]->permit_number;
                $permit->request_type = 'renew';
                $permit->save();
            } else {
                $permit_reference = PermitReference::create([
                    'user_id' => Auth::user()->user_id
                ]);
                $permit->permit_reference_id = $permit_reference->permit_reference_id;
                $permit->rivision_number = 1;
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
            DB::commit();
            $this->makeSessionForgetPermitDetails();
            $result = ['success', __('Artist Permit Applied Successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }


        return response()->json(['message' => $result, 'toURL' => $toURL ]);
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
            $code = (int)$last_person_code + 1;
        }

        // // call the same function if the barcode exists already
        // if ($this->personCodeExists($code)) {
        //     return $this->generatePersonCode();
        // }

        // otherwise, it's valid and can be used
        return $code;
    }

    // function personCodeExists($code)
    // {
    //     // query the database and return a boolean
    //     // for instance, it might look like this in Laravel
    //     return Artist::where('person_code', $code)->exists();
    // }


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

    public function delete_uploaded_file(Request $request)
    {
        $req = str_replace(" ", "_", $request->reqName);
        // dd('files/' . $request->artistNo . '/' . $req);
        $status = Storage::delete('files/' . $request->artistNo . '/' . $req);
        return $status;
    }

    public function add_artist_to_permit(Request $request,$from, $id)
    {
        // if(!$request->hasValidSignature()){
        //     return abort(401);
        // }
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
            ['status' , '!=' , 1]
        ])->exists();

        $pro_ids = Profession::where('is_multiple', 0)->pluck('profession_id');

        $artist_d = [];

        $exists = true ;
        $has_single_permit = false;

        if (!$code_exists) {
            $exists = false ;
            $artist_d = Artist::with('artistPermit', 'artistPermit.artistPermitDocument', 'artistPermit.Nationality', 'artistPermit.visaType')->where('person_code', $code)->latest()->first();
            $hasCond = false;
            if($artist_d)
            {
                $artist_id = $artist_d->artist_id;
                if($artist_id)
                {
                    foreach($pro_ids as $id){
                        $has_valid_single_permit = ArtistPermit::with(['permit' => function($q) use($permit_id){
                            $q->where('permit_status', 'active');
                        }])->where('artist_id', $artist_id)->where('profession_id', $id)->exists();
                        if($has_valid_single_permit){
                            $hasCond = true;
                        }
                    }
                }
                if($hasCond == true){
                    $has_single_permit = true;
                }
            }
        }

        return response()->json(['exists' => $exists , 'has_single_permit' => $has_single_permit, 'artist_d' => $artist_d]);
        // return $artist_d;
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
        $artistPermitDetails = ArtistPermit::with('artist', 'artistPermitDocument', 'profession', 'Nationality', 'visaType')->where('created_by', Auth::user()->user_id)->where('artist_permit_id', $ap_id)->first();
        return $artistPermitDetails;
    }

    public function get_artist_details(Request $request, $id, $from)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data['artist_details'] = ArtistPermit::with('artist', 'artistPermitDocument', 'profession', 'Nationality', 'visaType', 'area', 'language', 'religion', 'emirate', 'artistPermitDocument.requirement', 'permit.event')->where('created_by', Auth::user()->user_id)->where('artist_permit_id', $id)->first();
        if(is_null($data['artist_details'])){
            return abort(401);
        }
        $data['from'] = $from;
        return view('permits.artist.view_artist', $data);
    }

    public function get_files_by_artist_permit_id(Request $request)
    {
        $artist_permit_id = $request->artist_permit_id;
        $reqName =  $request->reqName;
        $artist_documents = ArtistPermitDocument::where('artist_permit_id', $artist_permit_id)->where('requirement_id', $reqName)->orderBy('created_at', 'desc')->get();
        return $artist_documents;
    }

    public function get_temp_artist_details(Request $request, $id, $from)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data['artist_details'] = ArtistTempData::with('Nationality', 'Profession', 'visaType', 'ArtistTempDocument.requirement')->where('id', $id)->first();

        $data['from'] = $from;
        return view('permits.artist.common.view_temp_artist', $data);
    }

    public function get_photo_by_artist_permit_id($artist_permit_id)
    {
        $artist_documents = ArtistPermit::where('artist_permit_id', $artist_permit_id)->get();
        return $artist_documents;
    }

    public function delete_artist_from_temp(Request $request)
    {
        try {
            DB::beginTransaction();
            $del_temp_id  = $request->del_temp_id;
            $permit_id = $request->del_permit_id;
            ArtistTempData::where('id', $del_temp_id)->update(['del_status' => 1]);
            ArtistTempDocument::where('temp_data_id', $del_temp_id)->update(['status' => 1]);
            DB::commit();
            $result = ['success', __('Artist Deleted Successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        return redirect(URL::signedRoute('company.view_draft_details', [ 'id' => $permit_id]))->with('message', $result);
    }


    public function delete_artist(Request $request)
    {
        try {
            DB::beginTransaction();
        $from = $request->del_artist_from;
        $permit_id = $request->del_permit_id;
        $temp_id = $request->del_temp_id;

        // Artistpermit::where('artist_permit_id', $artist_permit_id)->update(['artist_permit_status' => 'inactive']);
        ArtistTempData::where('id', $temp_id)->where('created_by', Auth::user()->user_id)->update(['status' => 1]);
        DB::commit();
            $result = ['success', __('Artist Removed successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        if($from == 'new') {
            return redirect()->route(URL::signedRoute('company.add_new_permit', [ 'id' => 1]))->with('message', $result);
        }

        if($from == 'event') {
            return redirect()->route(URL::signedRoute('event.add_artist', [ 'id' => $permit_id]))->with('message', $result);
        }

        switch ($from) {
            case 'amend':
                $route_back = 'amend';
                break;
            case 'renew':
                $route_back = 'renew';
                break;
            case 'edit':
                $route_back = 'edit';
                break;
            default:
                break;
        }
        // dd($route_back);
        return redirect()->route(URL::signedRoute('artist.permit',[ 'id' => $permit_id , 'status'=> $route_back]))->with('message', $result);
    }

    public function update_artist_temp(Request $request)
    {
        $toURL = '';
        try {
            DB::beginTransaction();

            if($request->from == 'draft'){
                $toURL = URL::signedRoute('company.view_draft_details', [ 'id' => $request->permit_id]);
            }else if($request->from == 'amend'){
                $toURL = URL::signedRoute('artist.permit', [ 'id' => $request->permit_id , 'from' => 'amend']);
            }else if($request->from == 'edit') {
                $toURL = URL::signedRoute('artist.permit', [ 'id' => $request->permit_id , 'from' => 'edit']);
            }else if($request->from == 'renew') {
                $toURL = URL::signedRoute('artist.permit', [ 'id' => $request->permit_id , 'from' => 'renew']);
            }else if($request->from == 'new') {
                $toURL = URL::signedRoute('company.add_new_permit', [ 'id' => $request->permit_id]);
            }

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

            $check_path =  $userid . '/artist/temp/' . $temp_id . '/photos';

            if (Storage::exists('public/' .$check_path)) {
                $file_count = count(Storage::files('public/' .$check_path));
                $file_nos = $file_count / 2;
                $next_file_no = $file_nos + 1;
            } else {
                $next_file_no = 1;
            }

            $newPathLink = $check_path.'/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
            $newThumbPathLink = $check_path.'/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

            if(!Storage::exists('public/'.$newPathLink))
            {
                Storage::move(session($userid .  '_pic_file'), 'public/'.$newPathLink);
            }
            if(!Storage::exists('public/'.$newThumbPathLink))
            {
                Storage::move(session($userid . '_thumb_file'), 'public/'.$newThumbPathLink);
            }

            $request->session()->forget([$userid . '_pic_file', $userid . '_thumb_file', $userid . '_ext']);

            $imgArr = array(
                'original' => $newPathLink,
                'thumbnail' => $newThumbPathLink
            );

            ArtistTempData::where('id', $temp_id)->update($imgArr);
        }


        $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();


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

                $check_path =  $userid . '/artist/temp/' . $temp_id;

                if (Storage::exists('public/' .$check_path)) {
                    $file_count = count(Storage::files('public/' .$check_path));
                    $next_file_no = $file_count + 1;
                } else {
                    $next_file_no = 1;
                }

                $newPathLink = $check_path . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                if(!Storage::exists('public/'.$newPathLink))
                {
                    Storage::move(session($userid .  '_doc_file_' . $l), 'public/'.$newPathLink);
                }

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
                $addTempDoc = ArtistTempDocument::where('temp_data_id', $temp_id)->where('requirement_id', $l)->orderBy('created_at', 'desc')->latest()->first();

                if ($addTempDoc) {
                    if ($documentDetails[$m] != null) {
                        if ($addTempDoc->issued_date != Carbon::parse($documentDetails[$m]['issue_date'])->toDateString() || $addTempDoc->expired_date != Carbon::parse($documentDetails[$m]['exp_date'])->toDateString()) {
                            ArtistTempDocument::create([
                                'issued_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['issue_date'])->toDateTimeString() : '',
                                'expired_date' => $documentDetails[$m] != null ? Carbon::parse($documentDetails[$m]['exp_date'])->toDateTimeString() : '',
                                'created_at' =>  Carbon::now()->toDateTimeString(),
                                'created_by' =>  Auth::user()->user_id,
                                'artist_permit_id' => $addTempDoc->artist_permit_id,
                                'path' =>  $addTempDoc->path,
                                'permit_id' => $addTempDoc->permit_id,
                                'doc_id' => $addTempDoc->doc_id,
                                'requirement_id' => $l,
                                'temp_data_id' => $temp_id,
                                'status' => 3
                            ]);
                        }
                    }
                }
            }
        }
            DB::commit();
            $result = ['success', __('Artist Updated successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        // if ($artists) {
        //     $result = ['success', __(' Successfully'), 'Success'];
        // } else {
        //     $result = ['error', __('Error, Please Try Again'), 'Error'];
        // }

        return response()->json(['message' => $result, 'toURL' => $toURL]);
    }

    public function permit(Request $request, $id, $status)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $permit_details = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.profession', 'event')->where('created_by', Auth::user()->user_id)->where('permit_id', $id)->first();

        if (empty($permit_details)) {
            abort(401);
        }

        Permit::where('permit_id', $id)->update(["lock" => Carbon::now()->toDateTimeString()]);

        if ($status != 'event') {
            $edit = $permit_details->is_edit;
        } else {
            $edit = 1;
        }

        if ($status == 'edit') {
            if ($permit_details->permit_status != 'new' && $permit_details->permit_status != 'modification request') {
                return view('permits.artist.index');
            }
        }

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
                    'work_location' => $permit_details->work_location,
                    'company_id' => $permit_details->company_id,
                    'created_by' => $permit_details->created_by,
                    'process' => $status,
                    'event_id' => $permit_details->event ? $permit_details->event->event_id : ''
                ]);

                if ($status == 'renew') {
                    $old_permit_number = $permit_details->permit_number;
                    $number = explode('-', $old_permit_number);
                    $new_pn = isset($number[1]) ? $number[0] . '-' . (string) ((int) $number[1] + 1) : $old_permit_number . '-' . '01';
                    $today = date('d-m-Y');
                    $expiry = date('d-m-Y', strtotime($permit_details->expired_date));
                    $issue = date('d-m-Y', strtotime($permit_details->issued_date));
                    $issued_date = strtotime($issue);
                    $expired_date = strtotime($expiry);
                    $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                    if ($today > $expiry) {
                        $new_issue_date = date('d-m-Y', strtotime('+1 day', strtotime($today)));
                        $new_expiry_date = date('d-m-Y', strtotime('+' . $diff . ' day', strtotime($today)));
                    } else {
                        $new_issue_date = date('d-m-Y', strtotime('+1 day', strtotime($expiry)));
                        $new_expiry_date = date('d-m-Y', strtotime('+' . $diff . ' day', strtotime($expiry)));
                    }
                    $artist_temp->issue_date = Carbon::parse($new_issue_date)->toDateString();
                    $artist_temp->expiry_date = Carbon::parse($new_expiry_date)->toDateString();
                    $artist_temp->permit_number = $new_pn;
                } else {
                    $artist_temp->issue_date = $permit_details->issued_date;
                    $artist_temp->expiry_date = $permit_details->expired_date;
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
        // $data_bundle['staff_comments'] = PermitComment::where('permit_id', $id)->where('type', 1)->get();
        $data_bundle['staff_comments'] = PermitComment::doesntHave('artistPermitComment')->where('permit_id', $id)->get();
        // dd($data_bundle['staff_comments']);
        $routeTo = '';
        if ($status == 'event') {
            return redirect(URL::signedRoute('event.add_artist', ['id' => $id]));
        }
        if ($status == 'edit') {
            $routeTo = 'permits.artist.edit_permit';
        } else if ($status == 'amend') {
            $routeTo = 'permits.artist.amend_permit';
        } else if ($status == 'renew') {
            $routeTo = 'permits.artist.renew_permit';
        }
        return view($routeTo, $data_bundle);
    }

    public function fetch_artist_comment($id)
    {
        return ArtistPermit::with('comments')->where('artist_permit_id', $id)->latest()->first();
    }


    public function edit_artist(Request $request , $id, $from)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $permit_id = ArtistTempData::where('id', $id)->value('permit_id');
        $artist_permit_id = ArtistTempData::where('id', $id)->value('artist_permit_id');
        $data_bundle = $this->preLoadData();
        $data_bundle['artist_details'] = ArtistTempData::with('Nationality', 'Profession')->where('id', $id)->first();
        $data_bundle['staff_comments'] = $artist_permit_id ? ArtistPermit::with('comments')->where('artist_permit_id', $artist_permit_id)->latest()->first() : '';
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

    public function fetch_drafts(Request $request)
    {
        if($request->ajax())
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
            if(check_is_blocked()['status'] == 'blocked'){
                return ;
            }
            return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.view_draft_details', $permit->permit_id) . '"><span class="kt-badge kt-badge--warning kt-badge--inline">'.__('View').'</span></a>&emsp;<span onClick="delete_draft(' . $permit->permit_id . ')" data-toggle="modal"  class="kt-badge kt-badge--danger kt-badge--inline">'.__('Remove').'</span>';
        })->addColumn('details', function ($permit) {
            return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.get_draft_details', $permit->permit_id) . '" title="View Details" class="kt-font-dark"><i class="fa fa-file"></i></a>';
        })->rawColumns(['action', 'details'])->make(true);
    }
    }

    public function get_draft_details(Request $request, $permit_id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $user_id = Auth::user()->user_id;
        $data['draft_details'] = ArtistTempData::with('profession', 'event')->where([
            ['status', 5],
            ['created_by', $user_id],
        ])->where('permit_id', $permit_id)->get();
      
        return view('permits.artist.view_draft_details', $data);
    }

    
    public function delete_draft(Request $request)
    {
        try {
            DB::beginTransaction();
            $permit_id = $request->del_draft_id;
            ArtistTempData::where([
                ['status', 5],
                ['created_by', Auth::user()->user_id],
            ])->where('permit_id', $permit_id)->delete();
            DB::commit();
            $result = ['success', __('Draft Deleted successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }
        return redirect(URL::signedRoute('artist.index').'#draft')->with('message', $result);
    }

    public function view_draft_details(Request $request, $id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }

        $user_id = Auth::user()->user_id;
        $data['artist_details'] = ArtistTempData::with('profession', 'nationality', 'ArtistTempDocument', 'event')->where([
            ['status', 5],
            ['del_status', 0],
            ['created_by', $user_id],
            ['permit_id', $id],
        ])->get();

        $data['permit_id'] = $id;
        $data['events'] = \App\Event::where('created_by', Auth::user()->user_id)->whereDate('issued_date', '>=', date('Y-m-d'))->orderBy('name_en', 'asc')->get();
        return view('permits.artist.draft_view', $data);
    }

    public function add_draft(Request $request)
    {
        $toURL = URL::signedRoute('artist.index').'#draft';
        try{ 

            DB::beginTransaction();


        $temp_permit_id = $request->temp_permit_id;
        $user_id = Auth::user()->user_id;

        $updateArray = array(
            'status' => 5,
            'issue_date' => Carbon::parse($request->from)->toDateString(),
            'expiry_date' => Carbon::parse($request->to)->toDateString(),
            'work_location' => $request->loc,
            'work_location_ar' => $request->loc_ar,
        );

        if (isset($request->event_id)) {
            $updateArray['event_id'] = $request->event_id;
        }

        $update = ArtistTempData::where([
            ['permit_id', $temp_permit_id],
            ['created_by', $user_id],
        ])->update($updateArray);

        ArtistTempData::where([
            ['permit_id', $temp_permit_id],
            ['created_by', $user_id],
            ['del_status', 1],
        ])->delete();

            $this->makeSessionForgetPermitDetails();
        

        DB::commit();
		
        $result = ['success', __('Draft Saved Successfully'), 'Success'];
	} catch (Exception $e) {
		DB::rollBack();
		
		$result = ['error', __($e->getMessage()), 'Error'];
	}
	

        return response()->json(['message' => $result , 'toURL' => $toURL]);
    }

    public function edit_artist_draft(Request $request, $temp_id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }

        $permit_id = ArtistTempData::where('id', $temp_id)->value('permit_id');

        $data_bundle = $this->preLoadData();
        $data_bundle['artist_details'] = ArtistTempData::with('Nationality', 'Profession')->where('id', $temp_id)->first();
        $data_bundle['permit_details'] = ArtistPermit::with('artist', 'permit', 'artistPermitDocument', 'profession')->where('permit_id', $permit_id)->first();
        return view('permits.artist.edit_artist', $data_bundle);
    }

    public function update_permit(Request $request)
    {
        $toURL = URL::signedRoute('artist.index').'#applied';
        try {
            DB::beginTransaction();

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
                    'artist_permit_status' => 'unchecked'
                );

                $org = explode('/', $data->original);

                // isset($org[2]) ? $is_temp = $org[2] : '';

                if ($org[2] == 'temp') {

                    $exttt = end($org);
                    $ext = explode('.', $exttt);
                    $pic_ext = $ext[1];


                    $check_path = $user_id . '/artist/' .  $data->artist_id . '/photos';

                    if (Storage::exists('public/'.$check_path)) {
                        $file_count = count(Storage::files('public/'.$check_path));
                        $file_nos = $file_count / 2;
                        $next_file_no = $file_nos + 1;
                    } else {
                        $next_file_no = 1;
                    }

                    $newPathLink = $check_path.'/photo_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;
                    $newThumbPathLink = $check_path.'/thumb_' . $next_file_no . '_' . $date_time . '.' . $pic_ext;

                    $oldPath = 'public/' . $data->original;
                    $oldThumbPath = 'public/' . $data->thumbnail;

                    if(!Storage::exists('public/'.$newPathLink))
                    {
                        Storage::move($oldPath, 'public/'.$newPathLink);
                    }
                    if(!Storage::exists('public/'.$newThumbPathLink))
                    {
                        Storage::move($oldThumbPath, 'public/'.$newThumbPathLink);
                    }

                } else {
                    $newPathLink = $data->original;
                    $newThumbPathLink = $data->thumbnail;
                }

                if ($data->artist_permit_status == 'approved') {
                    $updateArray['artist_permit_status'] = 'approved';
                } else {
                    $updateArray['artist_permit_status'] = 'unchecked';
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

                // $issued_date = strtotime($data->issue_date);
                // $expired_date = strtotime($data->expiry_date);

                // $diff = abs($expired_date - $issued_date) / 60 / 60 / 24;
                // if ($diff < 30) {
                //     $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->where('term', 'short')->get();
                // } else {
                $requirements = Requirement::where('requirement_type', 'artist')->where('status', 1)->get();
                // }

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

                        $check_path =  $user_id . '/artist/' . $artistID;

                        if (Storage::exists('public/' .$check_path)) {
                            $file_count = count(Storage::files('public/' .$check_path));
                            $next_file_no = $file_count + 1;
                        } else {
                            $next_file_no = 1;
                        }

                        $newPathLink = $check_path . '/document_' . $next_file_no . '_' . $date_time . '.' . $ext;

                        $oldPath = 'public/' . $temp_path;

                        if(!Storage::exists('public/'.$newPathLink)){
                            Storage::move($oldPath, 'public/'.$newPathLink);
                        }

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
            if ($old_permit_status == 'modification request') {
                $message = ['success', __('Artist Permit Updated Successfully'), 'Success'];
            } else if ($old_permit_status == 'active') {
                $message = ['success', __('Artist Permit Amended Successfully'), 'Success'];
            } else {
                $message = ['success', __('Artist Permit Added Successfully'), 'Success'];
            }
        } 
            DB::commit();
            $result = $message ;
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        return response()->json(['message' => $result , 'toURL' => $toURL]);
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

    public function fetch_event_details(Request $request)
    {
        $event_id = $request->event_id;
        return \App\Event::where('event_id', $event_id)->latest()->first();
    }


    public function download_permit(Request $request, Permit $permit)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }

        $hasHappiness = Happiness::where('type', 'artist')->where('application_id', $permit->permit_id)->exists();
        if(!$hasHappiness)
        {
            return redirect(URL::signedRoute('company.happiness_center', ['id' => $permit->permit_id]));
        }
        $data['company_details'] = Auth::user()->type == 1 ? Company::find(Auth::user()->EmpClientId) : [];
        $data['artist_details'] = $permit->artistPermit()->with('artist', 'profession', 'Nationality')->get();
        $data['permit_details'] = $permit;

        // if($permit->user_id == Auth::user()->user_id) {
        //     return abort(401);
        // }

        $permitNumber = $permit->permit_number;

        $pdf = PDF::loadView('permits.artist.permit_print', $data, [], [
            'title' => 'Artist Permit',
            'default_font_size' => 10
        ]);
        return $pdf->stream('Artist Permit-' . $permitNumber . '.pdf');
    }

    // Make Payment Function

    public function make_payment(Request $request, $id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.profession', 'event')->where('permit_id', $id)->first();
        return view('permits.artist.payment', $data_bundle);
    }

    // Payment Gateway


    public function payment_gateway(Request $request , Permit $permit)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $id = $permit->permit_id;
        $data_bundle['permit_details'] = Permit::with('artistPermit', 'artistPermit.artist', 'artistPermit.artistPermitDocument', 'artistPermit.profession')->where('permit_id', $id)->where('created_by', Auth::user()->user_id)->first();
        return view('permits.artist.payment_gateway', $data_bundle);
    }

    public function payment(Request $request)
    {
       

        $permit_id = $request->permit_id;
        $amount = $request->amount;
        $vat = $request->vat;
        $total = $request->total;
        $paidEventFee = $request->paidEventFee;
        $noofdays = $request->noofdays;
        $transaction_id = $request->transactionId;
        $receipt = $request->receipt; 
        $order_id = $request->orderId;
        $toURL = '';
        try {
            DB::beginTransaction();
            $toURL = URL::signedRoute('company.happiness_center', [ 'id' => $permit_id]);
            
        $transArr = Transaction::create([
            'reference_number' => getTransactionReferNumber(),
            'transaction_type' => 'artist',
            'transaction_date' => Carbon::now(),
            'created_by' => Auth::user()->user_id,
            'company_id' => Auth::user()->EmpClientId,
            'payment_transaction_id' => $transaction_id,
            'payment_receipt_no' => $receipt,
            'payment_order_id' => $order_id
        ]);

        $artistPermits = ArtistPermit::where('permit_id', $permit_id)->where('artist_permit_status', 'approved')->get();

        foreach ($artistPermits as $artistPermit) {
            $per_day_fee = $artistPermit->profession->amount;
            $total_fee = $per_day_fee * $noofdays;
            $vat_fee = $total_fee * 0.05 ; 
            $transArr->artistPermitTransaction()->create([
                'vat' => $vat_fee ,
                'amount' => $total_fee,
                'permit_id' => $permit_id,
                'artist_permit_id' => $artistPermit->artist_permit_id,
                'transaction_id' => $transArr->transaction_id
            ]);
        }

        $permit_number = generateArtistPermitNumber();

        $permit = Permit::where('permit_id', $permit_id)->first();

        if($paidEventFee)
        {

            $trans = Transaction::create([
                'reference_number' => getTransactionReferNumber(),
                'transaction_type' => 'event',
                'transaction_date' => Carbon::now(),
                'created_by' => Auth::user()->user_id
            ]);

            $ev_amount = $permit->event->type->amount * $noofdays;
            $ev_vat = $ev_amount * 0.05;

            \App\EventTransaction::create([
                'event_id' => $permit->event_id,
                'user_id' => Auth::user()->user_id,
                'transaction_id' => $trans->transaction_id,
                'amount' => $ev_amount,
                'vat' => $ev_vat,
                'type'=> 'event'
            ]);

            \App\Event::where('event_id', $permit->event_id)->update([
                'paid' => 1,
                'status' => 'active',
                'permit_number' => generateEventPermitNumber()
            ]);

            $event_id = $permit->event_id ;

            if($permit->event->is_truck == 1)
            {
                $totaltrucks = count(EventTruck::where('event_id', $event_id)->where('paid', 0)->get());

                if($totaltrucks > 0)
                {
                    $tr_amount = getSettings()->food_truck_fee * $noofdays * $totaltrucks;

                    EventTransaction::create([
                        'event_id' => $event_id,
                        'user_id' => Auth::user()->user_id,
                        'transaction_id' => $trans->transaction_id,
                        'amount' => $tr_amount,
                        'vat' => 0,
                        'type'=> 'truck',
                        'total_trucks' => count($permit->event->truck)
                    ]);
    
                    EventTruck::where('event_id', $event_id)->update(['paid' => 1]);
                }
               
            }

            if($permit->event->is_liquor == 1)
            {
                if(($permit->event->liquor) && ($permit->event->liquor->paid == 0))
                {
                    $lq_amount = getSettings()->liquor_fee * $noofdays ;
                    EventTransaction::create([
                        'event_id' => $event_id,
                        'transaction_id' => $trans->transaction_id,
                        'type' => 'liquor',
                        'amount' => $lq_amount,
                        'vat' => 0,
                        'user_id' => Auth::user()->user_id
                    ]);
    
                    EventLiquor::where('event_id', $event_id)->update(['paid' => 1]);
                }
               
            }
    
        }

        $issued_date = strtotime($permit->issued_date);
        $expired_date = strtotime($permit->exprired_date);
        $today_date = strtotime(date('Y-m-d'));

        $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);

        if ($issued_date <= $today_date) {
            $new_issued_date = date('Y-m-d');
            $new_expiry_date = date('Y-m-d', strtotime($new_issued_date . ' + ' . $diff . ' days'));
            $permit->update(['issued_date' =>  $new_issued_date, 'expired_date' => $new_expiry_date]);
        }

        $permit->update(['permit_status' => 'active']);

        if (!$permit->permit_number) {
            $permit->update(['permit_number' => $permit_number]);
        }

        // if ($transArr) {
        //     $result = ['success', __('Payment Done Successfully'), 'Success'];
        // } else {
        //     $result = ['error', __('Error, Please Try Again'), 'Error'];
        // }

            DB::commit();
            $result = ['success', __('Payment Done Successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }


        return response()->json(['message' => $result , 'toURL' => $toURL]);
    }
 
    public function happiness_center(Request $request, $id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        return view('permits.artist.happinessmeter', ['id' => $id]);
    }

    public function submit_happiness(Request $request)
    {
        $toURL = URL::signedRoute('artist.index').'#applied';
        try {
            DB::beginTransaction();

        $permit_id = $request->permit_id ;
        $updateArray = array(
            'type' => 'artist',
            'application_id' =>  $permit_id,
            'rating' => $request->happiness,
            'remarks' => $request->remarks,
            'created_by' => Auth::user()->user_id
        );
        Happiness::create($updateArray);

        $permit = Permit::where('permit_id', $permit_id)->first();

        if($permit->exempt_payment == 1)
        {
            $permit_number = generateArtistPermitNumber();

            $issued_date = strtotime($permit->issued_date);
            $expired_date = strtotime($permit->exprired_date);
            $today_date = strtotime(date('Y-m-d'));

            $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);

            if ($issued_date <= $today_date) {
                $new_issued_date = date('Y-m-d');
                $new_expiry_date = date('Y-m-d', strtotime($new_issued_date . ' + ' . $diff . ' days'));
                $permit->update(['issued_date' =>  $new_issued_date, 'expired_date' => $new_expiry_date]);
            }

            $permit->update(['permit_status' => 'active']);

            if (!$permit->permit_number) {
                $permit->update(['permit_number' => $permit_number]);
            }
        }
        else if($permit->event)
        {
            if($permit->event->firm == 'government')
            {
                $permit_number = generateArtistPermitNumber();

                $issued_date = strtotime($permit->issued_date);
                $expired_date = strtotime($permit->exprired_date);
                $today_date = strtotime(date('Y-m-d'));

                $diff = round(abs($expired_date - $issued_date) / 60 / 60 / 24);

                if ($issued_date <= $today_date) {
                    $new_issued_date = date('Y-m-d');
                    $new_expiry_date = date('Y-m-d', strtotime($new_issued_date . ' + ' . $diff . ' days'));
                    $permit->update(['issued_date' =>  $new_issued_date, 'expired_date' => $new_expiry_date]);
                }

                $permit->update(['permit_status' => 'active']);

                if (!$permit->permit_number) {
                    $permit->update(['permit_number' => $permit_number]);
                }
            }
        }
            DB::commit();
            $result = ['success', __('Thank you for your Feedback'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        return response()->json(['message' => $result, 'toURL' => $toURL]);
    }

    public function checkVisaRequired($id)
    {
        return  Country::where('country_id', $id)->first()->continent_code;
    }

    function generateArtistReferenceNumber()
    {
        $last_permit_d = \App\Permit::max('reference_number');
        if (empty($last_permit_d)) {
            $new_refer_no = sprintf("RNA%04d",  1);
        } else {
            $last_rn = $last_permit_d;
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



}
