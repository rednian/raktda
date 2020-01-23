<?php

namespace App\Http\Controllers\Company;

use Auth;
use DB;
use Session;
use URL;
use PDF;
use Storage;

use Illuminate\Http\Request;
use App\EventType;
use App\Country;
use App\Emirates;
use App\Areas;
use App\Event;
use App\Requirement;
use App\EventRequirement;
use App\EventTypeRequirement;
use App\Company;
use App\EventLiquorTruckRequirement;
use App\EventTruck;
use App\EventLiquor;
use App\EventTransaction;
use App\Transaction;
use App\EventComment;
use App\EventOtherUpload ;;
use App\Happiness;
use App\EventTypeSub;
use App\ArtistTempData;
use App\Permit;
use App\User;
use App\ArtistPermit;
use App\Notifications\AllNotification;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use NumberToWords\NumberToWords;
use Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller
{

    public function index(Request $request)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        Event::whereDate('expired_date', '<', Carbon::now())->update(['status' => 'expired']);
        ArtistTempData::where('created_by', Auth::user()->user_id )->where('status' , 0)->delete();
        Permit::where('created_by', Auth::user()->user_id)->update(['is_edit' => 0]);
        return view('permits.event.index');
    }

    public function eventPreloadData() {
        $data['event_types'] = EventType::with('event_type_requirements', 'event_type_requirements.requirement', 'subType')->orderBy('name_en', 'asc')->get();
        $data['event_sub_types'] = EventTypeSub::all()->sortBy('sub_name_en');
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        return $data;
    }

    public function othersUpload(Request $request) {
        $user_id = Auth::user()->user_id;
        $ext = $request->file('other_file')->getClientOriginalExtension();
        $fileName = $request->file('other_file')->getClientOriginalName();
        $size = $request->file('other_file')->getSize();
        $toUrl = 'public/' . $user_id . '/event/temp/other';
        $path  = Storage::putFileAs($toUrl, $request->file('other_file'), $fileName );
    
        $savePath = $user_id . '/event/temp/other/'.$fileName;

        if (!Session::exists($user_id . '_event_other_file')) {
            session()->put($user_id . '_event_other_file', []);
            session()->put($user_id . '_event_other_file_ext', []);
        }
        session()->push($user_id . '_event_other_file' , 'public/'.$savePath);
        session()->push($user_id . '_event_other_file_ext' , $ext);
        // return json_encode($file);
        return response()->json(['filepath' => $path, 'ext' => $ext]);
    }

    public function del_other_upload_session(Request $request)
    {
        $filepath = $request->path;
        $ext = $request->ext;
        $user_id = Auth::user()->user_id;
        $files = session()->pull($user_id . '_event_other_file' , []);
        $exts = session()->pull($user_id . '_event_other_file_ext' , []);
        if (($key = array_search($filepath, $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search($ext, $exts)) !== false) {
            unset($exts[$key]);
        }
        $path  = Storage::delete($filepath);
        session()->put($user_id . '_event_other_file' , $files);
        session()->put($user_id . '_event_other_file_ext' , $exts);
        return $filepath;
    }

    public function create(Request $request)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $this->clearImageEventImageSession();
        $data = $this->eventPreloadData();
        $user_id = Auth::user()->user_id;
        EventLiquor::whereNull('event_id')->where('created_by', $user_id)->delete();
        EventTruck::whereNull('event_id')->where('created_by', $user_id)->delete();

        return view('permits.event.create', $data);
    }

    public function add_update_truck(Request $request)
    {
        try {
            DB::beginTransaction();

        $event_id = $request->event_id;
        $truck_id = $request->truck_id;
        $truck_details = json_decode($request->truckDetails, true);
        $truck_doc_details = json_decode($request->truckDocDetails, true);
        
        $requirements = Requirement::where('requirement_type', 'truck')->get();
        $requirement_ids = [];
        foreach ($requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements->count();
        $userid = Auth::user()->user_id;
        $date = date('d_m_Y_H_i_s');

        $update_array = array(
            'company_name_en' => $truck_details['company_name_en'],
            'company_name_ar' => $truck_details['company_name_ar'],
            'plate_number'    => $truck_details['plate_no'],
            'food_type'       => $truck_details['food_type'],
            'registration_issued_date' => $truck_details['regis_issue_date'] ? Carbon::parse($truck_details['regis_issue_date'])->toDateString() : '',
            'registration_expired_date' => $truck_details['regis_expiry_date'] ? Carbon::parse($truck_details['regis_expiry_date'])->toDateString() : '',
            'status' => 0,
            'created_by' => Auth::user()->user_id,
        );

        if($truck_id)
        {
            $event_truck_details = EventTruck::where('event_truck_id', $truck_id)->update($update_array);
        }else
        {
            if($event_id){
                $update_array['event_id'] = $event_id;
            }
            $event_truck_details = EventTruck::create($update_array);
            $truck_id = $event_truck_details->event_truck_id;
        }

       if($event_id)
       {
            $is_truck  = Event::where('event_id', $event_id)->first()->is_truck;

            if($is_truck == 0)
            {
                Event::where('event_id', $event_id)->update([
                    'is_truck' => 1
                ]);
            }
       }

       if(isset($request->truckDocNames) && $truck_id)
       {
            $dnd = json_decode($request->truckDocNames, true);

            if ($dnd) {
                $eventDocs = EventLiquorTruckRequirement::where('liquor_truck_id', $truck_id)->where('type', 'truck')->get();
                $filenames = [];
                for ($i = 1; $i <= count($dnd); $i++) {
                    $reqId = $dnd[$i]['reqId'];
                    foreach ($dnd[$i]['fileNames'] as $file) {
                        if ($file) {
                            array_push($filenames, $file);
                        }
                    }
                }
    
                foreach ($eventDocs as $doc) {
                    $name = explode('/', $doc->path);
                    $namee = end($name);
                    if (!in_array($namee, $filenames)) {
                        EventLiquorTruckRequirement::where('liquor_truck_id', $truck_id)->where('type', 'truck')->where('path', 'like', '%' . $namee)->delete();
                        Storage::delete('public/' . $doc->path);
                    }
                }
            }
       }

       

        if ($truck_doc_details) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_truck_file_'  . $l)) {

                    $total_docs = count(session($userid . '_truck_file_'  . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {

                            if(array_key_exists($k, session($userid  . '_truck_file_' . $l))) {

                                if (Storage::exists(session($userid  . '_truck_file_'  . $l)[$k])) {

                                    $ext_t = session($userid . '_truck_ext_'  . $l)[$k];

                                    $check_path = 'public/' . $userid . '/event/temp/truck/' . $truck_id . '/' . $l;

                                    $file_count = count(Storage::files($check_path));

                                    if ($file_count == 0) {
                                        $next_file_no = 1;
                                    } else {
                                        $next_file_no = $file_count + 1;
                                    }

                                    $newPathLink = $userid . '/event/temp/truck/' . $truck_id . '/'  . $l . '/' . $next_file_no . '_' . $date . '.' . $ext_t;

                                    if(!Storage::exists('public/'.$newPathLink))
                                    {
                                        Storage::move(session($userid  . '_truck_file_'  . $l)[$k], 'public/'.$newPathLink);
                                    }

                                    EventLiquorTruckRequirement::create([
                                        'issue_date' => !empty($truck_doc_details[$m]) ? Carbon::parse($truck_doc_details[$m]['issue_date'])->toDateString() : '',
                                        'expired_date' => !empty($truck_doc_details[$m])? Carbon::parse($truck_doc_details[$m]['exp_date'])->toDateString() : '',
                                        'created_at' =>  Carbon::now()->toDateTimeString(),
                                        'created_by' =>  Auth::user()->user_id,
                                        'requirement_id' => $l,
                                        'path' =>  $newPathLink,
                                        'type' => 'truck',
                                        'liquor_truck_id' => $truck_id
                                    ]);
                                }
                            }
                        }
                        $request->session()->forget([$userid . '_truck_file_'  . $l, $userid . '_truck_ext_'  . $l]);
                    }
                }
            }
        }

            if(isset($request->from) && $request->from == "amend")
            {
                Event::where('event_id', $request->event_id)->update([
                        'status' => 'amended'
                    ]);
            }
            $status = 'done';
            DB::commit();

        } catch (Exception $e) {
            $status = 'notdone';
            DB::rollBack();
        }

       return response()->json(['status' => $status]);
    
    }

    public function add_liquor(Request $request)
    {
       
        $liquor_details = $request->liquorDetails;
        // $liquorDocDetails = json_decode($request->liquorDocDetails,  true);
        $type = $request->type;
        $event_liquor_id = '';

        $old_event_liquor_id = $request->event_liquor_id;

        try {
            DB::beginTransaction();

        if ($liquor_details) {
            $lq = $liquor_details;
            // dd($lq);

            if($type == 1)
            {
                $update_array = array(
                    'liquor_permit_no' => $lq['liquor_permit_no'],
                    'provided' => 1
                );
            }else {
                $update_array = array(
                    'company_name_en' => $lq['company_name_en'],
                    'company_name_ar' => $lq['company_name_ar'],
                    'purchase_receipt'  => $lq['purchase_receipt'],
                    'liquor_service'  => $lq['liquor_service'],
                    'liquor_types'  => isset($lq['liquor_types']) ? $lq['liquor_types'] : '',
                    'provided' => 0
                );
    
            }

            if(isset($request->event_id))
            {
                $update_array['event_id'] = $request->event_id;
            }

            $update_array['created_by'] = Auth::user()->user_id;
            $update_array['status'] = 0;
            
            if ($old_event_liquor_id) {
                $event_liquor = EventLiquor::where('event_liquor_id', $old_event_liquor_id)->update($update_array);
                $event_liquor_id = $old_event_liquor_id;
            } else {
                $event_liquor = EventLiquor::create($update_array);
                $event_liquor_id = $event_liquor->event_liquor_id;
            }
        }


        $lqn = json_decode($request->liquorNames, true);

        if ($lqn && $old_event_liquor_id) {
            $eventDocs = EventLiquorTruckRequirement::where('liquor_truck_id', $event_liquor_id)->where('type', 'liquor')->get();
            $filenames = [];
            for ($i = 1; $i <= count($lqn); $i++) {
                $reqId = $lqn[$i]['reqId'];
                foreach ($lqn[$i]['fileNames'] as $file) {
                    if ($file) {
                        array_push($filenames, $file);
                    }
                }
            }
            foreach ($eventDocs as $doc) {
                $name = explode('/', $doc->path);
                $namee = end($name);
                if (!in_array($namee, $filenames)) {
                    EventLiquorTruckRequirement::where('liquor_truck_id', $event_liquor_id)->where('type', 'liquor')->where('path', 'like', '%' . $namee)->delete();
                    Storage::delete('public/' . $doc->path);
                }
            }
        }

        $requirements = Requirement::where('requirement_type', 'liquor')->get();

        $requirement_ids = [];

        foreach ($requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements->count();
        $userid = Auth::user()->user_id;
        $date = date('d_m_Y_H_i_s');

        // if ($liquorDocDetails) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_liquor_file_' . $l)) {

                    $total_docs = count(session($userid . '_liquor_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {

                            if(array_key_exists($k, session($userid  . '_liquor_file_' . $l))) {

                                if (Storage::exists(session($userid  . '_liquor_file_' . $l)[$k])) {

                                    $ext = session($userid . '_liquor_ext_' . $l)[$k];

                                    $check_path =  $userid . '/event/temp/liquor/' . $event_liquor_id . '/' . $l;

                                    $file_count = count(Storage::files('public/' .$check_path));

                                    if ($file_count == 0) {
                                        $next_file_no = 1;
                                    } else {
                                        $next_file_no = $file_count + 1;
                                    }

                                    $newPathLink = $check_path . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                    EventLiquorTruckRequirement::create([
                                        // 'issue_date' =>  $liquorDocDetails[$m] != null ? Carbon::parse($liquorDocDetails[$m]['issue_date'])->toDateTimeString() : '',
                                        // 'expired_date' => $liquorDocDetails[$m] != null ? Carbon::parse($liquorDocDetails[$m]['exp_date'])->toDateTimeString() : '',
                                        'created_at' =>  Carbon::now()->toDateTimeString(),
                                        'created_by' =>  Auth::user()->user_id,
                                        'requirement_id' => $l,
                                        'path' =>  $newPathLink,
                                        'type' => 'liquor',
                                        'liquor_truck_id' => $event_liquor_id
                                    ]);

                                    if(!Storage::exists('public/'.$newPathLink)){
                                        Storage::move(session($userid  . '_liquor_file_' . $l)[$k], 'public/'.$newPathLink);
                                    }
                                }
                            }
                        }
                        $request->session()->forget([$userid . '_liquor_file_' . $l, $userid . '_liquor_ext_' . $l]);
                    }
                }

            }
        // }
            DB::commit();
            if($old_event_liquor_id)
            {
                $result = ['success', __('Liquor Details Updated Successfully'), 'Success'];
            }else {
                $result = ['success', __('Liquor Details Added Successfully'), 'Success'];
            }
            
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }


        return response()->json(['message' => $result, 'event_liquor_id' => $event_liquor_id]);
    }

    public function deleteTruckLiquor(Request $request)
    {
        $event_id = $request->eventId;
        $from = $request->from;
        try {
            DB::beginTransaction();
       if($event_id) {      
            if($from == 'liquor')
            {
                EventLiquor::where('event_id', $event_id)->update(['status' => 1]);
            } else if ($from == 'truck')
            {
                EventTruck::where('event_id', $event_id)->update(['status' => 1]);
            }
       }else {
            if($from == 'liquor')
            {
                EventLiquor::whereNull('event_id')->update(['status' => 1]);
            } else if ($from == 'truck')
            {
                EventTruck::whereNull('event_id')->update(['status' => 1]);
            }
       }

       if($from == 'liquor')
       {
            Event::where('event_id', $event_id)->update(['is_liquor' => 0]);
       } else if ($from == 'truck')
       {
            Event::where('event_id', $event_id)->update(['is_truck' => 0]);
       }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

       return;

    }


    function insertEventImages($event_id, $desc){
        $userid = Auth::user()->user_id;
        $date = date('d_m_Y_H_i_s');
        if(session($userid . '_image_file')){  
            $total_docs = count(session($userid . '_image_file'));
            if ($total_docs > 0) {
                for ($k = 0; $k < $total_docs; $k++) {
                    if (Storage::exists(session($userid  . '_image_file')[$k])) {

                        $check_path =  $userid . '/event/' .  $event_id . '/pictures';
                        $size = session($userid . '_image_size')[$k];
                        $ext = session($userid . '_image_ext')[$k];
                        $file_count = count(Storage::files('public/' . $check_path));
                        if ($file_count == 0) {
                            $next_file_no = 1;
                        } else {
                            $next_file_no = $file_count + 1;
                        }
            
                        $newPathLink = $check_path .'/picture_' . $next_file_no . '_' . $date . '.' . $ext;
                        $newThumbPathLink = $check_path .'/thumb/picture_thumb_' . $next_file_no . '_' . $date . '.' . $ext;
            
                        if(!Storage::exists('public/'.$newPathLink))
                        {
                            Storage::move(session($userid . '_image_file')[$k], 'public/'.$newPathLink);
                        }
                        if(!Storage::exists('public/'.$newThumbPathLink))
                        {
                            Storage::move(session($userid . '_image_thumb')[$k], 'public/'.$newThumbPathLink);
                        }
            
                        EventOtherUpload::create([
                            'path' => $newPathLink,
                            'thumbnail' => $newThumbPathLink,
                            'event_id' => $event_id,
                            'size' => $size,
                            'description' => $desc,
                            'created_by' =>$userid, 
                        ]);
                    }
                }  
                // session()->forget([$userid . '_image_file', $userid . '_image_ext', $userid . '_image_thumb', $userid . '_image_size']);     
                $this->clearImageEventImageSession();
            }
        }
    }


    public function store(Request $request)
    {
        
        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);
        $lq = json_decode($request->lq, true);
        $from = $request->from;
        $cid = Auth::user()->type == 1 ? Auth::user()->EmpClientId : '';
        $userid = Auth::user()->user_id;

        $event_id = ''; $toURL = '';

        try {
            DB::beginTransaction();

        $input_Array = array(
            'name_en' => $evd['name'],
            'name_ar' => $evd['name_ar'],
            'address' => $evd['address'],
            'venue_en' => $evd['venue_en'],
            'venue_ar' => $evd['venue_ar'],
            'country_id' => 232,
            'emirate_id' => $evd['emirate_id'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
            'status' => 'new',
            'street' => $evd['street'],
            'description_en' => $evd['description_en'],
            'description_ar' => $evd['description_ar'],
            'longitude' => $evd['longitude'],
            'latitude' => $evd['latitude'],
            'full_address' => $evd['full_address'],
            'is_truck' => $evd['isTruck'],
            'is_liquor' => $evd['isLiquor'],
            'firm' => $evd['firm_type'],
            'audience_number' => $evd['no_of_audience'],
            'owner_name' => $evd['owner_name'],
            'owner_name_ar' => $evd['owner_name_ar'],
            'additional_location_info' => trim($evd['addi_loc_info']),          
            'event_type_sub_id' => $evd['event_sub_type_id'],
            'reference_number' => $this->generateReferenceNumber()
        );

        if ($from == 'new') {
            $input_Array['issued_date'] = $evd['issued_date'];
            $input_Array['expired_date'] = $evd['expired_date'];
            $input_Array['time_start'] = $evd['time_start'];
            $input_Array['time_end'] = $evd['time_end'];
            $input_Array['request_type'] = 'new request';
            $input_Array['created_by'] = $userid;
            $input_Array['created_at'] = Carbon::now();
            $event = Event::create($input_Array);
            $event_id = $event->event_id;
            if($request->artist == 1){
                $toURL = URL::signedRoute('event.add_artist', [ 'id' => 0]);
            }else {
                $toURL = URL::signedRoute('event.index').'#applied';
            }
            
        } else if ($from == 'draft') {

            $toURL = URL::signedRoute('event.index').'#applied';

            $input_Array['issued_date'] = Carbon::parse($evd['issued_date'])->toDateTimeString();
            $input_Array['expired_date'] = Carbon::parse($evd['expired_date'])->toDateTimeString();
            $input_Array['time_start'] = Carbon::parse($evd['time_start'])->toDateTimeString();
            $input_Array['time_end'] = Carbon::parse($evd['time_end'])->toDateTimeString();
            $event = Event::where('event_id', $evd['event_draft_id'])->update($input_Array);
            $event_id = $evd['event_draft_id'];

            $dnd = json_decode($request->documentNames, true);

            if ($dnd) {
                $eventDocs = EventRequirement::where('event_id', $event_id)->get();
                $filenames = [];
                for ($i = 1; $i <= count($dnd); $i++) {
                    $reqId = $dnd[$i]['reqId'];
                    foreach ($dnd[$i]['fileNames'] as $file) {
                        if ($file) {
                            array_push($filenames, $reqId . '/' . $file);
                        }
                    }
                }

                foreach ($eventDocs as $doc) {
                    $name = explode('/', $doc->path);
                    $namee = $name[3] . '/' . end($name);
                    if (!in_array($namee, $filenames)) {
                        EventRequirement::where('event_id', $event_id)->where('path', 'like', '%' . $namee)->delete();
                        Storage::delete('public/' . $doc->path);
                    }
                }
            }
        }
     
        $firm = $evd['firm_type'];

        $requirements = EventType::with(['requirements' => function ($q) use ($firm) {
            $q->where('type', '=', $firm);
        }])->where('event_type_id', $evd['event_type_id'])->first();

        $requirement_ids = [];

        foreach ($requirements['requirements'] as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements['requirements']->count();

        $date = date('d_m_Y_H_i_s');

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_event_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_event_doc_file_' . $l));

                    // dump($total_docs);
                    // dd(session($userid . '_event_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {

                            if(array_key_exists($k, session($userid  . '_event_doc_file_' . $l))) {

                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {

                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path = $userid . '/event/' . $event_id . '/' . $l;

                                $file_count = count(Storage::files('public/' . $check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                $newPathLink = $check_path . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;

                               if(!Storage::exists('public/'.$newPathLink)){
                                Storage::move(session($userid  . '_event_doc_file_' . $l)[$k],'public/'.$newPathLink);
                               }

                                EventRequirement::create([
                                    'issued_date' => !empty((array) $dod[$m]) ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => !empty((array) $dod[$m]) ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'event_type_id' => $evd['event_type_id'],
                                    'type' => 'event',
                                    'requirement_id' => $l,
                                    'event_id' => $event_id,
                                    'path' =>  $newPathLink,
                                ]);
                            }
                            }
                        }
                        $request->session()->forget([$userid . '_event_doc_file_' . $l, $userid . '_event_ext_' . $l]);
                    }
                }
            }
        }

        if(isset($request->imgPaths))
        {
            $imgPaths = json_decode($request->imgPaths, true);
            $this->checkImagePaths($imgPaths, $event_id, $request->description);
        }
        
        if($evd['isLiquor'] == 1)
        {
            EventLiquor::whereNull('event_id')->where('status',0)->where('created_by', Auth::user()->user_id)->update([
                'event_id' => $event_id,
            ]);

            $eventLiquor = EventLiquor::where('event_id', $event_id)->latest()->first();

            if($eventLiquor)
            {
                $requirements =  EventLiquorTruckRequirement::where('liquor_truck_id', $eventLiquor->event_liquor_id)->where('type', 'liquor')->get();

                foreach ($requirements as $req) {
                    $path = $req->path;
                    $newpath = str_replace('temp', $event_id, $path);
                    if(!Storage::exists('public/'.$newpath))
                    {
                        Storage::move('public/'.$path, 'public/'.$newpath);
                    }
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                    ]);

                    Storage::delete('public/'.$path);
                }
            }
        }


        if($evd['isTruck'] == 1)
        {
            EventTruck::whereNull('event_id')->where('status',0)->where('created_by', Auth::user()->user_id)->update([
                'event_id' => $event_id
            ]);

            $truck_id_query = EventTruck::where('event_id', $event_id)->where('status', 0)->get();
            $truck_ids = [];
            foreach($truck_id_query as $truck_idd)
            {
                array_push($truck_ids, $truck_idd->event_truck_id);
            }

            for ($a = 0; $a < count($truck_ids); $a++) {
                $requirements =  EventLiquorTruckRequirement::where('liquor_truck_id', $truck_ids[$a])->where('type', 'truck')->get();

                foreach ($requirements as $req) {
                    $path = $req->path;
                    $newpath = str_replace('temp', $event_id, $path);
                    if(!Storage::exists('public/'.$newpath))
                    {
                        Storage::move('public/'.$path, 'public/'.$newpath);
                    }
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                    ]);

                    Storage::delete('public/'.$path);
                }
            }
            
        }

        EventLiquor::whereNull('event_id')->where('status',1)->delete();
        EventTruck::whereNull('event_id')->where('status',1)->delete();

        if (session($userid . '_event_pic_file')) {
            $ext = session($userid . '_event_ext');
            $check_path =  $userid . '/event/' .  $event_id . '/photos';
            $file_count = count(Storage::files('public/' . $check_path));
            if ($file_count == 0) {
                $next_file_no = 1;
            } else {
                $next_file_no = $file_count + 1;
            }

            $newPathLink = $check_path .'/logo_' . $next_file_no . '_' . $date . '.' . $ext;
            $newThumbPathLink = $check_path .'/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;

            if(!Storage::exists('public/'.$newPathLink))
            {
                Storage::move(session($userid . '_event_pic_file'), 'public/'.$newPathLink);
            }
            if(!Storage::exists('public/'.$newThumbPathLink))
            {
                Storage::move(session($userid . '_event_thumb_file'), 'public/'.$newThumbPathLink);
            }
            
            session()->forget([$userid . '_event_pic_file', $userid . '_event_ext', $userid . '_event_thumb_file']);
            Event::where('event_id', $event_id)->update(['logo_original' => $newPathLink, 'logo_thumbnail' => $newThumbPathLink]);

            Storage::delete([session($userid . '_event_pic_file') , session($userid . '_event_thumb_file')]);

        }

            $this->insertEventImages($event_id, $request->description);
            DB::commit();
            $event = Event::where('event_id', $event_id)->latest()->first();
            $this->sendNotification($event, 'new');
            $result = ['success', __('Event Permit Applied Successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        return response()->json(['message' => $result, 'event_id' => $event_id, 'toURL' => $toURL]);
    }

    public function get_uploaded_eventImages($id){
        return EventOtherUpload::where('event_id', $id)->get();
    }

    public function delete_truck_details($id)
    {
        try {
            DB::beginTransaction();
            EventTruck::where('event_truck_id', $id)->update([
                'status' => 1
            ]);
            DB::commit();
            $status = 'done';
        } catch (Exception $e) {
            DB::rollBack();
            $status = 'notdone';
        }
        
        return response()->json(['status' => $status]);
    }

    public function fetch_this_truck_details($id)
    {
        return EventTruck::where('event_truck_id', $id)->first();
    }

    public function show(Request $request, Event $event)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        if ($event->permit) {
            $permit_id = $event->permit->permit_id;
            $artist = \App\Permit::where('permit_id', $permit_id)->with('artistPermit')->where('created_by', Auth::user()->user_id)->first();
        } else {
            $artist = [];
        }
        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['eventReq'] = $event->requirements()->get();
        $data['event'] = $event;
        $data['artist'] = $artist;
        $data['tab'] =  $request->tab;
        $data['eventImages']  = $event->otherUpload;
 
        return view('permits.event.show', $data);
    }


    public function edit(Request $request, Event $event)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data = $this->eventPreloadData();
        $data['staff_comments'] = $event->comment()->where('type', 1)->get();
        $data['event'] = $event;
        if (! $event) {
            abort(401);
        }
        if ($event->status == 'processing') {
            return redirect('company/event');
        }
        return view('permits.event.edit', $data);
    }

    public function fetch_truck_details_by_event_id($id)
    {
        return  EventTruck::where('event_id', $id)->where('status', '0')->get();
    }

    public function fetch_this_truck_docs(Request $request)
    {
        $req = $request->reqId;
        $truck_id = $request->truckId;
        return EventLiquorTruckRequirement::where([
            ['type', 'truck'],
            ['liquor_truck_id', $truck_id],
            ['requirement_id',  $req],
        ])->get();
    }

    public function calendarFn(Request $request)
    {
        
        $user = Auth::user();
        $allEvents = Event::where('is_display_all', 1)->whereNotIn('status', ['cancelled']);
        $events = Event::whereIn('status', ['active', 'expired'])->where('created_by', Auth::user()->user_id)->union($allEvents)->get();

        $events = $events->map(function ($event) use ($user) {
            // $input = array("fc-event-danger", "fc-event-success", "fc-event-primary", "fc-event-light","fc-event-danger", "fc-event-brand");
            // $arr = array("fc-event-solid-primary",  "fc-event-solid-warning", "fc-event-solid-success");
            // $rand_keys = array_rand($input, 2);
            // $rand_keys_d = array_rand($arr, 2);
            return [    
                'title' => $user->LanguageId == 1 ?  ucwords($event->name_en) : $event->name_ar,
                'start' => date('Y-m-d', strtotime($event->issued_date)) . 'T' . date('H:i:s', strtotime($event->time_start)),
                'end' => date('Y-m-d', strtotime($event->expired_date)) . 'T' . date('H:i:s', strtotime($event->time_end)),
                'id' => $event->event_id,
                'url' => $event->created_by == $user->user_id ? URL::signedRoute('event.show',[ 'id' =>  $event->event_id, 'tab' => 'calendar'])  : '#',
                'description' => 'Venue : ' . ( $user->LanguageId == 1  ? ucwords($event->venue_en) : $event->venue_ar )    ,
                'backgroundColor' => '#8c272d !important',
                'textColor' => '#fff !important',
            ];
        });
        return response()->json($events);
    }

    public function get_truck_files_uploaded($id)
    {
        return EventRequirement::where('event_id', $id)->where('type', 'truck')->get();
    }

    public function update_event(Request $request)
    {
        try {
            DB::beginTransaction();

        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);
        $dnd = json_decode($request->documentNames, true);
        $event_id = $request->event_id;
        $userid = Auth::user()->user_id;

        $input_Array = array(
            'name_en' => $evd['name'],
            'name_ar' => $evd['name_ar'],
            'issued_date' => $evd['issued_date'] ? Carbon::parse($evd['issued_date'])->format('Y-m-d') : '',
            'expired_date' => $evd['expired_date'] ? Carbon::parse($evd['expired_date'])->format('Y-m-d') : '',
            'time_start' => $evd['time_start'],
            'time_end' => $evd['time_end'],
            'address' => $evd['address'],
            'venue_en' => $evd['venue_en'],
            'venue_ar' => $evd['venue_ar'],
            'country_id' => 232,
            'emirate_id' => $evd['emirate_id'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
            'longitude' => $evd['longitude'],
            'latitude' => $evd['latitude'],
            'full_address' => $evd['full_address'],
            'firm' => $evd['firm_type'],
            'is_truck' => $evd['isTruck'],
            'is_liquor' => $evd['isLiquor'],
            'audience_number' => $evd['no_of_audience'],
            'additional_location_info' => $evd['addi_loc_info'],      
            'event_type_sub_id' => $evd['event_sub_type_id']
        );

        $old_status = Event::where('event_id', $event_id)->first()->status;

        if ($old_status == 'new') {
            $input_Array['status'] = 'new';
        } else {
            $input_Array['status'] = 'amended';
            $input_Array['request_type'] = 'bounced
             back request';
        }

        $event = Event::where('event_id', $event_id)->update($input_Array);

        $firm = $evd['firm_type'];

        $requirements = EventType::with(['requirements' => function ($q) use ($firm) {
            $q->where('type', '=', $firm);
        }])->where('event_type_id', $evd['event_type_id'])->first();

        $total_req = $requirements['requirements']->count();

        $requirement_ids = [];

        foreach ($requirements->requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }

        if(isset($request->imgPaths))
        {
            $imgPaths = json_decode($request->imgPaths, true);
            $this->checkImagePaths($imgPaths, $event_id, $request->description);
        }

        $add_req = Event::with('additionalRequirements')->where('event_id', $event_id)->first();

        foreach ($add_req->additionalRequirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }

        $total_addi = $add_req['additionalRequirements']->count();

        $total = (int) $total_req + (int) $total_addi;

        if ($dnd) {
            $eventDocs = EventRequirement::where('event_id', $event_id)->where('type', 'event')->get();
            $filenames = [];
            for ($i = 1; $i <= count($dnd); $i++) {
                $reqId = $dnd[$i]['reqId'];
                foreach ($dnd[$i]['fileNames'] as $file) {
                    if ($file) {
                        array_push($filenames, $reqId . '/' . $file);
                    }
                }
            }

            foreach ($eventDocs as $doc) {
                $name = explode('/', $doc->path);
                $namee = $name[3] . '/' . end($name);
                if (!in_array($namee, $filenames)) {
                    EventRequirement::where('event_id', $event_id)->where('path', 'like', '%' . $namee)->where('type', 'event')->delete();
                    Storage::delete('public/' . $doc->path);
                }
            }
        }

        $this->insertEventImages($event_id, $request->description);

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_event_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_event_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {

                            if(array_key_exists($k, session($userid  . '_event_doc_file_' . $l))) {

                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {

                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path = $userid . '/event/' . $event_id . '/' . $l;

                                if (Storage::exists('public/' . $check_path)) {
                                    $file_count = count(Storage::files('public/' . $check_path));
                                    $next_file_no = $file_count + 1;
                                } else {
                                    $next_file_no = 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                //$eventTypeName = str_replace(' ', '_', EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $date = date('d_m_Y_H_i_s');
                        
                                $newPathLink = $check_path. '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;

                                if(!Storage::exists('public/'.$newPathLink))
                                {
                                    Storage::move(session($userid  . '_event_doc_file_' . $l)[$k], 'public/'.$newPathLink);
                                }

                                

                                EventRequirement::create([
                                    'issued_date' => !empty((array) $dod[$m]) ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => !empty((array) $dod[$m]) ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'event_type_id' => $evd['event_type_id'],
                                    'type' => 'event',
                                    'requirement_id' => $l,
                                    'event_id' => $event_id,
                                    'path' =>  $newPathLink,
                                ]);
                            } 
                        }
                           
                        }
                        $request->session()->forget([$userid . '_event_doc_file_' . $l, $userid . '_event_ext_' . $l]);

                        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/event/temp/' . $l);
                    }
                }
            }
        }


            DB::commit();
            $event = Event::where('event_id',$request->event_id)->latest()->first();
            $this->sendNotification($event, 'edit');
            $result = ['success', __('Event Permit Updated Successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }


        // if ($event) {
        //     $result = ['success', __('Event Permit Updated Successfully'), 'Success'];
        // } else {
        //     $result = ['error', __('Error, Please Try Again'), 'Error'];
        // }

        return response()->json(['message' => $result, 'toURL' => URL::signedRoute('event.index').'#applied']);
    }

    public function cancel(Request $request)
    {
        try {
            DB::beginTransaction();
            $event_id = $request->permit_id;
            $reason = $request->cancel_reason;

            Event::where('event_id', $event_id)->update([
                'cancel_date' => Carbon::now(),
                'status' => 'cancelled',
                'cancelled_by' => Auth::user()->user_id,
                'cancel_reason' => $reason
            ]);
            DB::commit();
            $result = ['success', __('Permit Cancelled successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }
        return redirect(URL::signedRoute('event.index').'#draft')->with('message', $result);
    }

    public function get_status($id)
    {
        return Event::where('event_id', $id)->first()->status;
    }

    public function cancel_reason($id = null)
    {
        return Event::where('event_id', $id)->first()->cancel_reason;
    }

    public function reject_reason($id)
    {
        return EventComment::with('event')->where('event_id', $id)->latest()->first();
    }

    public function upload(Event $event)
    {
        return view('permits.event.upload', ['event' => $event]);
    }

    public function download(Request $request , $id)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }

        $hasHappiness = Happiness::where('type', 'event')->where('application_id', $id)->exists();
        if(!$hasHappiness)
        {
            return redirect(URL::signedRoute('company.happiness_center', ['id' => $id]));
        }

        $event_details = Event::with('type', 'country')->where('event_id', $id)->first();
        
        $data['event_details'] = $event_details;
        $from = Event::where('event_id', $id)->first()->issued_date;
        $to = Event::where('event_id', $id)->first()->expired_date;
        $from_date_formatted = Carbon::parse($from);
        $to_date_formatted = Carbon::parse($to);
        $diff = $from_date_formatted->diffInDays($to_date_formatted) == 0 ? 1 : $from_date_formatted->diffInDays($to_date_formatted);
        $numberToWords = new NumberToWords();
        $numberTransformer = $numberToWords->getNumberTransformer('en');
        $data['diff'] = $diff;
        $data['days'] = $numberTransformer->toWords($diff);

        $event_permit_no = $event_details->permit_number;
        // $pdf = PDF::loadView('permits.event.print', $data, [], [
        //     'title' => 'Event Permit',
        //     'default_font_size' => 10
        // ]);
        if($event_details->truck()->exists()){
            $data['truck'] = EventTruck::where('event_id', $id)->get();
        }
        if($event_details->liquor()->exists()){
            $data['liquor'] = EventLiquor::where('event_id', $id)->first();
        }
        
        $pdf = PDF::loadView('permits.event.print', $data, [], [
            'title' => 'Event Permit',
            'default_font_size' => 10
        ]);
        
        if($event_details->truck()->exists()){
            $pdf->getMpdf()->AddPage();
            $pdf->getMpdf()->WriteHTML(\View::make('permits.event.truckprint')->with($data)->render());
        }
        if($event_details->liquor()->exists()){
            if($event_details->liquor->provided != null || $event_details->liquor->provided != 1)
            {
                $pdf->getMpdf()->AddPage();
                $pdf->getMpdf()->WriteHTML(\View::make('permits.event.liquorprint')->with($data)->render());
            }
        }
        // $pdf->getMpdf()->useDefaultCSS2();
        return $pdf->stream('Event Permit-' . $event_permit_no . '.pdf');
    }

    public function fetch_applied(Request $request)
    {
        if($request->ajax()) {
            return $this->datatable_function('applied');
        }
    }

    public function fetch_valid(Request $request)
    {
        if($request->ajax()) {
            return $this->datatable_function('valid', '');
        }
    }

    public function fetch_draft(Request $request)
    {
        if($request->ajax()) {
            return $this->datatable_function('draft', '');
        }
    }

    public function fetch_expired(Request $request)
    {
        if($request->ajax()) {
            return $this->datatable_function('expired');
        }
    }

    public function fetch_cancelled(Request $request)
    {
        if($request->ajax()) {
            return $this->datatable_function('cancelled');
        }
    }


    function datatable_function($status)
    {
        $permits = Event::orderBy('created_at', 'desc')->where('created_by', Auth::user()->user_id);

        if ($status == 'applied') {
            $permits->whereNotIn('status', ['active', 'draft', 'expired', 'cancelled', 'rejected']);
        } else if ($status == 'valid') {
            $permits->whereIn('status', ['active'])->OrderBy('updated_at', 'desc');
        } else if ($status == 'draft') {
            $permits->where('status', 'draft');
        } else if ($status == 'expired') {
            $permits->where('status', 'expired');
        } else if ($status == 'cancelled') {
            $permits->whereIn('status', ['cancelled', 'rejected']);
        }

        $permits->latest();

        $amend_grace = getSettings()->event_grace_period_amendment;

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
        })->editColumn('name_en', function ($permits) {
            return getLangId() == 1 ? $permits->name_en : $permits->name_ar ;
        })->addColumn('action', function ($permit) use ($status, $amend_grace) {
            if(check_is_blocked()['status'] == 'blocked'){
                return ;
            }
            switch ($status) {
                case 'applied':
                    if ($permit->firm == 'government' && $permit->status == 'approved-unpaid') {
                        return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('event.happiness', $permit->event_id) . '"  title="'.__('Happiness').'"><span class="kt-badge kt-badge--success kt-badge--inline">'.__('Happiness').'</span></a>';
                    }else if ($permit->status == 'approved-unpaid') {
                        return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.event.payment', $permit->event_id) . '"  title="'.__('Payment').'"><span class="kt-badge kt-badge--success kt-badge--inline">'.__('Payment').'</span></a>';
                    }  else if ($permit->status == 'need modification') {
                        return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('event.edit', $permit->event_id) . '" title="edit" ><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">'.__('Edit').'</span></a><a href="' . \Illuminate\Support\Facades\URL::signedRoute('event.add_artist', $permit->event_id) . '" title="Add Artist" class="kt-font-dark kt-margin-l-10"><i class="fa fa-user-plus"></i></a>';
                    } else if ($permit->status == 'new') {
                        // return '<span onClick="cancel_permit(' . $permit->event_id . ',\'' . $permit->reference_number . '\','.''.')" data-toggle="modal" class="kt-badge kt-badge--danger kt-badge--inline">Cancel</span>';
                    }
                    break;
                case 'valid':
                    if ($permit->status == 'active') {
                        $approved_date = strtotime($permit->approved_date);
                        $today = strtotime(date('Y-m-d 00:00:00'));
                        $diff = abs($today - $approved_date) / 60 / 60 / 24;
                        $amend_btn = ($diff <= $amend_grace) ? '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('event.amend', $permit->event_id) . '" title="amend" ><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-l-15">Amend </span></a><a href="' . \Illuminate\Support\Facades\URL::signedRoute('event.add_artist', $permit->event_id) . '" title="'.__('Add Artist').'" class="kt-font-dark kt-pull-right"><i class="fa fa-user-plus"></i></a><br />' : '';
                        return $amend_btn . '<span onClick="cancel_permit(' . $permit->event_id . ',\'' . $permit->reference_number . '\',\''.$permit->permit_number.'\')" data-toggle="modal" class="kt-badge kt-badge--danger kt-badge--inline" title="'.__('Cancel Permit').'">'.__('Cancel').'</span>';
                    } else if ($permit->status == 'expired') {
                        return '<div class="alert-text">'.__('Expired').'</div>';
                    }
                    break;
                case 'draft':   
                    if ($permit->status == 'draft') {
                        return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.event.draft', $permit->event_id) . '"  title="View"><span class="kt-badge kt-badge--warning kt-badge--inline">View</span></a>&emsp;<span onClick="delete_draft(' . $permit->event_id . ')" data-toggle="modal" class="kt-badge kt-badge--danger kt-badge--inline">'.__('Delete').'</span>';
                    }
                    break;
                case 'cancelled':
                    if ($permit->status == 'rejected') {
                        return '<span onClick="rejected_permit(' . $permit->event_id . ')" data-toggle="modal" data-target="#rejected_permit" class="kt-badge kt-badge--danger kt-badge--inline">'.__('Rejected').'</span>';
                    } else if ($permit->status == 'cancelled') {
                        return '<span onClick="show_cancelled(' . $permit->event_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="kt-badge kt-badge--info kt-badge--inline">'.__('Cancelled').'</span>';
                    }
                    break;
            }
        })->addColumn('type_name', function($permit) {
            return getLangId() == 1 ? $permit->type->name_en : $permit->type->name_ar ; 
        })->addColumn('permit_status', function ($permit) {
            $status = $permit->status;
            $ret_status = '';
            if($status == 'amended' || $status == 'new' || $status == 'need approval' || $status == 'processing' || $status == 'checked') {
                return $ret_status = __('Pending'); 
            }else if($status == 'approved-unpaid') {
                return $ret_status = __('Approved');
            }else if($status == 'need modification') {
                return $ret_status = __('Bounce Back');
            }else {
                return $ret_status = $permit->status;
            }
            
        })->addColumn('details', function ($permit)  use ($status) {
            $from = '';
            switch ($status) {
                case 'applied':
                    $from = 'applied';
                    break;
                case 'valid':
                    $from = 'valid';
                    break;
                case 'draft':
                    $from = 'draft';
                    break;
                case 'expired':
                    $from = 'expired';
                    break;
                case 'cancelled':
                    $from = 'cancelled';
                    break;
            }
            return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('event.show',[ 'id' =>  $permit->event_id , 'tab' => $from]) .'" title="'.__('View Details').'" class="kt-font-dark"><i class="fa fa-file fs-16"></i></a>';
        })->addColumn('download', function ($permit) {
            if ($permit->status == 'expired') {
                return;
            } else {
                return '<a href="' . \Illuminate\Support\Facades\URL::signedRoute('company.event.download', $permit->event_id) . '" target="_blank" title="'.__('Download Permit').'"><i class="fa fa-file-download fs-16"></i></a>';
            }
        })->rawColumns(['action', 'details', 'download'])->make(true);
    }


    public function amend(Request $request, Event $event)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data['eventReq'] = $event->requirements()->get();
        $data['event'] =  $event;
        $data['tab'] = 'valid';
        $data['truck_req'] = $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();

        return view('permits.event.amend', $data);
    }

    public function applyAmend(Request $request)
    {
        try {
            DB::beginTransaction();
        $liquor_details = $request->liquorDetails;
        $liquorDocDetails = json_decode($request->liquorDocDetails,  true);
        $event_liquor_id = $request->event_liquor_id;
        $type = $request->type;
        $event = Event::where('event_id', $request->event_id)->update(
            [
                'issued_date' => Carbon::parse($request->issued_date)->toDateString(),
                'expired_date' => Carbon::parse($request->expired_date)->toDateString(),
                'time_start' => $request->time_start,
                'time_end' => $request->time_end,
                'status' => 'amended', 
                'request_type' => 'amend request'
            ]
        );

        if ($liquor_details) {
            $lq = $liquor_details;
            if($type == 1)
            {
                $update_array = array(
                    'liquor_permit_no' => $lq['liquor_permit_no'],
                    'provided' => 1
                );
            }else {
                $update_array = array(
                    'company_name_en' => $lq['company_name_en'],
                    'company_name_ar' => $lq['company_name_ar'],
                    'purchase_receipt'  => $lq['purchase_receipt'],
                    'liquor_service'  => $lq['liquor_service'],
                    'liquor_types'  => isset($lq['liquor_types']) ? $lq['liquor_types'] : '',
                    'provided' => 0
                );
    
            }

            $event_liquor = EventLiquor::where('event_liquor_id', $event_liquor_id)->update($update_array);
        }

        $dnd = json_decode($request->liquorNames, true);

        if ($dnd && $event_liquor_id) {
            $eventDocs = EventLiquorTruckRequirement::where('liquor_truck_id', $event_liquor_id)->where('type', 'liquor')->get();
            $filenames = [];
            for ($i = 1; $i <= count($dnd); $i++) {
                $reqId = $dnd[$i]['reqId'];
                foreach ($dnd[$i]['fileNames'] as $file) {
                    if ($file) {
                        array_push($filenames, $file);
                    }
                }
            }
            foreach ($eventDocs as $doc) {
                $name = explode('/', $doc->path);
                $namee = end($name);
                if (!in_array($namee, $filenames)) {
                    EventLiquorTruckRequirement::where('liquor_truck_id', $event_liquor_id)->where('type', 'liquor')->where('path', 'like', '%' . $namee)->delete();
                    Storage::delete('public/' . $doc->path);
                }
            }
        }

        $requirements = Requirement::where('requirement_type', 'liquor')->get();

        $requirement_ids = [];

        foreach ($requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements->count();
        $userid = Auth::user()->user_id;
        $date = date('d_m_Y_H_i_s');

        if ($liquorDocDetails) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_liquor_file_' . $l)) {

                    $total_docs = count(session($userid . '_liquor_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_liquor_file_' . $l)[$k])) {

                                $ext = session($userid . '_liquor_ext_' . $l)[$k];

                                $check_path =  $userid . '/event/temp/liquor/' . $event_liquor_id . '/' . $l;

                                $file_count = count(Storage::files('public/' .$check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $newPathLink = $check_path . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                EventLiquorTruckRequirement::create([
                                    'issue_date' =>  $liquorDocDetails[$m] != null ? Carbon::parse($liquorDocDetails[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => $liquorDocDetails[$m] != null ? Carbon::parse($liquorDocDetails[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'requirement_id' => $l,
                                    'path' =>  $newPathLink,
                                    'type' => 'liquor',
                                    'liquor_truck_id' => $event_liquor_id
                                ]);

                                if(!Storage::exists('public/'.$newPathLink)){
                                    Storage::move(session($userid  . '_liquor_file_' . $l)[$k], 'public/'.$newPathLink);
                                }

                            }
                        }
                        $request->session()->forget([$userid . '_liquor_file_' . $l, $userid . '_liquor_ext_' . $l]);
                    }
                }
            }
        }
        DB::commit();
        $event = Event::where('event_id', $request->event_id)->latest()->first();
        $this->sendNotification($event, 'amend');
        $result = ['success', __('Event Permit Amended successfully'), 'Success'];
    } catch (Exception $e) {
        DB::rollBack();
        $result = ['error', __($e->getMessage()), 'Error'];
    }
            

        return response()->json(['message' => $result , 'toURL' =>  URL::signedRoute('event.index').'#applied']);
    }

    public function fetch_truck_req($id)
    {
        return Requirement::where('requirement_type', 'truck')->get();
    }

    public function generateReferenceNumber()
    {
        $last_permit_d = Event::max('reference_number');
        if ($last_permit_d) {
            $last_rn = $last_permit_d;
            $n = substr($last_rn, 3);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_refer_no = sprintf("RNE%0" . $x . "d", $n + 1);
        } else {
            $new_refer_no = sprintf("RNE%04d",  1);
        }
        return $new_refer_no;
    }


    public function fetch_requirements(Request $request)
    {
        $id = $request->id;
        $firm = $request->firm;
        // $requirements = EventType::with(['requirements' => function ($q) use ($firm) {
        //     $q->where('type', '=', $firm);
        // }, 'requirements.event_type_requirements'])->where('event_type_id', $id)->latest()->first();

        $requirements = Requirement::whereHas('type', function ($q) use ($id){
            $q->where('event_type.event_type_id', $id);
        })->where('type', $firm)->where('requirement_type', 'event')->with(['event_type_requirements' => function($q) use($id ){ $q->where('event_type_id', $id);}])->get();


        return $requirements;
    }

    public function fetch_additional_requirements($id)
    {
        return Event::with('additionalRequirements')->where('event_id', $id)->first();
    }

    public function get_uploaded_docs(Request $request)
    {
        $event_id = $request->eventId;
        $req_id = $request->reqId;

        $docs = EventRequirement::with('requirement')->where('event_id', $event_id)->where('requirement_id', $req_id)->orderBy('created_at', 'desc')->get();
        // dd($docs);
        return $docs;
    }

    public function add_draft(Request $request)
    {

        $toURL = '';
        try {
            DB::beginTransaction();

        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);

        $cid = Auth::user()->type == 1 ? Auth::user()->EmpClientId : '';
        $userid = Auth::user()->user_id;

        $input_Array = array(
            'name_en' => $evd['name'],
            'name_ar' => $evd['name_ar'],
            'issued_date' => $evd['issued_date'],
            'expired_date' => $evd['expired_date'],
            'time_start' => $evd['time_start'],
            'time_end' => $evd['time_end'],
            'address' => $evd['address'],
            'venue_en' => $evd['venue_en'],
            'venue_ar' => $evd['venue_ar'],
            'street' => $evd['street'],
            'description_en' => $evd['description_en'],
            'description_ar' => $evd['description_ar'],
            'longitude' => $evd['longitude'],
            'latitude' => $evd['latitude'],
            'full_address' => $evd['full_address'],
            'is_truck' => $evd['isTruck'],
            'is_liquor' => $evd['isLiquor'],
            'firm' => $evd['firm_type'],
            'audience_number' => $evd['no_of_audience'],
            'country_id' => 232,
            'emirate_id' => $evd['emirate_id'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
            'owner_name' => $evd['owner_name'],
            'owner_name_ar' => $evd['owner_name_ar'],
            'company_id' => Auth::user()->EmpClientId,
            'status' => 'draft',
            'created_by' =>  $userid,
            'additional_location_info' => trim($evd['addi_loc_info']),          
            'event_type_sub_id' => $evd['event_sub_type_id']
        );

        $event = Event::create($input_Array);

        $event_id = $event->event_id;

        $firm = $evd['firm_type'];

        $requirements = EventType::with(['requirements' => function ($q) use ($firm) {
            $q->where('type', '=', $firm);
        }])->where('event_type_id', $evd['event_type_id'])->first();

        $requirement_ids = [];

        foreach ($requirements['requirements'] as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }

        $total = $requirements['requirements']->count();

        $date = date('d_m_Y_H_i_s');

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_event_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_event_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if(array_key_exists($k, session($userid  . '_event_doc_file_' . $l))) {

                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path =  $userid . '/event/' . $event_id . '/' . $l;

                                $file_count = count(Storage::files('public/' .$check_path));
                                if ($file_count == 0) {
                                    $next_file_no =  1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                $newPathLink = $check_path . '/' . $eventTypeName . '_'  . $next_file_no . '_' . $date . '.' . $ext;

                                if(!Storage::exists('public/'.$newPathLink))
                                {
                                    Storage::move(session($userid  . '_event_doc_file_' . $l)[$k], 'public/'.$newPathLink);
                                }

                                EventRequirement::create([
                                    'issued_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'event_type_id' => $evd['event_type_id'],
                                    'type' => 'event',
                                    'requirement_id' => $l,
                                    'event_id' => $event_id,
                                    'path' =>  $newPathLink,
                                ]);
                            }
                            }
                        }
                        $request->session()->forget([$userid . '_event_doc_file_' . $l, $userid . '_event_ext_' . $l]);
                    }
                }
            }
        }

        if($evd['isLiquor'] == 1)
        {
            EventLiquor::whereNull('event_id')->where('status',0)->where('created_by', Auth::user()->user_id)->update([
                'event_id' => $event_id,
            ]);

            $eventLiquor = EventLiquor::where('event_id', $event_id)->latest()->first();

            if($eventLiquor)
            {
                $requirements =  EventLiquorTruckRequirement::where('liquor_truck_id', $eventLiquor->event_liquor_id)->where('type', 'liquor')->get();

                foreach ($requirements as $req) {
                    $path = $req->path;
                    $newpath = str_replace('temp', $event_id, $path);
                    if(!Storage::exists('public/'.$newpath)){
                        Storage::move('public/'.$path, 'public/'.$newpath);
                    }
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                    ]);
                }
            }
        }

        if($evd['isTruck'] == 1)
        {
            EventTruck::whereNull('event_id')->where('status',0)->update([
                'event_id' => $event_id
            ]);

            $truck_id_query = EventTruck::where('event_id', $event_id)->get();
            $truck_ids = [];
            foreach($truck_id_query as $truck_idd)
            {
                array_push($truck_ids, $truck_idd->event_truck_id);
            }

            for ($a = 0; $a < count($truck_ids); $a++) {
                $requirements =  EventLiquorTruckRequirement::where('liquor_truck_id', $truck_ids[$a])->where('type', 'truck')->get();

                foreach ($requirements as $req) {
                    $path = $req->path;
                    $newpath = str_replace('temp', $event_id, $path);
                    if(!Storage::exists('public/'.$newpath)){
                        Storage::move('public/'.$path, 'public/'.$newpath);
                    }
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                    ]);
                }
            }
        }

        EventLiquor::whereNull('event_id')->where('status',1)->delete();
        EventTruck::whereNull('event_id')->where('status',1)->delete();

        if (session($userid . '_event_pic_file')) {
            $ext = session($userid . '_event_ext');
            $check_path =  $userid . '/event/' .  $event_id . '/photos';
            $file_count = count(Storage::files('public/' . $check_path));
            if ($file_count == 0) {
                $next_file_no = 1;
            } else {
                $next_file_no = $file_count + 1;
            }

            $newPathLink = $check_path .'/logo_' . $next_file_no . '_' . $date . '.' . $ext;
            $newThumbPathLink = $check_path.'/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;

            if(!Storage::exists('public/'.$newPathLink)){
                Storage::move(session($userid . '_event_pic_file'), 'public/'.$newPathLink);
            }
            if(!Storage::exists('public/'.$newThumbPathLink)){
                Storage::move(session($userid . '_event_thumb_file'), 'public/'.$newThumbPathLink);
            }

            session()->forget([$userid . '_event_pic_file', $userid . '_event_ext', $userid . '_event_thumb_file']);
            Event::where('event_id', $event_id)->update(['logo_original' => $newPathLink, 'logo_thumbnail' => $newThumbPathLink]);
        }

        $this->insertEventImages($event_id, $request->description);

        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/event/temp/');

            DB::commit();
            $result = ['success', __('Event Permit Draft Saved successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        $toURL = URL::signedRoute('event.index'). '#draft';

        // if ($event) {
        //     $result = ['success', __('Event Permit Draft Saved Successfully'), 'Success'];
        // } else {
        //     $result = ['error', __('Error, Please Try Again'), 'Error'];
        // }

        return response()->json(['message' => $result , 'toURL' => $toURL]);
    }

    public function view_draft(Request $request, Event $event)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        // $data['event_types'] = EventType::all()->sortBy('name_en');
        $data = $this->eventPreloadData();

        $data['event'] = $event;
        return view('permits.event.draft', $data);
    }

    public function get_event_sub_types($id)
    {
        if($id)
        {
            return EventTypeSub::where('event_type_id', $id)->get();
        }
    }

    public function delete_draft(Request $request)
    {
        try {
            DB::beginTransaction();
            $event_id = $request->del_draft_id;

            Event::where('event_id', $event_id)->delete();
            DB::commit();
            $result = ['success', __('Draft Deleted successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }
        return redirect(URL::signedRoute('event.index').'#draft')->with('message', $result);
    }


    public function update_draft(Request $request)
    {
        try {
            DB::beginTransaction();

        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);
        $dnd = json_decode($request->documentN, true);
        $event_id = $request->evtId;

        // $cid = Auth::user()->EmpClientId ? Auth::user()->EmpClientId : '';
        $userid = Auth::user()->user_id;

        $input_Array = array(
            'name_en' => $evd['name'],
            'name_ar' => $evd['name_ar'],
            'issued_date' =>  Carbon::parse($evd['issued_date'])->toDateTimeString(),
            'expired_date' =>  Carbon::parse($evd['expired_date'])->toDateTimeString(),
            'time_start' => $evd['time_start'],
            'time_end' => $evd['time_end'],
            'address' => $evd['address'],
            'venue_en' => $evd['venue_en'],
            'venue_ar' => $evd['venue_ar'],
            'country_id' => 232,
            'emirate_id' => $evd['emirate_id'],
            'street' => $evd['street'],
            'description_en' => $evd['description_en'],
            'description_ar' => $evd['description_ar'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
            'is_truck' => $evd['isTruck'],
            'is_liquor' => $evd['isLiquor'],
            'firm' => $evd['firm_type'],
            'audience_number' => $evd['no_of_audience'],
            'owner_name' => $evd['owner_name'],
            'owner_name_ar' => $evd['owner_name_ar'],
            'additional_location_info' => trim($evd['addi_loc_info']),     
            'event_type_sub_id' => $evd['event_sub_type_id']
        );

        $event = Event::where('event_id', $event_id)->update($input_Array);

        $firm = $evd['firm_type'];

        $requirements = EventType::with(['requirements' => function ($q) use ($firm) {
            $q->where('type', '=', $firm);
        }])->where('event_type_id', $evd['event_type_id'])->first();

        $requirement_ids = [];

        foreach ($requirements->requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }

        $total = $requirements['requirements']->count();

        if ($dnd) {
            $eventDocs = EventRequirement::where('event_id', $event_id)->where('type', 'event')->get();
            $filenames = [];
            for ($i = 1; $i <= count($dnd); $i++) {
                $reqId = $dnd[$i]['reqId'];
                foreach ($dnd[$i]['fileNames'] as $file) {
                    if ($file) {
                        array_push($filenames, $reqId . '/' . $file);
                    }
                }
            }

            foreach ($eventDocs as $doc) {
                $name = explode('/', $doc->path);
                $namee = $name[3] . '/' . end($name);
                if (!in_array($namee, $filenames)) {
                    EventRequirement::where('event_id', $event_id)->where('path', 'like', '%' . $namee)->delete();
                    Storage::delete('public/' . $doc->path);
                }
            }
        }
        
        if(isset($request->imgPaths))
        {
            $imgPaths = json_decode($request->imgPaths, true);
            $this->checkImagePaths($imgPaths, $event_id, $request->description);
        }

        $date = date('d_m_Y_H_i_s');

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_event_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_event_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if(array_key_exists($k, session($userid  . '_event_doc_file_' . $l))) {

                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path = $userid . '/event/' . $event_id . '/' . $l;

                                $file_count = count(Storage::files('public/' . $check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                $newPathLink = $check_path . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;

                                if(!Storage::exists('public/'.$newPathLink))
                                {
                                    Storage::move(session($userid  . '_event_doc_file_' . $l)[$k], 'public/'.$newPathLink);
                                }

                                EventRequirement::create([
                                    'issued_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'event_type_id' => $evd['event_type_id'],
                                    'requirement_id' => $l,
                                    'type' => 'event',
                                    'event_id' => $event_id,
                                    'path' =>  $newPathLink,
                                ]);

                            }
                            }
                        }
                        $request->session()->forget([$userid . '_event_doc_file_' . $l, $userid . '_event_ext_' . $l]);
                    }
                }
            }
        }

        if (session($userid . '_event_pic_file')) {
            $ext = $userid . '_event_ext';
            $check_path =   $userid . '/event/' .  $event_id . '/photos';
            $file_count = count(Storage::files('public/' .$check_path));
            if ($file_count == 0) {
                $next_file_no = 1;
            } else {
                $next_file_no = $file_count + 1;
            }

            $newPathLink = $check_path.'/logo_' . $next_file_no . '_' . $date . '.' . $ext;
            $newThumbPathLink = $check_path.'/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;

            if(!Storage::exists('public/'.$newPathLink))
            {
                Storage::move(session($userid . '_event_pic_file'), 'public/'.$newPathLink);
            }
            
            if(!Storage::exists('public/'.$newThumbPathLink))
            {
                Storage::move(session($userid . '_event_thumb_file'), 'public/'.$newThumbPathLink);
            }

            session()->forget([$userid . '_event_pic_file', $userid . '_event_ext', $userid . '_event_thumb_file']);
            Event::where('event_id', $event_id)->update(['logo_original' => $newPathLink, 'logo_thumbnail' => $newThumbPathLink]);
        }

        $this->insertEventImages($event_id, $request->description);

        Storage::deleteDirectory('public/' . $userid . '/event/temp/');

        DB::commit();
            $result = ['success', __('Draft Updated Successfully'), 'Success'];
        } catch (Exception $e) {
            DB::rollBack();
            $result = ['error', __($e->getMessage()), 'Error'];
        }

        // if ($event) {
        //     $result = ['success', __('Draft Updated Successfully'), 'Success'];
        // } else {
        //     $result = ['error', __('Error, Please Try Again'), 'Error'];
        // }

        return response()->json(['message' => $result , 'toURL' => URL::signedRoute('event.index').'#draft']);
    }

    function checkImagePaths($imgPaths, $event_id, $desc)
    {
        if ($imgPaths) {
            $otherDocs = \App\EventOtherUpload::where('event_id', $event_id)->get();
            $filenames = [];
            for ($i = 0; $i < count($imgPaths); $i++) {
                array_push($filenames, $imgPaths[$i]);
                \App\EventOtherUpload::where('event_id', $event_id)->update(['description' => $desc]);
            }

            foreach ($otherDocs as $doc) {
                $name =  $doc->path ;
                if (!in_array($name, $filenames)) {
                    \App\EventOtherUpload::where('event_id', $event_id)->where('path', 'like', '%' . $name)->delete();
                    Storage::delete('public/' . $doc->path);
                }
            }
        }
    }

    public function payment(Request $request, Event $event)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }

        // $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['event_types'] = EventType::with('event_type_requirements', 'event_type_requirements.requirement')->orderBy('name_en', 'asc')->get();
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['truck_docs'] = EventRequirement::with('requirement')->where('event_id', $event->event_id)->where('type', 'truck')->get();

        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();

        $data['event'] = $event;

        $permit_status = [];
        $is_paid = [];

        $data['containsApproved'] = 0;
        $data['isPaid'] = 1;

        if($event->permit)
        {
            foreach($event->permit->artistPermit as $ap){
                array_push($permit_status,strtolower($ap->artist_permit_status));
                array_push($is_paid,strtolower($ap->is_paid));
            }
    
            if(in_array('approved', $permit_status)){
                $data['containsApproved'] = 1;
            }
    
            if(in_array(0, $is_paid)){
                $data['isPaid'] = 0;
            }
        }
        

        return view('permits.event.payment', $data);
    }

    

    public function make_payment(Request $request)
    {

        $event_id = $request->event_id;
        $amount = $request->amount;
        $vat = $request->vat;
        $total = $request->total;
        $paidArtistFee = $request->paidArtistFee;
        $truck_fee = $request->truck_fee;
        $liquor_fee = $request->liquor_fee;
        $transactionId = $request->transactionId;
        $receipt = $request->receipt;
        $orderId = $request->orderId;
        $noofdays = $request->noofdays;
        $toURL = '';

        try {

            DB::beginTransaction();

        $trnx_id = Transaction::create([
            'reference_number' => getTransactionReferNumber(),
            'transaction_type' => 'event',
            'created_by' => Auth::user()->user_id,
            'company_id' => Auth::user()->EmpClientId,
            'transaction_date' => Carbon::now(),
            'payment_transaction_id' => $transactionId,
            'payment_receipt_no' => $receipt,
            'payment_order_id' => $orderId
        ]);
        
        if ($trnx_id)
        {
            $event_amount = (int)$amount - ((int)$truck_fee + (int)$liquor_fee);
            EventTransaction::create([
                'event_id' => $event_id,
                'transaction_id' => $trnx_id->transaction_id,
                'amount' => $event_amount,
                'type' => 'event',
                'vat' => $vat,
                'user_id' => Auth::user()->user_id
            ]);

            if($truck_fee > 0)
            {
                $totaltrucks = count(EventTruck::where('event_id', $event_id)->where('paid', 0)->get());
                EventTransaction::create([
                    'event_id' => $event_id,
                    'transaction_id' => $trnx_id->transaction_id,
                    'type' => 'truck',
                    'amount' => $truck_fee,
                    'total_trucks' => $totaltrucks,
                    'vat' => 0,
                    'user_id' => Auth::user()->user_id,
                ]);

                EventTruck::where('event_id', $event_id)->update(['paid' => 1]);
            }

            if($liquor_fee > 0)
            {
                EventTransaction::create([
                    'event_id' => $event_id,
                    'transaction_id' => $trnx_id->transaction_id,
                    'type' => 'liquor',
                    'amount' => $liquor_fee,
                    'vat' => 0,
                    'user_id' => Auth::user()->user_id
                ]);

                EventLiquor::where('event_id', $event_id)->update(['paid' => 1]);
            }

            Event::where('event_id', $event_id)->update([
                'status' => 'active',
                'permit_number' => generateEventPermitNumber(),
                'paid' => 1,
                'paid_artist_fee' => $paidArtistFee
            ]);
        

            if($paidArtistFee)
            {
                $permit_id = \App\Permit::where('event_id', $event_id)->first()->permit_id;
                
                $artistPermits = ArtistPermit::where('permit_id', $permit_id)->where('artist_permit_status', 'approved')->get();

                foreach ($artistPermits as $artistPermit) {
                    $per_day_fee = $artistPermit->profession->amount;
                    $noofmonths = ceil($noofdays ? $noofdays/30 : 1 ) ;
                    $total_fee = $per_day_fee * $noofmonths;
                    $vat_fee = $total_fee * 0.05 ; 
                    $trnx_id->artistPermitTransaction()->create([
                        'vat' => $vat_fee ,
                        'amount' => $total_fee,
                        'permit_id' => $permit_id,
                        'artist_permit_id' => $artistPermit->artist_permit_id,
                        'transaction_id' => $trnx_id->transaction_id,
                    ]);
                }

                Permit::where('permit_id', $permit_id)->update([
                    'paid' => 1,
                    'permit_number' => generateArtistPermitNumber(),
                    'permit_status' => 'active'
                ]);

                ArtistPermit::where('permit_id', $permit_id)->update(['is_paid' => 1]);
            }
        }

        DB::commit();

        $result = ['success', __('Payment Done Successfully'), 'Success'];

        $toURL = URL::signedRoute('event.happiness', [ 'id' => $event_id]);

    } catch (Exception $e) {
		DB::rollBack();
		
        $toURL = '';
		$result = ['error', __($e->getMessage()), 'Error'];
    }
    


        return response()->json(['message' => $result, 'toURL' => $toURL]);
    }

    public function happiness(Request $request, Event $event)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        // $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['event_types'] = EventType::with('event_type_requirements', 'event_type_requirements.requirement')->orderBy('name_en', 'asc')->get();
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['truck_docs'] = EventRequirement::with('requirement')->where('event_id', $event->event_id)->where('type', 'truck')->get();

        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();

        $data['event'] = $event;
        return view('permits.event.happiness', $data);
    }

    public function submit_happiness(Request $request)
    {
        try {

            DB::beginTransaction();
            $event_id = $request->event_id;
            $updateArray = array(
                'type' => 'event',
                'application_id' =>  $event_id,
                'rating' => $request->happiness,
                'remarks' => $request->remarks,
                'created_by' => Auth::user()->user_id
            );
            Happiness::create($updateArray);

            $event = Event::where('event_id', $event_id)->latest()->first();

            if($event->firm == 'government') 
            {
                Event::where('event_id', $event_id)->update([
                    'status' => 'active',
                    'permit_number' => generateEventPermitNumber()
                ]);
            }

            if($event->firm == 'corporate' && $event->status == 'approved-unpaid') {
                if($event->permit_number == null)
                {
                    Event::where('event_id', $event_id)->update([
                        'status' => 'active',
                        'permit_number' => generateEventPermitNumber()
                    ]);
                }else {
                    Event::where('event_id', $event_id)->update([
                        'status' => 'active'
                    ]);
                }
               
            }

            $result = ['success', __('Thank you For your Feedback'), 'Success'];

            DB::commit();
            
        
        } catch (Exception $e) {
            DB::rollBack();
            

            $result = ['error', __($e->getMessage()), 'Error'];
        }

        return response()->json(['message' => $result, 'toURL' => URL::signedRoute('event.index').'#valid']);
    }

    public function uploadDocument(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $date = date('d_m_Y_H_i_s');
        $reqId = $request->reqId;
        $ext = $request->files->get('doc_file_' . $request->id)->getClientOriginalExtension();
        $path  = Storage::putFileAs('public/' . $user_id . '/event/temp/' . $reqId, $request->files->get('doc_file_' . $request->id), 'document_' . $request->id . '_' . $date . '.' . $ext);
        if (!Session::exists($user_id . '_event_doc_file_' . $reqId)) {
            session()->put($user_id . '_event_doc_file_' . $reqId, []);
            session()->put($user_id . '_event_ext_' . $reqId, []);
        }
        session()->push($user_id . '_event_doc_file_' . $reqId, $path);
        session()->push($user_id . '_event_ext_' . $reqId, $ext);

        return response()->json(['filepath' => $path, 'ext' => $ext, 'id' => $reqId]);
    }

    public function removeUploadedDocumentInSession(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $reqId = $request->reqId;
        if(session()->has($user_id . '_event_doc_file_' . $reqId))
        {
            for($i = 0 ; $i < count(session($user_id . '_event_doc_file_' . $reqId)); $i++)
            {
                if(array_key_exists($i, session($user_id  . '_event_doc_file_' . $reqId)))
                {
                    $filepath = session($user_id . '_event_doc_file_' . $reqId)[$i];
                    Storage::delete($filepath);
                }
            }   
            session()->forget($user_id . '_event_doc_file_' . $reqId);
            session()->forget($user_id . '_event_ext_' . $reqId);
        }
        return;
    }

    public function uploadTruck(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $id = $request->id;
        $date = date('d_m_Y_H_i_s');
        $req_id = $request->reqId;
        $ext = $request->files->get('truck_file_' . $id)->getClientOriginalExtension();
        $path  = Storage::putFileAs('public/' . $user_id . '/event/temp/truck/' . $req_id, $request->files->get('truck_file_' . $id), 'truck_document_' . $request->id . '_' . $date . '.' . $ext);
        if (!Session::exists($user_id . '_truck_file_' . $req_id)) {
            session()->put($user_id . '_truck_file_'  . $req_id, []);
            session()->put($user_id . '_truck_ext_'  . $req_id, []);
        }
        session()->push($user_id . '_truck_file_'  . $req_id, $path);
        session()->push($user_id . '_truck_ext_'  . $req_id, $ext);
        return response()->json(['filepath' => $path, 'ext' => $ext]);
        // return json_encode($file);
    }

    public function eventpics($id)
    {
        $event = Event::where('event_id', $id)->first();
        return view('permits.event.eventpics', ['event' => $event]);
    }

    public function uploadEventPics(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $date = date('d_m_Y_H_i_s');
        $ext = $request->file('image_file')->getClientOriginalExtension();
        $fileName = $request->file('image_file')->getClientOriginalName();
        $size = $request->file('image_file')->getSize();
        $toUrl = 'public/' . $user_id . '/event/temp/pictures';
        $path  = Storage::putFileAs($toUrl, $request->file('image_file'), $fileName );
        $thumbImg = Image::make($request->file('image_file')->getRealPath());
        $thumbImg->resize(300, 200,  function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::makeDirectory($toUrl.'/thumb');
        $thumbPath = storage_path() . '/app/'.$toUrl.'/thumb/'. $fileName ;
        $thumbImg->save($thumbPath);
        $thumbSavedPath = $toUrl . '/thumb/' . $fileName;

        $savePath = $user_id . '/event/temp/pictures/'.$fileName;
        $saveThumbPath = $user_id . '/event/temp/pictures/thumb/'.$fileName;

        if (!Session::exists($user_id . '_image_file')) {
            session()->put($user_id . '_image_size', []);
            session()->put($user_id . '_image_file', []);
            session()->put($user_id . '_image_ext', []);
            session()->put($user_id . '_image_thumb', []);
        }
        session()->push($user_id . '_image_file' , 'public/'.$savePath);
        session()->push($user_id . '_image_size' , $size);
        session()->push($user_id . '_image_ext' , $ext);
        session()->push($user_id . '_image_thumb' , 'public/'.$saveThumbPath);

        // return json_encode($file);
        return response()->json(['filepath' => $path, 'ext' => $ext]);
    }

    function clearImageEventImageSession()
    {
        $user_id = Auth::user()->user_id;
        session()->forget($user_id . '_image_size');
        session()->forget($user_id . '_image_file');
        session()->forget($user_id . '_image_ext');
        session()->forget($user_id . '_image_thumb');
        Storage::delete([$user_id . '_image_file', $user_id . '_image_thumb' ]);
    }

    public function forgotEventPicsSession(Request $request){
        $this->clearImageEventImageSession();
    }

    public function deleteUploadedEventPic(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $filename = $request->path;
        $pic_size = session()->pull($user_id . '_image_size', []); 
        $pic_file = session()->pull($user_id . '_image_file', []); 
        $pic_ext = session()->pull($user_id . '_image_ext', []); 
        $pic_thumb = session()->pull($user_id . '_image_thumb', []); 
        if(($key = array_search($filename, $pic_file)) !== false) {
            unset($pic_size[$key]);
            unset($pic_file[$key]);
            unset($pic_ext[$key]);
            unset($pic_thumb[$key]);
            Storage::delete([ $pic_file[$key], $pic_thumb[$key]]);
        }
        session()->put($user_id . '_image_size', $pic_size);
        session()->put($user_id . '_image_file', $pic_file);
        session()->put($user_id . '_image_ext', $pic_ext);
        session()->put($user_id . '_image_thumb', $pic_thumb);
        return;
    }

    public function uploadLiquor(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $id = $request->id;
        $date = date('d_m_Y_H_i_s');
        $reqId = $request->reqId;
        $ext = $request->files->get('liquor_file_' . $id)->getClientOriginalExtension();
        $fileName = $request->files->get('liquor_file_'. $id)->getClientOriginalName();
        $path  = Storage::putFileAs('public/' . $user_id . '/event/temp/liquor/' . $id, $request->files->get('liquor_file_' . $id), $fileName.'_' . $request->id . '_' . $date . '.' . $ext);
        // if ($isAdd == 'yes') {

        //     if (!Session::exists($user_id . '_liquor_file_addi_' . $id)) {
        //         session()->put($user_id . '_liquor_file_addi_' . $id, []);
        //         session()->put($user_id . '_liquor_ext_addi_' . $id, []);
        //     }
        //     session()->push($user_id . '_liquor_file_addi_' . $id, $path);
        //     session()->push($user_id . '_liquor_ext_addi_' . $id, $ext);
        // } else {

        if (!Session::exists($user_id . '_liquor_file_' . $reqId)) {
            session()->put($user_id . '_liquor_file_' . $reqId, []);
            session()->put($user_id . '_liquor_ext_' . $reqId, []);
        }
        session()->push($user_id . '_liquor_file_' . $reqId, $path);
        session()->push($user_id . '_liquor_ext_' . $reqId, $ext);
        // }
        return response()->json(['filepath' => $path, 'ext' => $ext]);
    }

    public function fetch_liquor_details_by_event_id($id)
    {
        return EventLiquor::where('event_id', $id)->where('created_by', Auth::user()->user_id)->first();
    }

    public function fetch_liquor_details(Request $request)
    {
        return EventLiquor::whereNull('event_id')->where('created_by', Auth::user()->user_id)->latest()->first();
    }

    public function fetch_this_liquor_docs(Request $request)
    {
        $liquor_id = $request->liquor_id;
        $reqId = $request->reqId;

        return EventLiquorTruckRequirement::where([
            ['liquor_truck_id', $liquor_id],
            ['type', 'liquor'],
            ['requirement_id', $reqId]
        ])->get();
      
    }

    public function fetch_truck_details(Request $request)
    {
        return EventTruck::whereNull('event_id')->where('status', 0)->where('created_by',Auth::user()->user_id)->get();
    }

    public function uploadLogo(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $file = $request->file('pic_file');
        $ext = $file->getClientOriginalExtension();
        $fileName = $request->file('pic_file')->getClientOriginalName();
        $original =  $user_id . '/event/temp';
        $path  = Storage::putFileAs('public/' . $original, $request->files->get('pic_file'), $fileName);
        $thumbImg = Image::make($request->file('pic_file')->getRealPath());
        $thumbImg->resize(300, 200,  function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::makeDirectory('public/' . $user_id . '/event/temp/thumb');
        $thumbPath = storage_path() . '/app/public/' . $user_id . '/event/temp/thumb/' . $fileName;
        $thumbImg->save($thumbPath);
        $thumbSavedPath = 'public/' . $user_id . '/event/temp/thumb/' . $fileName;
        session([$user_id . '_event_pic_file' => $path, $user_id . '_event_ext' => $ext, $user_id . '_event_thumb_file' => $thumbSavedPath]);

        // return json_encode($file);
        return response()->json(['filepath' => $path]);
    }

    public function delete_logo_in_session(Request $request)
    {
        $user_id = Auth::user()->user_id;
        Storage::delete([ $user_id . '_event_pic_file' ,$user_id . '_event_thumb_file' ]);
        session()->forget([$user_id . '_event_pic_file', $user_id . '_event_ext', $user_id . '_event_thumb_file']);
        return ;
    }

    public function get_uploaded_logo($id)
    {
        return Event::where('event_id', $id)->value('logo_thumbnail');
    }

    public function deleteUploadFile(Request $request)
    {
        $filepath = $request->path;
        $ext = $request->ext;
        $reqId = $request->id;

        $files = session()->pull(Auth::user()->user_id . '_event_doc_file_' . $reqId, []);
        $exts = session()->pull(Auth::user()->user_id . '_event_ext_' . $reqId, []);
        if (($key = array_search($filepath, $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search($ext, $exts)) !== false) {
            unset($exts[$key]);
        }
        $path  = Storage::delete($filepath);
        session()->put(Auth::user()->user_id . '_event_doc_file_' . $reqId, $files);
        session()->put(Auth::user()->user_id . '_event_ext_' . $reqId, $exts);
        return $filepath;
    }


    public function deleteLiquorFile(Request $request)
    {
        $filepath = $request->path;
        $ext = $request->ext;
        $reqId = $request->id;
        $user_id = Auth::user()->user_id;
        $files = session()->pull($user_id . '_event_doc_file_' . $reqId, []);
        $exts = session()->pull($user_id . '_event_ext_' . $reqId, []);
        if (($key = array_search($filepath, $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search($ext, $exts)) !== false) {
            unset($exts[$key]);
        }
        $path  = Storage::delete($filepath);
        session()->put($user_id . '_liquor_file_' . $reqId, $files);
        session()->put($user_id . '_liquor_ext_' . $reqId, $exts);
        return $filepath;
    }

    public function deleteTruckUploadedfile(Request $request)
    {
        $filepath = $request->path;
        $ext = $request->ext;
        $id = $request->id;
        $user_id = Auth::user()->user_id;
        $files = session()->pull( $user_id. '_truck_file_' . $id, []);
        $exts = session()->pull($user_id. '_truck_ext_' . $id, []);
        if (($key = array_search($filepath, $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search($ext, $exts)) !== false) {
            unset($exts[$key]);
        }
        $path  = Storage::delete($filepath);
        session()->put($user_id. '_truck_file_' .  $id, $files);
        session()->put($user_id. '_truck_ext_' . $id, $exts);
        return $filepath;
    }

    public function add_artist(Request $request, $id = null)
    {
        if(!$request->hasValidSignature()){
            return abort(401);
        }
        $data['event'] = Event::latest()->first();
        $artistTemp = \App\ArtistTempData::where('created_by', Auth::user()->user_id);
        if ($id) {
            $permit_id = $id;
        } else if ($artistTemp->exists()) {
            $permit_id = $artistTemp->latest()->first()->permit_id + 1;
        } else {
            $permit_id = 1;
        }
        $data['permit_id'] =  $permit_id;
        if ($id > 0) {
            $data['artist_details'] = $artistTemp->where('permit_id', $id)->get();
        } else {
            $data['artist_details'] = [];
        }
        return view('permits.event.artist', $data);
    }

    public function get_payment_details($orderid)
    {
        $url = 'https://test-rakbankpay.mtf.gateway.mastercard.com/api/rest/version/54/merchant/NRSINFOWAYSL/order/'.$orderid;
        $username = "merchant.NRSINFOWAYSL";
        $password = "aabf38b7ab511335ba2fb786206b1dc0";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
        ));
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $output = curl_exec($curl);
        curl_close($curl);
        // $output = json_decode($output);
        return $output;
    }

    public function sendNotification($event, $from){

        $reason = $contenttext =  '';
        switch($from){
            case('new'):
                $reason = 'Applied'; $contenttext = 'applied';
                break;
            case('edit'):
                $reason = 'Edited';$contenttext = 'submitted after modification';
                break;
            case('amend'):
                $reason = 'Amended';$contenttext = 'submitted for amendment';
                break;
            case('cancel'):
                $reason = 'cancelled';$contenttext = 'cancelled';
                break;
            default: 
                $reason = '';
                break;
        }
        $subject = 'Event Permit #' . $event->reference_number . ' '. $reason;
        $title = 'Event Permit <b>#' . $event->reference_number . '</b> '.$reason;
        $buttonText = "View Application";
        $content = 'The event permit with reference number <b>' . $event->reference_number . '</b> is '.$contenttext.'.  Please click the link below.';
        $url = URL::signedRoute('admin.event.application', ['event' => $event->event_id]); 
        $users = User::whereHas('roles', function($q){
        $q->where('roles.role_id', 1);
        })->get();

        foreach ($users as $user) {
            $user->notify(new AllNotification([
                'subject' => $subject,
                'title' => $title,
                'content' => $content,
                'button' => $buttonText,
                'url' => $url
            ]));
        }
    }

}



































































































































