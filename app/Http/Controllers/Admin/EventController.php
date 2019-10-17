<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Calendar;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
	public function index()
	{
		return view('admin.event.index', ['page_title'=>'Event Permit']);
	}

	public function checkApplication(Request $request, Event $event)
	{
		$user = Auth::user();
		$request['user_id'] = $user->user_id;
		$request['role_id'] =$user->roles()->first()->role_id;
		$status = null;
		if ($request->step == '1'){
			if($request->status == 'rejected' || $request->status == 'approved'){
				$status = $request->status;
			}
			else{
//				$status =
			}
				$event->update(['status', $request->status]);
			$request['step'] = 'Event Information';
			if($request->comment){ $event->comment()->create($request->all()); }

		}
	}

	public function updateLock(Request $request, Event $event)
	{
		if($request->ajax()){
			$event->update(['last_check_by'=>Auth::user()->user_id, 'lock'=>Carbon::now()]);
		}
	}

	public function application(Request $request, Event $event)
    {
        $this->authorize('view', $event);
		$event->update(['last_check_by' => Auth::user()->user_id, 'lock'=>Carbon::now()]);


		$existing_event = Event::where('event_id', '!=', $event->event_id)
			 ->whereIn('status', ['processing', 'active', 'approved-unpaid'])
			 ->whereBetween('time_end', [$event->time_start, $event->time_end])->get();


		return view('admin.event.application', [
			 'page_title'=>'Event Application',
			 'event'=>$event,
			 'existing_event'=>$existing_event
		]);
	}

	public function show(Event $event)
	{
		$event = Calendar::event(
			 "Valentine's Day",
			 true,
			 '2015-02-14',
			 '2015-02-14',
			 1,
			 ['url' => 'http://full-calendar.io']
		);
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
				 ->addColumn('type', function($e){
				 	return null;
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
