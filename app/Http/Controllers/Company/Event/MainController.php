<?php

namespace App\Http\Controllers\Company\Event;

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

class MainController extends Controller
{

    public function index()
    {
        return view('permits.event.index');
    }


    public function create()
    {
        $data['event_types'] = EventType::all()->sortBy('name_en');
        $data['countries'] = Countries::all()->sortBy('name_en');
        $data['emirates'] = Emirates::all()->sortBy('name_en');
        $data['areas'] = Areas::all()->sortBy('name_en');
        return view('permits.event.create', $data);
    }

    public function store()
    {

        $input_Array = request()->validate([
            'event_type_id' => 'required',
            'name_en' => 'required',
            'name_ar' => 'required',
            'issued_date' => ['required', 'date'],
            'expired_date' =>  ['required', 'date', 'after:issued_date'],
            'time_start' =>  'required',
            'time_end' => 'required',
            'venue_en' => 'required',
            'venue_ar' => 'required',
            'country_id' => 'required'
        ]);

        Event::create([$input_Array]);

        return redirect('company/eventpermits');
    }

    public function show($id)
    {
        $events = Event::with('type', 'emirate', 'area', 'country')->where('event_id', $id)->first();


        return view('permits.event.show', compact('events'));
    }

    public function cancel_permit()
    { }

    public function fetch_applied()
    {
        $permits = Event::with('type')->where('company_id', Auth::user()->EmpClientId)->where('status', '!=', 'active')->get();
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
            if ($permit->status == 'approved-unpaid') {
                return '<a href="' . route('company/eventpermits/payment', $permit->event_id) . '"  title="Payments"><span class="kt-badge kt-badge--success kt-badge--inline">Payment</span></a>';
            } else if ($permit->status == 'new') {
                return '<a href="' . url('company/eventpermits/' . $permit->event_id . '/edit') . '"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a><span onClick="cancel_permit(' . $permit->event_id . ',\'' . $permit->reference_number . '\')" data-toggle="modal" data-target="#cancel_permit" class="kt-badge kt-badge--danger kt-badge--inline">Cancel</span>';
            } else if ($permit->status == 'edit request') {
                return '<a href="edit_permit/' . $permit->event_id . '"><span class="kt-badge kt-badge--warning kt-badge--inline kt-margin-r-5">Edit </span></a>';
            } else if ($permit->status == 'rejected') {
                return '<span onClick="rejected_permit(' . $permit->event_id . ')" data-toggle="modal" data-target="#rejected_permit" class="kt-badge kt-badge--info kt-badge--inline">Rejected</span>';
            } else if ($permit->status == 'cancelled') {
                return '<span onClick="show_cancelled(' . $permit->event_id . ')" data-toggle="modal" data-target="#cancelled_permit" class="kt-badge kt-badge--info kt-badge--inline">Cancelled</span>';
            }
        })->addColumn('permit_status', function ($permit) {
            return  $permit->status;
        })->addColumn('details', function ($permit) {
            return '<a href="' . url('company/eventpermits/' . $permit->event_id) . '" title="View Details"><span class="kt-badge kt-badge--dark kt-badge--inline">Details</span></a>';
        })->rawColumns(['action', 'details'])->make(true);
    }

    public function fetch_existing()
    { }

    public function fetch_drafts()
    { }
}
