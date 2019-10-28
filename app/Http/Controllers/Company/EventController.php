<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\EventType;
use App\Countries;
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
use App\EventTransaction;
use App\Transaction;
use App\EventComment;
use Session;
use Storage;
use Calendar;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::with('type')->where('company_id', Auth::user()->EmpClientId)->where('status', 'active')->get();
        return view('permits.event.index', ['events' =>  $events]);
    }


    public function create()
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        return view('permits.event.create', $data);
    }

    public function store(Request $request)
    {

        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);

        $cid = Auth::user()->EmpClientId ? Auth::user()->EmpClientId : '';
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
            'country_id' => $evd['country_id'],
            'emirate_id' => $evd['emirate_id'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
            'status' => 'new',
            'created_by' => $userid,
            'reference_number' => $this->generateReferenceNumber()
        );

        $event = Event::create($input_Array);

        $requirements = EventType::with('requirements')->where('event_type_id', $evd['event_type_id'])->first();

        $requirement_ids = [];

        foreach ($requirements['requirements'] as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements['requirements']->count();

        $event_id = $event->event_id;

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (Session::has($userid . '_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_ext_' . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;

                                if (Storage::exists($check_path)) {
                                    $file_count = count(Storage::files($check_path));
                                    $next_file_no = $file_count + 1;
                                } else {
                                    $next_file_no = 1;
                                }

                                $date = date('d_m_Y_H_i_s');
                                $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;
                                $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_doc_file_' . $l)[$k], $newPath);
                            } else {
                                $newPathLink = '';
                            }

                            EventRequirement::create([
                                'issued_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                                'expired_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                                'created_at' =>  Carbon::now()->toDateTimeString(),
                                'created_by' =>  Auth::user()->user_id,
                                'event_type_id' => $evd['event_type_id'],
                                'requirement_id' => $l,
                                'event_id' => $event_id,
                                'path' =>  $newPathLink,
                            ]);
                        }
                        $request->session()->forget([$userid . '_doc_file_' . $l, $userid . '_ext_' . $l]);

                        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/temp/' . $l);
                    }
                }
            }
        }

        if ($event) {
            $result = ['success', 'Event Permit Applied Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function show(Request $request, Event $event)
    {
        $event = $event->with('requirements')->first();
        return view('permits.event.show', ['event' => $event, 'tab' => $request->tab]);
    }

    public function edit(Event $event)
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['areas'] = Areas::where('emirates_id', 5)->orderBy('area_en', 'asc')->get();
        $data['event'] = $event;
        return view('permits.event.edit', $data);
    }

    public function calendarFn()
    {
        $user = Auth::user();
        $events = Event::where('created_by', $user->user_id)->whereIn('status', ['active', 'expired'])->get();
        $events = $events->map(function ($event) use ($user) {
            return [
                'title' => $user->LanguageId == 1 ? $event->name_en : $event->name_ar,
                // 'start'=> Carbon::createFromTimestamp($event->issued_date.$event->time_start),
                'start' => date('Y-m-d', strtotime($event->issued_date)) . ' ' . date('H:m', strtotime($event->time_start)),
                'end' => date('Y-m-d', strtotime($event->expired_date)) . ' ' . date('H:m', strtotime($event->time_end)),
                'id' => $event->event_id,
                'url' => route('event.show', $event->event_id) . '?tab=calendar',
                'description' => 'Venue : ' . $user->LanguageId == 1 ? $event->venue_en : $event->venue_ar,
                // 'allDay'=> false,
                // 'className' => eventStatus($event->status)
            ];
        });
        return response()->json($events);
    }

    public function update_event(Request $request)
    {
        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);
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
            'country_id' => $evd['country_id'],
            'emirate_id' => $evd['emirate_id'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
            'status' => 'amended'
        );

        $event = Event::where('event_id', $event_id)->update($input_Array);

        $requirements = EventType::with('requirements')->where('event_type_id', $evd['event_type_id'])->first();

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

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_ext_' . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;

                                if (Storage::exists($check_path)) {
                                    $file_count = count(Storage::files($check_path));
                                    $next_file_no = $file_count + 1;
                                } else {
                                    $next_file_no = 1;
                                }

                                $date = date('d_m_Y_H_i_s');
                                $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;
                                $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_doc_file_' . $l)[$k], $newPath);
                            } else {
                                $newPathLink = '';
                            }

                            EventRequirement::create([
                                'issued_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                                'expired_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                                'created_at' =>  Carbon::now()->toDateTimeString(),
                                'created_by' =>  Auth::user()->user_id,
                                'event_type_id' => $evd['event_type_id'],
                                'requirement_id' => $l,
                                'event_id' => $event_id,
                                'path' =>  $newPathLink,
                            ]);
                        }
                        $request->session()->forget([$userid . '_doc_file_' . $l, $userid . '_ext_' . $l]);

                        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/temp/' . $l);
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
            'cancel_reason' => $reason
        ]);

        return redirect()->route('event.index');
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
        $data['company_details'] = Company::find(Auth::user()->EmpClientId);
        $data['event_details'] = Event::with('type', 'country')->where('event_id', $id)->first();

        $pdf = PDF::loadView('permits.event.print', $data, [], [
            'title' => 'Event Permit',
            'default_font_size' => 10
        ]);
        // $pdf->getMpdf()->useDefaultCSS2();
        return $pdf->stream('Event-Permit.pdf');
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
        $permits = Event::with('type')->where('created_by', Auth::user()->user_id);

        if ($status == 'applied') {
            $permits->where('status', '!=', 'active')->where('status', '!=', 'draft');
        } else if ($status == 'valid') {
            $permits->whereIn('status', ['active', 'expired'])->OrderBy('updated_at', 'desc');
        } else if ($status == 'draft') {
            $permits->where('status', 'draft');
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
        })->addColumn('action', function ($permit) use ($status) {
            switch ($status) {
                case 'applied':
                    if ($permit->status == 'approved-unpaid') {
                        return '<a href="' . route('company.event.payment', $permit->event_id) . '"  title="Payments"><span class="kt-badge kt-badge--success kt-badge--inline">Payment</span></a>';
                    } else if ($permit->status == 'new') {
                        return '<a href="' . route('event.edit', $permit->event_id) . '"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a><span onClick="cancel_permit(' . $permit->event_id . ',\'' . $permit->reference_number . '\')" data-toggle="modal" data-target="#cancel_permit" class="kt-badge kt-badge--danger kt-badge--inline">Cancel</span>';
                    } else if ($permit->status == 'need modification') {
                        return '<a href="' . route('event.edit', $permit->event_id) . '"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a>';
                    } else if ($permit->status == 'rejected') {
                        return '<span onClick="rejected_permit(' . $permit->event_id . ')" data-toggle="modal" data-target="#rejected_permit" class="kt-badge kt-badge--info kt-badge--inline">Rejected</span>';
                    } else if ($permit->status == 'cancelled') {
                        return '<span onClick="show_cancelled(' . $permit->event_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="kt-badge kt-badge--info kt-badge--inline">Cancelled</span>';
                    }
                    break;
                case 'valid':
                    if ($permit->status == 'active') {
                        return '<a href="' . route('company.event.download', $permit->event_id) . '"  title="Download" target="_blank"><span class="kt-badge kt-badge--success kt-badge--inline">Download</span></a>';
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
        })->rawColumns(['action', 'details'])->make(true);
    }

    public function generateReferenceNumber()
    {
        $last_permit_d = Event::latest()->first();
        if (empty($last_permit_d)) {
            $new_refer_no = sprintf("RNE%04d",  1);
        } else {
            $last_rn = $last_permit_d->reference_number;
            $n = substr($last_rn, 3);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_refer_no = sprintf("RNE%0" . $x . "d", $n + 1);
        }
        return $new_refer_no;
    }

    public function fetch_requirements($id)
    {
        $requirements = EventType::with('requirements')->where('event_type_id', $id)->latest()->first();
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

        $cid = Auth::user()->EmpClientId ? Auth::user()->EmpClientId : '';
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
            'country_id' => $evd['country_id'],
            'emirate_id' => $evd['emirate_id'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
            'status' => 'draft',
            'created_by' =>  $userid,
        );

        $event = Event::create($input_Array);

        $requirements = EventType::with('requirements')->where('event_type_id', $evd['event_type_id'])->first();

        $requirement_ids = [];

        foreach ($requirements['requirements'] as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }

        $total = $requirements['requirements']->count();

        $event_id = $event->event_id;

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                $total_docs = count(session($userid . '_doc_file_' . $l));

                if ($total_docs > 0) {

                    for ($k = 0; $k < $total_docs; $k++) {
                        if (Storage::exists(session($userid  . '_doc_file_' . $l)[$k])) {
                            $ext = session($userid . '_ext_' . $l)[$k];

                            $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;

                            if (Storage::exists($check_path)) {
                                $file_count = count(Storage::files($check_path));
                                $next_file_no = $file_count + 1;
                            } else {
                                $next_file_no = 1;
                            }

                            $date = date('d_m_Y_H_i_s');
                            $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;
                            $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;

                            Storage::move(session($userid  . '_doc_file_' . $l)[$k], $newPath);
                        } else {
                            $newPathLink = '';
                        }

                        EventRequirement::create([
                            'issued_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                            'expired_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                            'created_at' =>  Carbon::now()->toDateTimeString(),
                            'created_by' =>  Auth::user()->user_id,
                            'event_type_id' => $evd['event_type_id'],
                            'requirement_id' => $l,
                            'event_id' => $event_id,
                            'path' =>  $newPathLink,
                        ]);
                    }
                    $request->session()->forget([$userid . '_doc_file_' . $l, $userid . '_ext_' . $l]);

                    Storage::deleteDirectory('public/' . Auth::user()->user_id . '/temp/' . $l);
                }
            }
        }


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
        $data['event'] = $event;
        return view('permits.event.draft', $data);
    }


    public function update_draft(Request $request)
    {
        $evd = json_decode($request->eventD, true);
        $dod = json_decode($request->documentD, true);
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
            'country_id' => $evd['country_id'],
            'emirate_id' => $evd['emirate_id'],
            'area_id' => $evd['area_id'],
            'event_type_id' => $evd['event_type_id'],
        );

        $event = Event::where('event_id', $event_id)->update($input_Array);

        $requirements = EventType::with('requirements')->where('event_type_id', $evd['event_type_id'])->first();

        $requirement_ids = [];


        foreach ($requirements->requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }

        $total = $requirements['requirements']->count();

        if ($dod) {

            for ($j = 0; $j < $total; $j++) {

                $l = $requirement_ids[$j];
                $m = $j + 1;

                if (session($userid . '_doc_file_' . $l)) {

                    $total_docs = count(session($userid . '_doc_file_' . $l));

                    if ($total_docs > 0) {

                        for ($k = 0; $k < $total_docs; $k++) {
                            if (Storage::exists(session($userid  . '_doc_file_' . $l)[$k])) {
                                $ext = session($userid . '_ext_' . $l)[$k];

                                $check_path = 'public/' . $userid . '/event/' . $event_id . '/' . $l;

                                if (Storage::exists($check_path)) {
                                    $file_count = count(Storage::files($check_path));
                                    $next_file_no = $file_count + 1;
                                } else {
                                    $next_file_no = 1;
                                }

                                $date = date('d_m_Y_H_i_s');
                                $newPath = 'public/' . $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;
                                $newPathLink = $userid . '/event/' . $event_id . '/' . $l . '/document_' . $next_file_no . '_' . $date . '.' . $ext;

                                Storage::move(session($userid  . '_doc_file_' . $l)[$k], $newPath);
                            } else {
                                $newPathLink = '';
                            }

                            EventRequirement::create([
                                'issued_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['issue_date'])->toDateTimeString() : '',
                                'expired_date' => $dod[$m] != null ? Carbon::parse($dod[$m]['exp_date'])->toDateTimeString() : '',
                                'created_at' =>  Carbon::now()->toDateTimeString(),
                                'created_by' =>  Auth::user()->user_id,
                                'event_type_id' => $evd['event_type_id'],
                                'requirement_id' => $l,
                                'event_id' => $event_id,
                                'path' =>  $newPathLink,
                            ]);
                        }
                        $request->session()->forget([$userid . '_doc_file_' . $l, $userid . '_ext_' . $l]);

                        Storage::deleteDirectory('public/' . Auth::user()->user_id . '/temp/' . $l);
                    }
                }
            }
        }


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
        $data['event'] = $event;
        return view('permits.event.payment', $data);
    }

    function getTransactionReferNumber()
    {
        $last_tran_d = Transaction::latest()->first();
        if (empty($last_tran_d)) {
            $new_refer_no = sprintf("TRN%04d",  1);
        } else {
            $last_rn = $last_tran_d->reference_number;
            $n = substr($last_rn, 3);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_refer_no = sprintf("TRN%0" . $x . "d", $n + 1);
        }
        return $new_refer_no;
    }

    function generatePermitNumber()
    {
        $last_permit_d = Event::where('permit_number', 'not like', '%-%')->latest()->first();

        if (!isset($last_permit_d->permit_number)) {
            $new_permit_no = sprintf("EP%04d",  1);
        } else {
            $last_pn = $last_permit_d->permit_number;
            $n = substr($last_pn, 2);
            $f = substr($n, 0, 1);
            $l = substr($n, -1, 1);
            $x = 4;
            if ($f == 9 && $l == 9) {
                $x++;
            }
            $new_permit_no = sprintf("EP%0" . $x . "d", $n + 1);
        }
        return $new_permit_no;
    }

    public function make_payment(Request $request)
    {
        $event_id = $request->event_id;
        $amount = $request->amount;
        $vat = $request->vat;

        $trnx_id = Transaction::create([
            'reference_number' => $this->getTransactionReferNumber(),
            'transaction_type' => 'event',
            'company_id' => Auth::user()->EmpClientId,
            'transaction_date' => Carbon::now()->format('Y-m-d')
        ]);

        if ($trnx_id) {
            EventTransaction::create([
                'event_id' => $event_id,
                'transaction_id' => $trnx_id->transaction_id,
                'amount' => $amount,
                'vat' => $vat,
            ]);

            Event::where('event_id', $event_id)->update([
                'status' => 'active',
                'permit_number' => $this->generatePermitNumber()
            ]);
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
        $data['event'] = $event;
        return view('permits.event.happiness', $data);
    }

    public function submit_happiness(Request $request)
    {
        $event_id = $request->event_id;
        $happiness = $request->happiness;
        $result = ['success', 'Thank you For your Feedback', 'Success'];

        return response()->json(['message' => $result]);
    }

    public function uploadDocument(Request $request)
    {
        $user_id = Auth::user()->user_id;
        $date = date('d_m_Y_H_i_s');
        $reqId = $request->reqId;
        $ext = $request->files->get('doc_file_' . $request->id)->getClientOriginalExtension();
        $path  = Storage::putFileAs('public/' . $user_id . '/temp/' . $reqId, $request->files->get('doc_file_' . $request->id), 'document_' . $request->id . '_' . $date . '.' . $ext);
        if (!Session::exists($user_id . '_doc_file_' . $reqId)) {
            session()->put($user_id . '_doc_file_' . $reqId, []);
            session()->put($user_id . '_ext_' . $reqId, []);
        }
        session()->push($user_id . '_doc_file_' . $reqId, $path);
        session()->push($user_id . '_ext_' . $reqId, $ext);

        return response()->json(['filepath' => $path, 'ext' => $ext, 'id' => $reqId]);
    }

    public function deleteUploadFile(Request $request)
    {
        $filepath = $request->path;
        $ext = $request->ext;
        $reqId = $request->id;

        $files = session()->pull(Auth::user()->user_id . '_doc_file_' . $reqId, []);
        $exts = session()->pull(Auth::user()->user_id . '_ext_' . $reqId, []);
        if (($key = array_search($filepath, $files)) !== false) {
            unset($files[$key]);
        }
        if (($key = array_search($ext, $exts)) !== false) {
            unset($exts[$key]);
        }
        $path  = Storage::delete($filepath);
        session()->put(Auth::user()->user_id . '_doc_file_' . $reqId, $files);
        session()->put(Auth::user()->user_id . '_ext_' . $reqId, $exts);
        return $filepath;
    }
}
