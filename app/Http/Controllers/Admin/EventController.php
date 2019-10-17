<?php

	namespace App\Http\Controllers\Admin;

	use App\Event;
	use App\Http\Controllers\Controller;
	use Carbon\Carbon;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use MaddHatter\LaravelFullcalendar\Calendar;
	use function PHPSTORM_META\type;
	use Yajra\DataTables\Facades\DataTables;

	class EventController extends Controller
	{
		public function index()
		{
			return view('admin.event.index', ['page_title' => 'Event Permit']);
		}

		public function submit(Request $request, Event $event)
		{
			$user = Auth::user();
			$request['user_id'] = $user->user_id;

			$event->check()->where('event_id', $event->event_id)->delete();
			$event->check()->create($request->all());

			if ($request->status == 'rejected' || $request->status == 'approved-unpaid' || $request->status == 'amend') {$type = 1; }
			if ($request->comment) {
				$comment = $event->comment()->create($request->all());
			}


			if ($request->status != 'need approval') {
				$request['role_id'] = $user->roles()->first()->role_id;
				$x = $event->approve()->create($request->all());
				$event->update(['status' => $request->status]);
			} else {

			}

		}

		public function updateLock(Request $request, Event $event)
		{
			if ($request->ajax()) {
				$event->update(['last_check_by' => Auth::user()->user_id, 'lock' => Carbon::now()]);
			}
		}


		public function application(Request $request, Event $event)
		{
			$this->authorize('view', $event);
			$event->update(['last_check_by' => Auth::user()->user_id, 'lock' => Carbon::now()]);


			$existing_event = Event::where('event_id', '!=', $event->event_id)
				 ->whereIn('status', ['processing', 'active', 'approved-unpaid'])
				 ->whereBetween('time_end', [$event->time_start, $event->time_end])
				 ->whereBetween('expired_date', [$event->issued_date, $event->expired_date])->get();

			return view('admin.event.application', [
				 'page_title' => 'Event Application',
				 'event' => $event,
				 'existing_event' => $existing_event
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
			return view('admin.event.show', ['page_title' => '']);
		}


		public function applicationDatatable(Request $request, Event $event)
		{
			$event = $event->requirements()->get();
			$user = Auth::user();
//		dd($event->first()->pivot);
			return DataTables::of($event)
				 ->addColumn('name', function($event) use ($user){
					 $name = $user->LanguageId == 1 ? $event->requirement_name : $event->requirement_name_ar;
					 return '<a href="'.asset('/storage/'.$event->pivot->path).'"  data-fancybox data-fancybox data-caption="'.$name.'">'.$name.'</a>';
				 })
				 ->addColumn('issued_date', function($event){
					 if ($event->dates_required && $event->issued_date) {
						 return $event->issued_date->format('d-M-Y');
					 }
					 return 'Not Required';
				 })
				 ->addColumn('expired_date', function($event){
					 if ($event->dates_required && $event->expired_date) {
						 return $event->expired_date->format('d-M-Y');
					 }
					 return 'Not Required';
				 })
				 ->rawColumns(['name'])
				 ->make(true);
//		}
		}

		public function dataTable(Request $request)
		{
			// dd($request->all());
			if ($request->ajax()) {
				$user = Auth::user();
//			$start = $request->start;
//			$length = $request->length;
			$events = Event::when($request->type, function($q) use ($request){
				$q->whereHas('applied', function($q) use ($request){
					$q->where('type', $request->type);
				});
			})
			->when($request->status, function($q) use ($request){
				$q->whereIn('status', $request->status);
			})
			->where('status', '!=', 'draft')
			->orderBy('updated_at', 'desc')
			->get();
				// dd($events);

				return DataTables::of($events)
					 ->addColumn('establishment_name', function($event){
						 return $event->applied->type != 2 ? $event->applied->company->company_name : null;
					 })
					 ->addColumn('owner', function($event) use ($user){
						 if ($user->LanguageId == 1) {
							 return ucwords($event->applied->NameEn);
						 }
						 return $event->applied->NameAr;
					 })
					 ->addColumn('event_name', function($event) use ($user){
						 if ($user->LanguageId == 1) {
							 return ucwords($event->name_en);
						 }
						 return $event->name_ar;
					 })
					 ->addColumn('type', function($event){
						 return ucwords(userType($event->applied->type));
					 })
					 ->editColumn('created_at', function($event){
						 return $event->created_at->format('d-M-Y');
					 })
					 ->addColumn('start', function($event){
						 return $event->issued_date.'  '.$event->time_start;
					 })
					 ->editColumn('status', function($event){
						 return permitStatus($event->status);
					 })
					 ->rawColumns(['status'])
//				 ->setTotalRecords($totalRecords)
					 ->make(true);
			}
		}
	}
