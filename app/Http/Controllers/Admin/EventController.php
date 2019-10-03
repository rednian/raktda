<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
	public function index()
	{
		return view('admin.event.index', ['page_title'=>'Event Permit']);
	}

	public function application(Request $request, Event $event)
	{
		$existing_event = Event::where('event_id', '!=', $event->event_id)
			 ->whereIn('status', ['processing', 'active', 'approved-unpaid'])
			 ->whereBetween('time_end', [$event->time_start, $event->time_end])
			 ->whereBetween('expired_date', [$event->issued_date, $event->expired_date])->count();
//		dd($existing_event);
		return view('admin.event.application', [
			 'page_title'=>'Event Application',
			 'event'=>$event,
			 'existing_event'=>$existing_event
		]);
	}

	public function show(Event $event)
	{
		return view('admin.event.show', ['page_title'=>'']);
	}

	public function dataTable(Request $request)
	{
		if ($request->ajax()){
			$user = Auth::user();
			$start = $request->start;
			$length = $request->length;

			$events = Event::has('type')
				 ->whereIn('status', $request->status)
				 ->orderBy('updated_at', 'desc');

			 $totalRecords = $events->count();
         $events = $events->offset($start)->limit($length);

			return DataTables::of($events)
				 ->addColumn('company_name', function($event){
				 	return $event->company->company_name;
				 })
				 ->addColumn('event_name', function($event) use ($user){
				 	return ucwords($event->name_en);
				 })
				 ->editColumn('created_at', function($event){
				 	return $event->created_at->format('d-M-Y h:m a');
				 })
				 ->addColumn('start_date', function($event){
				 	return $event->issued_date.'  '.$event->time_start;
				 })
				 ->editColumn('status', function($event){
				 	return permitStatus($event->status);
				 })
				 ->rawColumns(['status'])
				 ->setTotalRecords($totalRecords)
				 ->make(true);
		}
	}
}
