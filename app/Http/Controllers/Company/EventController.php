<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\EventType;
use App\Country;
use App\Emirates;
use App\Areas;
use App\Event;
use App\Requirement;
use App\EventRequirement;
use App\EventTypeRequirement;
use Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use PDF;
use App\Company;
use App\EventLiquorTruckRequirement;
use App\EventTruck;
use App\EventLiquor;
use App\EventTransaction;
use App\Transaction;
use App\EventComment;
use Session;
use App\Happiness;
use Storage;
use NumberToWords\NumberToWords;
use Intervention\Image\ImageManagerStatic as Image;

class EventController extends Controller
{

    public function index()
    {
        Event::whereDate('expired_date', '<', Carbon::now())->update(['status' => 'expired']);
        \App\Permit::where('created_by', Auth::user()->user_id)->update(['is_edit' => 0]);
        $eventtypes = EventType::orderBy('name_en', 'asc')->get();
        return view('permits.event.index', ['types' => $eventtypes]);
    }

    public function create()
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        return view('permits.event.create', $data);
    }

    public function add_update_truck(Request $request)
    {
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

        if ($truck_doc_details) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_truck_file_'  . $l)) {

                    $total_docs = count(session($userid . '_truck_file_'  . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_truck_file_'  . $l)[$k])) {

                                $ext = session($userid . '_truck_ext_'  . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/temp/truck/' . $truck_id . '/' . $l;

                                $file_count = count(Storage::files($check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $newPath = 'public/' . $userid . '/event/temp/truck/' . $truck_id . '/' . $l . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                $newPathLink = $userid . '/event/temp/truck/' . $truck_id . '/'  . $l . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_truck_file_'  . $l)[$k], $newPath);

                                EventLiquorTruckRequirement::create([
                                    'issued_date' => !empty((array) $truck_doc_details[$m]) ? Carbon::parse($truck_doc_details[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => !empty((array) $truck_doc_details[$m]) ? Carbon::parse($truck_doc_details[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'requirement_id' => $l,
                                    'event_id' => $event_id,
                                    'path' =>  $newPathLink,
                                    'type' => 'truck',
                                    'liquor_truck_id' => $truck_id
                                ]);
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

       return;
    }

    public function add_liquor(Request $request)
    {
        $liquor_details = $request->liquorDetails;
        $liquorDocDetails = json_decode($request->liquorDocDetails,  true);
        $event_liquor_id = '';

        $old_event_liquor_id = $request->event_liquor_id;

        if ($liquor_details) {
            $lq = $liquor_details;
            // dd($lq);
            $update_array = array(
                'company_name_en' => $lq['company_name_en'],
                'company_name_ar' => $lq['company_name_ar'],
                'emirate_id'      => json_encode($lq['l_emirates']),
                'license_number'  => $lq['license_no'],
                'trade_license'   => $lq['trade_license_no'],
                'trade_license_issued_date' => $lq['tl_issue_date'] ? Carbon::parse($lq['tl_issue_date'])->toDateString() : '',
                'trade_license_expired_date' => $lq['tl_expiry_date'] ? Carbon::parse($lq['tl_expiry_date'])->toDateString() : '',
                'license_issued_date' => $lq['l_issue_date'] ? Carbon::parse($lq['l_issue_date'])->toDateString() : '',
                'license_expired_date' => $lq['l_expiry_date'] ? Carbon::parse($lq['l_expiry_date'])->toDateString() : '',
                'status' => 0,
                'created_by' => Auth::user()->user_id,
            );

            if ($old_event_liquor_id) {
                $event_liquor = EventLiquor::where('event_liquor_id', $old_event_liquor_id)->update($update_array);
                $event_liquor_id = $old_event_liquor_id;
            } else {
                $event_liquor = EventLiquor::create($update_array);
                $event_liquor_id = $event_liquor->event_liquor_id;
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

                                $check_path = 'public/' . $userid . '/event/temp/liquor/' . $event_liquor_id . '/' . $l;

                                $file_count = count(Storage::files($check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $newPath = 'public/' . $userid . '/event/temp/liquor/' . $event_liquor_id . '/' . $l . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                $newPathLink = $userid . '/event/temp/liquor/' . $event_liquor_id . '/'  . $l . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                EventLiquorTruckRequirement::create([
                                    'issued_date' => !empty((array) $liquorDocDetails[$m]) ? Carbon::parse($liquorDocDetails[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => !empty((array) $liquorDocDetails[$m]) ? Carbon::parse($liquorDocDetails[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'requirement_id' => $l,
                                    'path' =>  $newPathLink,
                                    'type' => 'liquor',
                                    'liquor_truck_id' => $event_liquor_id
                                ]);

                                Storage::move(session($userid  . '_liquor_file_' . $l)[$k], $newPath);
                            }
                        }
                        $request->session()->forget([$userid . '_liquor_file_' . $l, $userid . '_liquor_ext_' . $l]);
                    }
                }

                /*else if (session($userid . '_liquor_file_addi_' . $j)) {

                    $total_docs = count(session($userid . '_liquor_file_addi_' . $j));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_liquor_file_addi_' . $j)[$k])) {

                                $ext = session($userid . '_liquor_ext_addi_' . $j)[$k];

                                $check_path = 'public/' . $userid . '/event/temp/liquor/' . $event_liquor_id . 'additional/' . $j;

                                $file_count = count(Storage::files($check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $newPath = 'public/' . $userid . '/event/temp/liquor/' . $event_liquor_id . 'additional/'  . $j . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                $newPathLink = $userid . '/event/temp/liquor/' . $event_liquor_id . 'additional/'  . $j . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_liquor_file_addi_' . $j)[$k], $newPath);

                                EventOtherUpload::create([
                                    'issued_date' => !empty((array) $liquorDocDetails[$m]) ? Carbon::parse($liquorDocDetails[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => !empty((array) $liquorDocDetails[$m]) ? Carbon::parse($liquorDocDetails[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'path' =>  $newPathLink,
                                    'liquor_truck_id' => $event_liquor->event_liquor_id
                                ]);
                            }
                        }
                        $request->session()->forget([$userid . '_liquor_file_addi_' . $l, $userid . '_liquor_ext_addi_' . $l]);
                    }
                }*/
            }
        }

        if ($event_liquor) {
            $result = ['success', 'Liquor Details Added Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result, 'event_liquor_id' => $event_liquor_id]);
    }

    public function deleteTruckLiquor(Request $request)
    {
        $event_id = $request->eventId;
        $from = $request->from;

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

       return;

    }

    public function store(Request $request)
    {

        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);
        $lq = json_decode($request->lq, true);
        $from = $request->from;
        $cid = Auth::user()->type == 1 ? Auth::user()->EmpClientId : '';
        $userid = Auth::user()->user_id;

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
            'audience_number' => $evd['no_of_audience']
        );

        if ($from == 'new') {
            $input_Array['issued_date'] = $evd['issued_date'];
            $input_Array['expired_date'] = $evd['expired_date'];
            $input_Array['time_start'] = $evd['time_start'];
            $input_Array['time_end'] = $evd['time_end'];
            $input_Array['reference_number'] = $this->generateReferenceNumber();
            $input_Array['created_by'] = $userid;
            $input_Array['created_at'] = Carbon::now();
            $event = Event::create($input_Array);
            $event_id = $event->event_id;
        } else if ($from == 'draft') {
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
     
        if($evd['isLiquor'] == 1)
        {
            $ss = EventLiquor::whereNull('event_id')->where('status',0)->where('created_by', Auth::user()->user_id)->update([
                'event_id' => $event_id,
            ]);

            $eventLiquor = EventLiquor::where('event_id', $event_id)->latest()->first();

            if($eventLiquor)
            {
                $requirements =  EventLiquorTruckRequirement::where('liquor_truck_id', $eventLiquor->event_liquor_id)->where('type', 'liquor')->get();

                foreach ($requirements as $req) {
                    $path = $req->path;
                    $newpath = str_replace('temp', $event_id, $path);
                    Storage::move('public/'.$path, 'public/'.$newpath);
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                        'event_id' => $event_id
                    ]);
                }
            }
        }


        if($evd['isTruck'] == 1)
        {
            EventTruck::whereNull('event_id')->where('status',0)->where('created_by', Auth::user()->user_id)->update([
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
                    Storage::move('public/'.$path, 'public/'.$newpath);
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                        'event_id' => $event_id
                    ]);
                }
            }
        }

        EventLiquor::whereNull('event_id')->where('status',1)->delete();
        EventTruck::whereNull('event_id')->where('status',1)->delete();

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
                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {

                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;

                                $file_count = count(Storage::files($check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;

                                $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_event_doc_file_' . $l)[$k], $newPath);

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
                        $request->session()->forget([$userid . '_event_doc_file_' . $l, $userid . '_event_ext_' . $l]);
                    }
                }
            }
        }

        if (session($userid . '_event_pic_file')) {
            $ext = session($userid . '_event_ext');
            $check_path = 'public/' .  $userid . '/event/' .  $event_id . '/photos';
            $file_count = count(Storage::files($check_path));
            if ($file_count == 0) {
                $next_file_no = 1;
            } else {
                $next_file_no = $file_count + 1;
            }
            $newPath = 'public/' . $userid . '/event/' . $event_id . '/photos/logo_' . $next_file_no . '_' . $date . '.' . $ext;
            $newPathLink = $userid . '/event/' . $event_id . '/photos/logo_' . $next_file_no . '_' . $date . '.' . $ext;

            $newThumbPath = 'public/' . $userid . '/event/' . $event_id . '/photos/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;
            $newThumbPathLink = $userid . '/event/' . $event_id . '/photos/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;

            Storage::move(session($userid . '_event_pic_file'), $newPath);
            Storage::move(session($userid . '_event_thumb_file'), $newThumbPath);

            session()->forget([$userid . '_event_pic_file', $userid . '_event_ext', $userid . '_event_thumb_file']);
            Event::where('event_id', $event_id)->update(['logo_original' => $newPathLink, 'logo_thumbnail' => $newThumbPathLink]);
        }


        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/event/temp/');

        if ($event) {
            $result = ['success', 'Event Permit Applied Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result, 'event_id' => $event_id]);
    }

    public function delete_truck_details($id)
    {
        EventTruck::where('event_truck_id', $id)->update([
            'status' => 1
        ]);

        return;
    }

    public function fetch_this_truck_details($id)
    {
        return EventTruck::where('event_truck_id', $id)->first();
    }

    public function show(Request $request, Event $event)
    {
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
        return view('permits.event.show', $data);
    }

    public function edit(Event $event)
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['staff_comments'] = $event->comment()->where('type', 1)->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();
        $data['event'] = $event;

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

    public function calendarFn()
    {
        $user = Auth::user();
        $events = Event::whereIn('status', ['active', 'expired'])->where('created_by', Auth::user()->user_id)->orWhere('is_display_all', 1)->get();
        $events = $events->map(function ($event) use ($user) {
            return [
                'title' => $user->LanguageId == 1 ? $event->name_en : $event->name_ar,
                'start' => date('Y-m-d', strtotime($event->issued_date)) . 'T' . date('H:i:s', strtotime($event->time_start)),
                'end' => date('Y-m-d', strtotime($event->expired_date)) . 'T' . date('H:i:s', strtotime($event->time_end)),
                'id' => $event->event_id,
                'url' => route('event.show', $event->event_id) . '?tab=calendar',
                'description' => 'Venue : ' . $user->LanguageId == 1 ? $event->venue_en : $event->venue_ar,
                'backgroundColor' => $event->type->color,
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
            'audience_number' => $evd['no_of_audience']
        );

        $old_status = Event::where('event_id', $event_id)->first()->status;

        if ($old_status == 'new') {
            $input_Array['status'] = 'new';
        } else {
            $input_Array['status'] = 'amended';
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

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_event_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_event_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;

                                if (Storage::exists($check_path)) {
                                    $file_count = count(Storage::files($check_path));
                                    $next_file_no = $file_count + 1;
                                } else {
                                    $next_file_no = 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                //$eventTypeName = str_replace(' ', '_', EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $date = date('d_m_Y_H_i_s');
                                $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;
                                $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_event_doc_file_' . $l)[$k], $newPath);
                            } else {
                                $newPathLink = '';
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
                        $request->session()->forget([$userid . '_event_doc_file_' . $l, $userid . '_event_ext_' . $l]);

                        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/event/temp/' . $l);
                    }
                }
            }
        }


        if ($event) {
            $result = ['success', 'Event Permit Updated Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function cancel(Request $request)
    {
        $event_id = $request->permit_id;
        $reason = $request->cancel_reason;

        Event::where('event_id', $event_id)->update([
            'status' => 'cancelled',
            'cancelled_by' => Auth::user()->user_id,
            'cancel_reason' => $reason
        ]);

        return redirect()->route('event.index');
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

    public function download($id)
    {
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
        $pdf = PDF::loadView('permits.event.print', $data, [], [
            'title' => 'Event Permit',
            'default_font_size' => 10
        ]);
        // $pdf->getMpdf()->useDefaultCSS2();
        return $pdf->stream('Event Permit-' . $event_permit_no . '.pdf');
    }

    public function fetch_applied()
    {
        return $this->datatable_function('applied');
    }

    public function fetch_valid()
    {
        return $this->datatable_function('valid');
    }

    public function fetch_draft()
    {
        return $this->datatable_function('draft');
    }


    function datatable_function($status)
    {
        $permits = Event::with('type')->orderBy('created_at', 'desc')->where('created_by', Auth::user()->user_id);

        if ($status == 'applied') {
            $permits->whereNotIn('status', ['active', 'draft', 'expired']);
        } else if ($status == 'valid') {
            $permits->whereIn('status', ['active', 'expired'])->OrderBy('updated_at', 'desc');
        } else if ($status == 'draft') {
            $permits->where('status', 'draft');
        }

        $permits->get();

        $amend_grace = \App\GeneralSetting::first()->event_grace_period_amendment;

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
        })->addColumn('action', function ($permit) use ($status, $amend_grace) {
            switch ($status) {
                case 'applied':
                    if ($permit->status == 'approved-unpaid') {
                        return '<a href="' . route('company.event.payment', $permit->event_id) . '"  title="Payments"><span class="kt-badge kt-badge--success kt-badge--inline">Payment</span></a>';
                    } else if ($permit->status == 'rejected') {
                        return '<span onClick="rejected_permit(' . $permit->event_id . ')" data-toggle="modal" data-target="#rejected_permit" class="kt-badge kt-badge--info kt-badge--inline">Rejected</span>';
                    } else if ($permit->status == 'cancelled') {
                        return '<span onClick="show_cancelled(' . $permit->event_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="kt-badge kt-badge--info kt-badge--inline">Cancelled</span>';
                    } else if ($permit->status == 'need modification') {
                        return '<a href="' . route('event.edit', $permit->event_id) . '" title="edit" ><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a>';
                    } else if ($permit->status == 'new') {
                        return '<a href="' . route('event.edit', $permit->event_id) . '" title="edit"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a><span onClick="cancel_permit(' . $permit->event_id . ',\'' . $permit->reference_number . '\')" data-toggle="modal" class="kt-badge kt-badge--danger kt-badge--inline">Cancel</span>';
                    }
                    break;
                case 'valid':
                    if ($permit->status == 'active') {
                        $issued_date = strtotime($permit->issued_date);
                        $today = strtotime(date('Y-m-d 00:00:00'));
                        $diff = abs($today - $issued_date) / 60 / 60 / 24;
                        $amend_btn = ($diff <= $amend_grace) ? '<a href="' . route('event.amend', $permit->event_id) . '" title="amend" ><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Amend </span></a>' : '';
                        return $amend_btn . '<span onClick="cancel_permit(' . $permit->event_id . ',\'' . $permit->reference_number . '\')" data-toggle="modal" class="kt-badge kt-badge--danger kt-badge--inline">Cancel</span>';
                    } else if ($permit->status == 'expired') {
                        return '<span style="pointer-events:none">Expired</span>';
                    }
                    break;
                case 'draft':
                    if ($permit->status == 'draft') {
                        return '<a href="' . route('company.event.draft', $permit->event_id) . '"  title="View"><span class="kt-badge kt-badge--warning kt-badge--inline">View / Update</span></a>';
                    }
                    break;
            }
        })->addColumn('permit_status', function ($permit) {
            return  $permit->status;
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
            }
            return '<a href="' . route('event.show', $permit->event_id) . '?tab=' . $from . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
        })->addColumn('download', function ($permit) {
            if ($permit->status == 'expired') {
                return;
            } else {
                return '<a href="' . route('company.event.download', $permit->event_id) . '" target="_blank" title="Download"><span class="fa fa-file-download fa-2x"></i></a>';
            }
        })->rawColumns(['action', 'details', 'download'])->make(true);
    }

    public function amend(Event $event)
    {
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

        $liquor_details = $request->liquorDetails;
        $liquorDocDetails = json_decode($request->liquorDocDetails,  true);
        $event_liquor_id = $request->event_liquor_id;

        $event = Event::where('event_id', $request->event_id)->update(
            [
                'issued_date' => Carbon::parse($request->issued_date)->toDateString(),
                'expired_date' => Carbon::parse($request->expired_date)->toDateString(),
                'time_start' => $request->time_start,
                'time_end' => $request->time_end,
                'status' => 'amended'
            ]
        );

        if ($liquor_details) {
            $lq = $liquor_details;
            $update_array = array(
                'company_name_en' => $lq['company_name_en'],
                'company_name_ar' => $lq['company_name_ar'],
                'emirate_id'      => json_encode($lq['l_emirates']),
                'license_number'  => $lq['license_no'],
                'trade_license'   => $lq['trade_license_no'],
                'trade_license_issued_date' => $lq['tl_issue_date'] ? Carbon::parse($lq['tl_issue_date'])->toDateString() : '',
                'trade_license_expired_date' => $lq['tl_expiry_date'] ? Carbon::parse($lq['tl_expiry_date'])->toDateString() : '',
                'license_issued_date' => $lq['l_issue_date'] ? Carbon::parse($lq['l_issue_date'])->toDateString() : '',
                'license_expired_date' => $lq['l_expiry_date'] ? Carbon::parse($lq['l_expiry_date'])->toDateString() : '',
                'status' => 0,
                'created_by' => Auth::user()->user_id,
            );

            $event_liquor = EventLiquor::where('event_liquor_id', $event_liquor_id)->update($update_array);
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

                                $check_path = 'public/' . $userid . '/event/temp/liquor/' . $event_liquor_id . '/' . $l;

                                $file_count = count(Storage::files($check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $newPath = 'public/' . $userid . '/event/temp/liquor/' . $event_liquor_id . '/' . $l . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                $newPathLink = $userid . '/event/temp/liquor/' . $event_liquor_id . '/'  . $l . '/' . $next_file_no . '_' . $date . '.' . $ext;

                                EventLiquorTruckRequirement::create([
                                    'issued_date' => !empty((array) $liquorDocDetails[$m]) ? Carbon::parse($liquorDocDetails[$m]['issue_date'])->toDateTimeString() : '',
                                    'expired_date' => !empty((array) $liquorDocDetails[$m]) ? Carbon::parse($liquorDocDetails[$m]['exp_date'])->toDateTimeString() : '',
                                    'created_at' =>  Carbon::now()->toDateTimeString(),
                                    'created_by' =>  Auth::user()->user_id,
                                    'requirement_id' => $l,
                                    'path' =>  $newPathLink,
                                    'event_id'=>$request->event_id,
                                    'type' => 'liquor',
                                    'liquor_truck_id' => $event_liquor_id
                                ]);

                                Storage::move(session($userid  . '_liquor_file_' . $l)[$k], $newPath);
                            }
                        }
                        $request->session()->forget([$userid . '_liquor_file_' . $l, $userid . '_liquor_ext_' . $l]);
                    }
                }
            }
        }
            

        if ($event) {
            $result = ['success', 'Event Permit Amended Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function fetch_truck_req($id)
    {
        return Requirement::where('requirement_type', 'truck')->get();
    }

    public function generateReferenceNumber()
    {
        $last_permit_d = Event::latest()->first();
        if ($last_permit_d) {
            $last_rn = $last_permit_d->reference_number;
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
            'status' => 'draft',
            'created_by' =>  $userid,
            'reference_number' => $this->generateReferenceNumber()
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
                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;


                                $file_count = count(Storage::files($check_path));
                                if ($file_count == 0) {
                                    $next_file_no =  1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;
                                $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_'  . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_event_doc_file_' . $l)[$k], $newPath);
                            } else {
                                $newPathLink = '';
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
                    Storage::move('public/'.$path, 'public/'.$newpath);
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                        'event_id' =>  $event_id
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
                    Storage::move('public/'.$path, 'public/'.$newpath);
                    EventLiquorTruckRequirement::where('liquor_truck_requirement_id', $req->liquor_truck_requirement_id)->update([
                        'path' => $newpath,
                        'event_id' =>$event_id
                    ]);
                }
            }
        }

        EventLiquor::whereNull('event_id')->where('status',1)->delete();
        EventTruck::whereNull('event_id')->where('status',1)->delete();

        if (session($userid . '_event_pic_file')) {
            $ext = session($userid . '_event_ext');
            $check_path = 'public/' .  $userid . '/event/' .  $event_id . '/photos';
            $file_count = count(Storage::files($check_path));
            if ($file_count == 0) {
                $next_file_no = 1;
            } else {
                $next_file_no = $file_count + 1;
            }
            $newPath = 'public/' . $userid . '/event/' . $event_id . '/photos/logo_' . $next_file_no . '_' . $date . '.' . $ext;
            $newPathLink = $userid . '/event/' . $event_id . '/photos/logo_' . $next_file_no . '_' . $date . '.' . $ext;

            $newThumbPath = 'public/' . $userid . '/event/' . $event_id . '/photos/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;
            $newThumbPathLink = $userid . '/event/' . $event_id . '/photos/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;

            Storage::move(session($userid . '_event_pic_file'), $newPath);
            Storage::move(session($userid . '_event_thumb_file'), $newThumbPath);

            session()->forget([$userid . '_event_pic_file', $userid . '_event_ext', $userid . '_event_thumb_file']);
            Event::where('event_id', $event_id)->update(['logo_original' => $newPathLink, 'logo_thumbnail' => $newThumbPathLink]);
        }

        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/event/temp/');


        if ($event) {
            $result = ['success', 'Event Permit Draft Saved Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function view_draft(Event $event)
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['truck_docs'] = EventRequirement::with('requirement')->where('event_id', $event->event_id)->where('type', 'truck')->get();

        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();

        $data['event'] = $event;
        return view('permits.event.draft', $data);
    }


    public function update_draft(Request $request)
    {
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

        $date = date('d_m_Y_H_i_s');

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_event_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_event_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_event_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_event_ext_' . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;


                                $file_count = count(Storage::files($check_path));

                                if ($file_count == 0) {
                                    $next_file_no = 1;
                                } else {
                                    $next_file_no = $file_count + 1;
                                }

                                $event_type__name = strtolower(EventType::where('event_type_id', $evd['event_type_id'])->first()->name_en);

                                $eventTypeName = preg_replace('/\s+/', '_', str_replace('/', '',  $event_type__name));

                                $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;
                                $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/' . $eventTypeName . '_' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_event_doc_file_' . $l)[$k], $newPath);

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
                        $request->session()->forget([$userid . '_event_doc_file_' . $l, $userid . '_event_ext_' . $l]);
                    }
                }
            }
        }

        if (session($userid . '_event_pic_file')) {
            $ext = $userid . '_event_ext';
            $check_path = 'public/' .  $userid . '/event/' .  $event_id . '/photos';
            $file_count = count(Storage::files($check_path));
            if ($file_count == 0) {
                $next_file_no = 1;
            } else {
                $next_file_no = $file_count + 1;
            }
            $newPath = 'public/' . $userid . '/event/' . $event_id . '/photos/logo_' . $next_file_no . '_' . $date . '.' . $ext;
            $newPathLink = $userid . '/event/' . $event_id . '/photos/logo_' . $next_file_no . '_' . $date . '.' . $ext;

            $newThumbPath = 'public/' . $userid . '/event/' . $event_id . '/photos/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;
            $newThumbPathLink = $userid . '/event/' . $event_id . '/photos/logo_thumb_' . $next_file_no . '_' . $date . '.' . $ext;

            Storage::move(session($userid . '_event_pic_file'), $newPath);
            Storage::move(session($userid . '_event_thumb_file'), $newThumbPath);

            session()->forget([$userid . '_event_pic_file', $userid . '_event_ext', $userid . '_event_thumb_file']);
            Event::where('event_id', $event_id)->update(['logo_original' => $newPathLink, 'logo_thumbnail' => $newThumbPathLink]);
        }

        Storage::deleteDirectory('public/' . $userid . '/event/temp/');


        if ($event) {
            $result = ['success', 'Draft Updated Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function payment(Event $event)
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['truck_docs'] = EventRequirement::with('requirement')->where('event_id', $event->event_id)->where('type', 'truck')->get();

        $data['truck_req'] = Requirement::where('requirement_type', 'truck')->get();
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['liquor_req'] = Requirement::where('requirement_type', 'liquor')->get();

        $data['event'] = $event;

        $permit_status = [];
        $is_paid = [];

        foreach($event->permit->artistPermit as $ap){
            array_push($permit_status,strtolower($ap->artist_permit_status));
            array_push($is_paid,strtolower($ap->is_paid));
        }

        $data['containsApproved'] = 0;
        $data['isPaid'] = 1;

        if(in_array('approved', $permit_status)){
            $data['containsApproved'] = 1;
        }

        if(in_array(0, $is_paid)){
            $data['isPaid'] = 0;
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
        $is_truck = $request->isTruck;

        $trnx_id = Transaction::create([
            'reference_number' => getTransactionReferNumber(),
            'transaction_type' => 'event',
            'created_by' => Auth::user()->user_id,
            'transaction_date' => Carbon::now()->format('Y-m-d')
        ]);

        $permit_id = \App\Permit::where('event_id', $event_id)->first()->permit_id;
        
        if ($trnx_id)
        {
            $event_amount = (int)$amount - (int)$truck_fee;
            EventTransaction::create([
                'event_id' => $event_id,
                'transaction_id' => $trnx_id->transaction_id,
                'amount' => $event_amount,
                'type' => 'event',
                'vat' => $vat,
                'user_id' => Auth::user()->user_id
            ]);

            if($is_truck == 1)
            {
                EventTransaction::create([
                    'event_id' => $event_id,
                    'transaction_id' => $trnx_id->transaction_id,
                    'type' => 'truck',
                    'amount' => $truck_fee,
                    'vat' => 0,
                    'user_id' => Auth::user()->user_id
                ]);
            }

            Event::where('event_id', $event_id)->update([
                'status' => 'active',
                'permit_number' => generateEventPermitNumber(),
                'paid' => 1,
                'paid_artist_fee' => $paidArtistFee
            ]);
        }

        if($paidArtistFee)
        {
            $trns = Transaction::create([
                'reference_number' => getTransactionReferNumber(),
                'transaction_type' => 'event',
                'created_by' => Auth::user()->user_id,
                'transaction_date' => Carbon::now()->format('Y-m-d')
            ]);

            $artistPermits = ArtistPermit::where('permit_id', $permit_id)->where('artist_permit_status', 'approved')->get();

            foreach ($artistPermits as $artistPermit) {
                $per_day_fee = $artistPermit->profession->amount;
                $total_fee = $per_day_fee * $noofdays;
                $vat_fee = $total_fee * 0.05 ; 
                $trns->artistPermitTransaction()->create([
                    'vat' => $vat_fee ,
                    'amount' => $total_fee,
                    'permit_id' => $permit_id,
                    'artist_permit_id' => $artistPermit->artist_permit_id,
                    'transaction_id' => $trns->transaction_id
                ]);
            }

            Permit::where('permit_id', $permit_id)->update([
                'paid' => 1,
                'permit_number' => generateArtistPermitNumber(),
                'status' => 'active'
            ]);

            ArtistPermit::where('permit_id', $permit_id)->update(['is_paid' => 1]);
        }

        if ($trnx_id) {
            $result = ['success', 'Payment Done Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function happiness(Event $event)
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
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
        $updateArray = array(
            'type' => 'event',
            'application_id' =>  $request->event_id,
            'rating' => $request->happiness,
            'remarks' => $request->remarks,
            'created_by' => Auth::user()->user_id
        );
        Happiness::create($updateArray);
        $result = ['success', 'Thank you For your Feedback', 'Success'];

        return response()->json(['message' => $result]);
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

    public function uploadLiquor(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $id = $request->id;
        $date = date('d_m_Y_H_i_s');
        $reqId = $request->reqId;
        $ext = $request->files->get('liquor_file_' . $id)->getClientOriginalExtension();
        $path  = Storage::putFileAs('public/' . $user_id . '/event/temp/liquor/' . $id, $request->files->get('liquor_file_' . $id), 'liquor_document_' . $request->id . '_' . $date . '.' . $ext);
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
        return EventTruck::whereNull('event_id')->where('status', 0)->get();
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

        return json_encode($file);
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

        $files = session()->pull(Auth::user()->user_id . '_event_doc_file_' . $reqId, []);
        $exts = session()->pull(Auth::user()->user_id . '_event_ext_' . $reqId, []);
        if (($key = array_search($filepath, $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search($ext, $exts)) !== false) {
            unset($exts[$key]);
        }
        $path  = Storage::delete($filepath);
        session()->put(Auth::user()->user_id . '_liquor_file_' . $reqId, $files);
        session()->put(Auth::user()->user_id . '_liquor_ext_' . $reqId, $exts);
        return $filepath;
    }

    public function deleteTruckUploadedfile(Request $request)
    {
        $filepath = $request->path;
        $ext = $request->ext;
        $id = $request->id;

        $files = session()->pull(Auth::user()->user_id . '_truck_file_' . $id, []);
        $exts = session()->pull(Auth::user()->user_id . '_truck_ext_' . $id, []);
        if (($key = array_search($filepath, $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search($ext, $exts)) !== false) {
            unset($exts[$key]);
        }
        $path  = Storage::delete($filepath);
        session()->put(Auth::user()->user_id . '_truck_file_' .  $id, $files);
        session()->put(Auth::user()->user_id . '_truck_ext_' . $id, $exts);
        return $filepath;
    }

    public function add_artist($id = null)
    {
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


}

/*
        // $tdd = json_decode($request->tdd, true);

        // $truckCount = $evd['no_of_trucks'];
        // $truckReqQuery = Requirement::where('requirement_type', 'truck')->get();
        // $truckReqCount = $truckReqQuery->count();
        // $truckReqIdNames = [];
        // $truckReqIds = [];
        // foreach ($truckReqQuery as $trk) {
        //     array_push($truckReqIdNames, $trk->requirement_name);
        //     array_push($truckReqIds, $trk->requirement_id);
        // }

        // // dump('i outside=' . $i); 

        // for ($i = 1; $i <= $truckCount; $i++) {

        //     for ($j = 1; $j <= $truckReqCount; $j++) {

        //         if (session($userid . '_truck_file_' . $i . '_' . $j)) {


        //             $total_truck_docs = count(session($userid . '_truck_file_' . $i . '_' . $j));


        //             if ($total_truck_docs > 0) {

        //                 for ($k = 0; $k < $total_truck_docs; $k++) {

        //                     if (Storage::exists(session($userid . '_truck_file_' . $i . '_' . $j)[$k])) {

        //                         $ext = session($userid . '_truck_ext_' . $i . '_' . $j)[$k];

        //                         $check_path = 'public/' . $userid . '/event/' . $event_id . '/truck/' . $i . '/' . $j;

        //                         $file_count = count(Storage::files($check_path));

        //                         if ($file_count == 0) {
        //                             $next_file_no = 1;
        //                         } else {
        //                             $next_file_no = $file_count + 1;
        //                         }

        //                         $truckRequirement = preg_replace('/\s+/', '_', str_replace('/', '', strtolower($truckReqIdNames[$j - 1])));

        //                         $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $i . '/' . $j . '/' . $truckRequirement . '_' . $next_file_no . '_' . $date . '.' . $ext;

        //                         $newPathLink = $userid . '/event/' . $event_id . '/' . $i . '/' . $j . '/' . $truckRequirement . '_' . $next_file_no . '_' . $date . '.' . $ext;

        //                         Storage::move(session($userid  . '_truck_file_' . $i . '_' . $j)[$k], $newPath);

        //                         EventRequirement::create([
        //                             'issued_date' => $tdd[$i][$j] != null ? Carbon::parse($tdd[$i][$j]['issue_date'])->toDateTimeString() : '',
        //                             'expired_date' => $tdd[$i][$j] != null ? Carbon::parse($tdd[$i][$j]['exp_date'])->toDateTimeString() : '',
        //                             'created_at' =>  Carbon::now()->toDateTimeString(),
        //                             'created_by' =>  Auth::user()->user_id,
        //                             'event_type_id' => $evd['event_type_id'],
        //                             'requirement_id' => $truckReqIds[$j - 1],
        //                             'type' => 'truck',
        //                             'event_id' => $event_id,
        //                             'path' =>  $newPathLink,
        //                         ]);
        //                     }
        //                 }
        //                 $request->session()->forget([$userid . '_truck_file_' . $i . '_' . $j, $userid . '_truck_ext_' . $i . '_' . $j]);
        //             }
        //         }
        //     }
        // }





































































































































