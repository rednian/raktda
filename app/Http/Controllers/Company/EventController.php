<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\EventType;
use App\Countries;
use App\Emirates;
use App\Areas;
use App\Event;
use Auth;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use PDF;
use App\Company;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::with('type')->where('company_id', Auth::user()->EmpClientId)->where([['status', '!=', 'active'], ['status', '!=', 'draft']])->get();
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

    public function store(EventRequest $request)
    {
        $input_Array = $request->validated();
        $input_Array['status'] =  $request->submit == 'finished' ? 'new' : 'draft';
        $input_Array['company_id'] = Auth::user()->EmpClientId;
        $input_Array['reference_number'] = $this->generateReferenceNumber();

        Event::create($input_Array);

        return redirect()->route('event.index');
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

    public function update(EventRequest $request)
    {
        $input_Array = $request->validated();
        $input_Array['status'] =  'new';
        $input_Array['company_id'] = Auth::user()->EmpClientId;
        $input_Array['reference_number'] = $this->generateReferenceNumber();

        Event::where('event_id', $request->event_id)->update($input_Array);

        return redirect('company/event');
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

    public function download(Event $event)
    {
        $data['company_details'] = Company::find(Auth::user()->EmpClientId);
        $data['event_details'] = $event->with('type', 'country')->get();

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
            $permits->where('status', 'active');
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
                        return '<a href="' . route('event.payment', $permit->event_id) . '"  title="Payments"><span class="kt-badge kt-badge--success kt-badge--inline">Payment</span></a>';
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
}
