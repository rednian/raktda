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
use Storage;

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
        $data['countries'] = Countries::all()->sortBy('name_en');
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['areas'] = Areas::all()->sortBy('name_en');
        return view('permits.event.create', $data);
    }

    public function store(Request $request)
    {
        // dd($request);
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
            'event_type_id' => $evd['event_id'],
            'status' => 'new',
            'company_id' => $cid,
            'reference_number' => $this->generateReferenceNumber()
        );

        $event = Event::create($input_Array);

        $requirements = EventType::with('requirements')->where('event_type_id', $evd['event_id'])->first();

        $requirement_ids = [];
        foreach ($requirements['requirements'] as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements['requirements']->count();

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);

        $event_id = $event->event_id;

        if ($dod) {

            for ($j = 1; $j <= $total; $j++) {

                if (Storage::exists(session($userid . '_doc_file_' . $j))) {

                    $ext = session($userid . '_ext_' . $j);

                    $check_path = 'public/' . $company_name . '/event/' . $event_id;

                    if (Storage::exists($check_path)) {
                        $file_count = count(Storage::files($check_path));
                        $next_file_no = $file_count + 1;
                    } else {
                        $next_file_no = $j;
                    }

                    $newPath = 'public/' . $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;
                    $newPathLink = $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;

                    Storage::move(session($userid  . '_doc_file_' . $j), $newPath);
                    Storage::delete(session($userid  . '_doc_file_' . $j));

                    $request->session()->forget([$userid . '_doc_file_' . $j, $userid . '_ext_' . $j]);
                } else {
                    $newPathLink = '';
                }


                EventRequirement::create([
                    'issued_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'event_type_id' => $evd['event_id'],
                    'requirement_id' => $requirement_ids[$j - 1],
                    'event_id' => $event_id,
                    'path' =>  $newPathLink,
                ]);
            }
        }


        if ($event) {
            $result = ['success', 'Event Permit Applied Successfully', 'Success'];
        } else {
            $result = ['error', 'Error, Please Try Again', 'Error'];
        }

        return response()->json(['message' => $result]);
    }

    public function show(Event $event)
    {
        return view('permits.event.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['countries'] = Countries::all()->sortBy('name_en');
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['areas'] = Areas::all()->sortBy('name_en');
        $data['event'] = $event;
        return view('permits.event.edit', $data);
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
            'event_type_id' => $evd['event_id'],
            'status' => 'new',
        );

        $event = Event::where('event_id', $event_id)->update($input_Array);

        $requirements = EventType::with('requirements')->where('event_type_id', $evd['event_id'])->first();

        $requirement_ids = [];
        foreach ($requirements['requirements'] as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements['requirements']->count();

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);


        if ($dod) {

            for ($j = 1; $j <= $total; $j++) {

                if (Storage::exists(session($userid . '_doc_file_' . $j))) {

                    $ext = session($userid . '_ext_' . $j);

                    $check_path = 'public/' . $company_name . '/event/' . $event_id;

                    if (Storage::exists($check_path)) {
                        $file_count = count(Storage::files($check_path));
                        $next_file_no = $file_count + 1;
                    } else {
                        $next_file_no = $j;
                    }

                    $newPath = 'public/' . $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;
                    $newPathLink = $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;

                    Storage::move(session($userid  . '_doc_file_' . $j), $newPath);
                    Storage::delete(session($userid  . '_doc_file_' . $j));

                    $request->session()->forget([$userid . '_doc_file_' . $j, $userid . '_ext_' . $j]);
                } else {
                    $newPathLink = '';
                }


                EventRequirement::create([
                    'issued_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'event_type_id' => $evd['event_id'],
                    'requirement_id' => $requirement_ids[$j - 1],
                    'event_id' => $event_id,
                    'path' =>  $newPathLink,
                ]);
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
    { }

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
        $permits = Event::with('type')->where('company_id', Auth::user()->EmpClientId);

        if ($status == 'applied') {
            $permits->where('status', '!=', 'active')->where('status', '!=', 'draft');
        } else if ($status == 'valid') {
            $permits->where('status', 'active')->OrderBy('updated_at', 'desc');
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
                    } else if ($permit->status == 'uploadrequest') {
                        return '<a href="' . route('company.event.upload', $permit->event_id) . '"><span class="kt-badge kt-badge--info  kt-badge--inline kt-margin-r-5">Upload </span></a>';
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
                        return '<a href="' . route('company.event.draft', $permit->event_id) . '"  title="View"><span class="kt-badge kt-badge--warning kt-badge--inline">View</span></a>';
                    }
                    break;
            }
        })->addColumn('permit_status', function ($permit) {
            return  $permit->status;
        })->addColumn('details', function ($permit) {
            return '<a href="' . route('event.show', $permit->event_id) . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
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

    public function get_uploaded_docs(Request $request)
    {
        $event_id = $request->eventId;
        $req_id = $request->reqId;

        $docs = EventRequirement::with('requirement')->where('event_id', $event_id)->where('requirement_id', $req_id)->latest()->first();
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
            'event_type_id' => $evd['event_id'],
            'status' => 'draft',
            'company_id' => $cid,
        );

        $event = Event::create($input_Array);

        $requirements_ar = EventType::with('requirements')->where('event_type_id', $evd['event_id'])->first();

        $requirements = $requirements_ar['requirements'];

        $requirement_ids = [];
        foreach ($requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements->count();

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);

        $event_id = $event->event_id;

        if ($dod) {

            for ($j = 1; $j <= $total; $j++) {

                if (Storage::exists(session($userid . '_doc_file_' . $j))) {

                    $ext = session($userid . '_ext_' . $j);

                    $check_path = 'public/' . $company_name . '/event/' . $event_id;

                    if (Storage::exists($check_path)) {
                        $file_count = count(Storage::files($check_path));
                        $next_file_no = $file_count + 1;
                    } else {
                        $next_file_no = $j;
                    }

                    $newPath = 'public/' . $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;
                    $newPathLink = $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;

                    Storage::move(session($userid  . '_doc_file_' . $j), $newPath);
                    Storage::delete(session($userid  . '_doc_file_' . $j));

                    $request->session()->forget([$userid . '_doc_file_' . $j, $userid . '_ext_' . $j]);
                } else {
                    $newPathLink = '';
                }


                EventRequirement::create([
                    'issued_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'event_type_id' => $evd['event_id'],
                    'requirement_id' => $requirement_ids[$j - 1],
                    'event_id' => $event_id,
                    'path' =>  $newPathLink,
                ]);
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
        $data['countries'] = Countries::all()->sortBy('name_en');
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['areas'] = Areas::all()->sortBy('name_en');
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
            'event_type_id' => $evd['event_id'],
        );

        $event = Event::where('event_id', $event_id)->update($input_Array);

        $requirements_ar = EventType::with('requirements')->where('event_type_id', $evd['event_id'])->first();

        $requirements = $requirements_ar['requirements'];

        $requirement_ids = [];
        foreach ($requirements as $req) {
            array_push($requirement_ids, $req->requirement_id);
        }
        $total = $requirements->count();

        $company_array = Company::find(Auth::user()->EmpClientId);
        $company_name = str_replace(' ', '_', $company_array->company_name);
        $company_name = strtolower($company_name);

        if ($dod) {

            for ($j = 1; $j <= $total; $j++) {

                if (Storage::exists(session($userid . '_doc_file_' . $j))) {

                    $ext = session($userid . '_ext_' . $j);

                    $check_path = 'public/' . $company_name . '/event/' . $event_id;

                    if (Storage::exists($check_path)) {
                        $file_count = count(Storage::files($check_path));
                        $next_file_no = $file_count + 1;
                    } else {
                        $next_file_no = $j;
                    }

                    $newPath = 'public/' . $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;
                    $newPathLink = $company_name . '/event/' . $event_id . '/document_' . $next_file_no . '.' . $ext;

                    Storage::move(session($userid  . '_doc_file_' . $j), $newPath);
                    Storage::delete(session($userid  . '_doc_file_' . $j));

                    $request->session()->forget([$userid . '_doc_file_' . $j, $userid . '_ext_' . $j]);
                } else {
                    $newPathLink = '';
                }


                EventRequirement::create([
                    'issued_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['issue_date'])->toDateTimeString() : '',
                    'expired_date' => $dod[$j] != null ? Carbon::parse($dod[$j]['exp_date'])->toDateTimeString() : '',
                    'created_at' =>  Carbon::now()->toDateTimeString(),
                    'created_by' =>  Auth::user()->user_id,
                    'event_type_id' => $evd['event_id'],
                    'requirement_id' => $requirement_ids[$j - 1],
                    'event_id' => $event_id,
                    'path' =>  $newPathLink,
                ]);
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
        $data['countries'] = Countries::all()->sortBy('name_en');
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['areas'] = Areas::all()->sortBy('name_en');
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
        $last_permit_d = Permit::where('permit_number', 'not like', '%-%')->latest()->first();

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
        $data['countries'] = Countries::all()->sortBy('name_en');
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['areas'] = Areas::all()->sortBy('name_en');
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
}
