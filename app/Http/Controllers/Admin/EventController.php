<?php
	namespace App\Http\Controllers\Admin;

	use App\Notifications\EventNotification;
	use DB;
	use niklasravnsborg\LaravelPdf\Pdf;
	use Auth;
	use App\User;
	use MaddHatter\LaravelFullcalendar\Calendar;
	use App\Event;
	use App\EventType;
	use App\Holiday;
	use App\EventTruck;
	use App\EmployeeWorkSchedule;
	use App\Approval;
	use Illuminate\Database\Eloquent\Builder;
	use Carbon\Carbon;
	use App\Requirement;
	use App\EventRequirement;
	use App\GeneralSetting;
	use NumberToWords\NumberToWords;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Yajra\DataTables\Facades\DataTables;

	class EventController extends Controller
	{
		public function index()
		{
			$event = Event::whereDate('expired_date', '<', Carbon::now())->where('status', 'active')->update(['status'=>'expired']);

			$event = Event::whereIn('status', ['amended', 'approved-unpaid', 'active', 'expired', 'rejected', 'need-approval'])->whereHas('comment',function($q){
					$q->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->limit(1);
				})->count();


			return view('admin.event.index', [
				'page_title' => 'Event Permit',
				'types'=> EventType::all(),
				'new_request'=>Event::where('status', 'new')->count(),
				'pending_request'=>Event::where('status', 'amended')->count(),
				'active_request'=> $event,
				'cancelled_permit'=> Event::lastMonth(['cancelled'])->count(),
				'rejected_permit'=> Event::lastMonth(['rejected'])->count(),
				'approved_permit'=> Event::lastMonth(['approved-unpaid'])->count(),
				'active'=> Event::whereStatus('active')->count(),

			]);
		}

		public function cancel(Request $request, Event $event)
		{

			if ($event) {
			try {
				$event->update(['cancel_reason'=> $request->comment ,'status'=>'cancelled']);
				$event->comment()->create(array_merge($request->all(), ['user_id'=>$request->user()->user_id]));
				if($event->permit()->count() > 0){
					$event->permit->update(['permit_status'=>'cancelled', 'cancel_reason'=> $request->comment]);
					$event->permit->comment()->create(array_merge($request->all(), ['user_id'=>$request->user()->user_id]));
				}
				$result = ['success', ucfirst($event->name_en).' has been cancelled Successfully ', 'Success'];
			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
			}
			  return response()->json(['message' => $result]);
			}
		}

		public function showWeb(Request $request, Event $event)
		{
			try {
				$event->update(['is_display_web'=>$request->is_display_web]);
				$result = ['success', ucfirst($event->name_en).' has will display in the website calendar ', 'Success'];
			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
			}
			 return response()->json(['message' => $result]);
		}



		public function showAll(Request $request, Event $event)
		{
			try {
				$event->update(['is_display_all'=>$request->is_display_all]);
				$result = ['success', ucfirst($event->name_en).' has will display in the client\'s calendar ', 'Success'];
			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
			}
			 return response()->json(['message' => $result]);
		}

		public function calendar(Request $request)
		{
			$events = Event::whereIn('status',['active', 'expired'])->get();
			$events = $events->map(function($event) use ($request){
				return [
					'title'=> $request->user()->LanguageId == 1 ? ucfirst($event->name_en) : $event->name_ar,
					'start'=> date('Y-m-d', strtotime($event->issued_date)).' '.date('H:m', strtotime($event->time_start)),
					'end'=> date('Y-m-d', strtotime($event->expired_date)).' '.date('H:m', strtotime( $event->time_end)),
					'id'=>$event->event_id,
					'url'=> route('admin.event.show', $event->event_id).'?tab=event-calendar',
					'description'=> 'Venue : '.$venue = $request->user()->LanguageId == 1 ? $event->venue_en : $event->venue_ar,
					'backgroundColor'=> $event->type->color,
					'textColor' => '#fff !important',
				];
			});
			return response()->json($events);
		}


		public function submit(Request $request, Event $event)
		{
			try {
				DB::beginTransaction();

				$request['checked_at'] = Carbon::now();
				$request['action']  =  $request->status;
				$request['user_type']  =  'admin';
				$request['user_id']  =  $request->user()->user_id;
				$event->check()->where('event_id', $event->event_id)->delete();
				$event->check()->create($request->all());

				switch ($request->status) {
					case 'rejected':
						$event->update(['status'=>$request->status]);
						$event->comment()->create($request->all());
						if ($event->permit()->count() > 0) {
							$event->permit->update(['permit_status'=>$request->status]);
							$event->permit->comment()->create($request->all());
						}
						$result = ['success', ucfirst($event->name_en).'Rejected Successfully', 'Success'];
						break;
					case 'approved-unpaid':
						$event->update(['status'=>$request->status, 'note_en'=>$request->note_en, 'note_ar'=>$request->note_ar]);
						$request['type'] = $type = 1;
						$event->comment()->create($request->all());
						$result = ['success', ucfirst($event->name_en).' Approved Successfully', 'Success'];
						break;
					case 'need modification':

						$event->update(['status'=>$request->status]);
						$request['type'] = 1;
						$request['action'] = 'send back for amendments';
						$event->comment()->create($request->all());

						if($request->requirements_id){
							$requirements_id = array_filter($request->requirements_id, function($v){ if(!empty($v)){ return ($v); } });
							$event->additionalRequirements()->sync($requirements_id);
						}

						if($request->requirements){
							foreach ($request->requirements as $requirement) {
								$requirement = Requirement::create([
									'requirement_name'=>$requirement['name'],
									'dates_required'=>!empty($requirement['date']) ? 1 : 0 ,
									'requirement_description'=>$requirement['description'] ,
									'requirement_type'=>'event'
								]);
								$event->additionalRequirements()->sync($requirement->requirement_id);
							}
						}
						$result = ['success', ucfirst($event->name_en).' has been checked successfully', 'Success'];
						break;
					case 'need approval':

					dd($request->all());

						// $user = User::availableInspector($event->issued_date)->get();
						// $emp = EmployeeWorkSchedule::getSchedule()->get();
						// dd($emp);

							// dd($user);

						$event->update(['status'=>'need approval']);
						$request['type'] = 1;
						$comment = $event->comment()->create($request->all());

						if($request->has('inspection')){
							//CALL FUNCTION APPOINTMENT
							$this->addAppointment([
								'id' => $event->event_id,
								'type' => 'event'
							]);
						}

						$result = ['success', ucfirst($event->name_en).' has been checked successfully', 'Success'];
						break;
				}


				DB::commit();

			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
				DB::rollBack();
			}

			return redirect('/event#new-request')->with('message',$result);
		}

		public function updateLock(Request $request, Event $event)
		{
			if ($request->ajax()) {
				$event->update(['last_check_by' => $request->user()->user_id, 'lock' => Carbon::now()]);
			}
		}

		public function download(Event $event)
		{
			$data['company_details'] = $event->owner->company;
			$data['event_details'] = $event;

			$from_date_formatted = Carbon::parse($event->issued_date);
			$to_date_formatted = Carbon::parse($event->expired_date);
			$diff = $from_date_formatted->diffInDays($to_date_formatted) == 0 ? 1 : $from_date_formatted->diffInDays($to_date_formatted);
			$numberToWords = new NumberToWords();
			$numberTransformer = $numberToWords->getNumberTransformer('en');
			$data['diff'] = $diff;
			$data['days'] = $numberTransformer->toWords($diff);

			$pdf = PDF::loadView('permits.event.print', $data, [], [
			    'title' => 'Event Permit',
			    'default_font_size' => 10
			]);
			return $pdf->stream('Event-Permit.pdf');
		}


		public function application(Request $request, Event $event)
		{
			$this->authorize('view', $event);
			// $event->update(['last_check_by' => Auth::user()->user_id, 'lock' => Carbon::now(), 'status'=>'processing']);
			$existing_event = Event::where('event_id', '!=', $event->event_id)
				 ->whereIn('status', ['processing', 'active', 'approved-unpaid'])
				 ->whereBetween('time_end', [$event->time_start, $event->time_end])
				 ->whereBetween('expired_date', [$event->issued_date, $event->expired_date])->get();

				 $requirements = Requirement::whereHas('events', function($q) use ($event){
				 	$q->where('event.event_id', $event->event_id);
				 })->get();

			return view('admin.event.application', [
				 'page_title' => 'Event Application',
				 'event' => $event,
				 'existing_event' => $existing_event,
				 'requirements' =>$requirements
			]);
		}

		public function show(Request $request, Event $event)
		{
			// dd($event->permits);
			return view('admin.event.show', ['page_title' => '', 'event'=>$event, 'tab'=>$request->tab]);
		}

		public function uploadedRequirement(Request $request, Event $event)
		{

			$requirements = Requirement::whereHas('eventRequirement', function($q) use ($event){
				return $q->where('event_id', $event->event_id);
			})
			->orderBy('requirement_name')
			->get();


			return DataTables::of($requirements)
			->editColumn('name', function($requirement) use ($request){
				return $request->user()->LanguageId == 1 ?  ucfirst($requirement->requirement_name) : $requirement->requirement_name_ar;
			})
			->addColumn('start', function($requirement){
				return $requirement->dates_required == 1 ? $requirement->eventRequirement()->first()->issued_date->format('d-M-Y') : 'Not Required';
			})
			->addColumn('end', function($requirement){
				return $requirement->dates_required == 1 ? $requirement->eventRequirement()->first()->expired_date->format('d-M-Y') : 'Not Required';
			})
			->addColumn('type', function($requirement){
				return strtoupper($requirement->eventRequirement()->first()->type);
			})
			->addColumn('files', function($requirement) use ($request, $event){
				$name =  $request->user()->LanguageId == 1 ?  ucfirst($requirement->requirement_name) : $requirement->requirement_name_ar;
				$files = $requirement->eventRequirement()->where('event_id', $event->event_id)->get();
				$html = '<div class="kt-badge kt-badge__pics">';
				foreach ($files as $index => $file) {
					$html .= '<a href="'.asset('/storage/'.$file->path).'" data-fancybox="images" data-fancybox data-caption="'.$name.'" class="kt-badge__pic">';
					$html .= fileExtension($file->path);
					$html .= '</a>';
					if($index > 5){
						$html .= '<a href="#" class="kt-badge__pic kt-badge__pic--last kt-font-brand">';
						$html .= '+'. $index-5;
						$html .= '</a>';
					}
				}
				$html .= '</div>';


				return $html;
			})
			->rawColumns(['files'])
			->make(true);
		}

		public function addRequirementDatatable(Request $request, Event $event)
		{
			$requirements = Requirement::whereDoesntHave('type.event', function($q) use ($event){
				$q->where('event_id', $event->event_id);
			})
			->whereDoesntHave('additionalRequirements', function($q) use ($event){
				$q->where('event_id', $event->event_id);
			})
			->where('requirement_type', 'event')
			->get();

			return DataTables::of($requirements)
			->addColumn('name', function($requirement) use ($request){
				if($request->user()->LanguageId == 1){ return ucfirst($requirement->requirement_name); }
				return $requirement->requirement_name_ar;
			})
			->addColumn('description', function($requirement){
				return ucfirst($requirement->requirement_description);
			})
			->make(true);
		}

		public function truckDatatable(Request $request, Event $event)
		{
			return DataTables::of($event->truck()->get())
			->addColumn('name', function($truck) use ($request){
				return $request->user()->LanguageId == 1 ?  $truck->company_name_en : $truck->company_name_ar;
			})
			->addColumn('type', function($truck) use ($request){
				return $request->user()->LanguageId == 1 ? $truck->food_type : $truck->food_type;
			})
			->editColumn('plate_number', function ($truck){
				return $truck->plate_number;
			})
			->addColumn('action', function($truck){
            return '<button type="button" class="btn btn-sm btn-secondary btn-document kt-font-transform-u">Documents <span class="kt-badge kt-badge--outline kt-badge--info">'.$truck->upload()->count().'</span></button>';
			})
			->addIndexColumn()
			->rawColumns(['action'])
			->make(true);
		}

		public function truckRequirementDatatable(Request $request, Event $event, EventTruck $eventtruck)
		{
			return DataTables::of($eventtruck->upload()->get())
			->addColumn('name', function($truck) use ($request){
				return $request->user()->LanguageId == 1 ? ucwords($truck->requirement->requirement_name) : $truck->requirement->requirement_name_ar;			
			})
			->addColumn('issued_date', function($truck){
				 return $truck->requirement->dates_required == 1 ? date('d-M-Y',strtotime($truck->issued_date)) : 'Not Required';
			})
			->addColumn('expired_date', function($truck){
				return $truck->requirement->dates_required == 1 ? date('d-M-Y',strtotime($truck->expired_date)) : 'Not Required';
			})
			->addColumn('files', function($truck) use ($request){
				$name = $request->user()->LanguageId == 1 ? ucwords($truck->requirement->requirement_name) : $truck->requirement->requirement_name_ar;
				return '<a class="kt-padding-l-20" href="'.asset('/storage/'.$truck->path).'" data-fancybox="gallery2"  data-fancybox data-caption="'.$name.'">'.strtolower($name).'.'.fileName($truck->path).'</a>';
			})
			->rawColumns(['files', 'name'])
			->make(true);
		}

		public function liquorRequirementDatatable(Request $request, Event $event)
		{
			return DataTables::of($event->liquor->upload()->get())
			->addColumn('name', function($liquor) use ($request){
				return $request->user()->LanguageId == 1 ? ucwords($liquor->requirement->requirement_name) : $liquor->requirement->requirement_name_ar;			
			})
			->addColumn('issued_date', function($liquor){
				 return $liquor->requirement->dates_required == 1 ? date('d-M-Y',strtotime($liquor->issued_date)) : 'Not Required';
			})
			->addColumn('expired_date', function($liquor){
				return $liquor->requirement->dates_required == 1 ? date('d-M-Y',strtotime($liquor->expired_date)) : 'Not Required';
			})
			->addColumn('files', function($liquor) use ($request){
				$name = $request->user()->LanguageId == 1 ? ucwords($liquor->requirement->requirement_name) : $liquor->requirement->requirement_name_ar;
				return '<a class="kt-padding-l-20" href="'.asset('/storage/'.$liquor->path).'" data-fancybox="gallery1"  data-fancybox data-caption="'.$name.'">'.strtolower($name).'.'.fileName($liquor->path).'</a>';
			})
			->rawColumns(['files', 'name'])
			->make(true);
		}


		public function applicationDatatable(Request $request, Event $event)
		{
			$requirements = $event->requirements()->get();

			$requirements = DataTables::of($requirements)
			->addColumn('name', function($requirement) use ($request){
				return $request->user()->LanguageId == 1 ? ucwords($requirement->requirement_name) : $requirement->requirement_name_ar;
				
			})
			->addColumn('issued_date', function($requirement){
				 return $requirement->dates_required == 1 ? date('d-M-Y',strtotime($requirement->eventRequirement()->first()->issued_date)) : 'Not Required';
			})
			->addColumn('expired_date', function($requirement){
				 return $requirement->dates_required == 1 ? date('d-M-Y',strtotime($requirement->eventRequirement()->first()->expired_date)) : 'Not Required';
			})
			->addColumn('files', function($requirement) use ($request){
				$name = $request->user()->LanguageId == 1 ? ucwords($requirement->requirement_name) : $requirement->requirement_name_ar;
				return '<a class="kt-padding-l-20" href="'.asset('/storage/'.$requirement->pivot->path).'" data-fancybox="gallery"  data-fancybox data-caption="'.$name.'">'.strtolower($name).'.'.fileName($requirement->pivot->path).'</a>';
			})
			->rawColumns(['files', 'name'])
			->make(true);

			$data = $requirements->getData(true);

				$data['data'][] = [
				    'name' => 'Event Logo',
				    'files' => '<a class="kt-padding-l-20" href="'.asset('/storage/'.$event->logo_thumbnail).'" data-fancybox data-caption="Event Logo">event logo.'.fileName($event->logo_thumbnail).'</a>',
				    'issued_date'=> 'Not Required',
				    'expired_date'=> 'Not Required',
				];

				 return response()->json($data);

			return $requirements;
		}

		public function imageDatatable(Request $request, Event $event)
		{
			// return DataTables::of($even->otherUpload()->get())
			// ->editColumn('path', function($image){
			// 	return ''
			// })
			// ->editColumn('size', function($image){
			// 	return $image->size;
			// })
			// ->make(true);
		}

		public function commentDatatable(Request $request, Event $event)
		{
			if ($request->ajax()) {
				$comments = $event->comment()->latest();

				return DataTables::of($comments)
				->addColumn('name', function($comment){
					$role = $comment->user_type == 'admin' ? $comment->user->roles()->first()->NameEn : 'Client';
					return defaults($comment->user->NameEn, $role);
				})
				->editColumn('comment', function($comment){
					return ucfirst($comment->comment);
				})
				->addColumn('date', function($comment){
					// dd($comment->created_at->);
					return $comment->created_at->format('d-M-Y h:i A');
				})
				->addColumn('action_taken', function($comment){
					return ucwords($comment->action);
				})
				->rawColumns(['name'])
				->make(true);
			}
		}

		public function dataTable(Request $request)
		{
			if ($request->ajax()) {
				$user = Auth::user();

				$events = Event::when($request->type, function($q) use ($request){
					$q->where('firm', $request->type);
				})
				->when($request->status, function($q) use ($request){
					$q->whereIn('status', $request->status);
				})
				->whereNotIn('status', ['draft'])
				// ->orderBy('created_at')
				->latest();

				$table =  DataTables::of($events)
				->addColumn('establishment_name', function($event){
					return $event->owner->type != 2 ? $event->owner->company->name_en : null;
				})
				->addColumn('duration', function($event) use ($user){
					
                      $html = '<div class="kt-user-card-v2">';
                      $html .= ' <div class="kt-user-card-v2__details">';
                      // $html .= '  <span class="kt-user-card-v2__name">'.$event->issued_date.'-'.$event->expired_date.'</span>';
                      $html .= '  <span class="kt-user-card-v2__email kt-link">'.Carbon::parse($event->issued_date)->diffInDays($event->expired_date).' Days</span>';
                      $html .= ' </div>';
                      $html .= '</div>';
                      return $html;

				})
				->addColumn('owner',function(){

				})
				->addColumn('website', function($event){
					$display = $event->is_display_web ? 'checked="checked"' : null;

					$html =  '<span class="kt-switch  kt-switch--outline kt-switch--icon kt-switch--success kt-switch--sm">';
					$html .=  '	<label>';
					$html .=  '	<input class="website" type="checkbox" '.$display.' name="">';
					$html .=  '		<span></span>';
					$html .=  '	</label>';
					$html .=  '</span>';
					return $html;
				})
				->addColumn('show', function($event){
					$display = $event->is_display_all ? 'checked="checked"' : null;

					$html =  '<span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success kt-switch--sm">';
					$html .=  '	<label >';
					$html .=  '	<input class="display-all" type="checkbox" '.$display.' name="" >';
					$html .=  '		<span ></span>';
					$html .=  '	</label>';
					$html .=  '</span>';
					return $html;

				})
				->addColumn('event_name', function($event) use ($user){
					if ($user->LanguageId == 1) {return ucwords($event->name_en);} return $event->name_ar; })
				->addColumn('type', function($event){ return ucwords($event->firm); })
				->editColumn('created_at', function($event){
					return '<span title="'.$event->created_at->format('l d-M-Y h:i A').'" data-original-title="'.$event->created_at->format('l d-M-Y h:i A').'" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" class="text-underline">'.humanDate($event->created_at).'</span>';
				})
				->addColumn('start', function($event){ return $event->issued_date.'  '.$event->time_start; })
				->editColumn('status', function($event){ return permitStatus($event->status); })
				->addColumn('action', function($event){
					$html  = '<div class="dropdown dropdown-inline">';
					$html  .= '	<button type="button" class="btn btn-secondary btn-elevate-hover btn-icon btn-sm btn-icon-md btn-circle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
					$html  .= '<i class="flaticon-more-1"></i>';
					$html  .= '	</button>';
					if ($event->status != 'cancelled' || $event->status != 'rejected') {
						$html  .= '		<div class="dropdown-menu dropdown-menu-right">';
						$html  .= '	<a class="dropdown-item" href="'.route('admin.event.show', $event->event_id).'"><i class="la la-calendar-check-o"></i>Event Details</a>';
						$html  .= '				<a class="dropdown-item" target="_blank" href="'.route('admin.event.download', $event->event_id).'"><i class="la la-download"></i>Download Permit</a>';
						$html  .= '				<div class="dropdown-divider"></div>';
						$html  .= '					<a href="javascript:void(0)" class="dropdown-item cancel-modal"><i class=" text-danger la la-minus-circle"></i> Cancel Permit</a>';
						$html  .= '					</div>';
					}

					$html  .= '					</div>';

					return $html;

					 })
					->rawColumns(['status', 'action', 'show', 'website', 'created_at', 'duration'])
					 ->make(true);
					$table = $table->getData(true);
					$table['new_count'] = Event::where('status', 'new')->count();
					$table['pending_count'] = Event::where('status', 'amended')->count();
					$table['cancelled_count'] = Event::where('status', 'cancelled')->count();
					return response()->json($table);
			}
		}

		public function addAppointment($data = null){

			$timeSlots = $this->SplitTime($this->roundTime(Carbon::now()->format('Y-m-d H:i:s'), 30), '04:00 PM', 60);
			$day = Carbon::now();

			$this->checkTimeAvailability($day, $timeSlots, $data);
		}

		private function checkTimeAvailability($day, $timeSlots, $permit){

			$today = Carbon::now()->format('Y-m-d');

			if ($day->format('Y-m-d') > $today){
				$timeSlots = $this->SplitTime('09:00 AM', '04:00 PM', 60);
			}

			if(count($timeSlots) > 0){
				foreach ($timeSlots as $time_key => $time) {

					$start = $day->format('Y-m-d') . ' ' . $time['start'];
					$end = $day->format('Y-m-d') . ' ' . $time['end'];

					//CHECK IF TIME IS IN HOLIDAY
					if($this->isTimeNotAvailable($start, $end)){
						//RESET LOOP TIME SLOT
					    $this->resetTimeSlot($time_key, $timeSlots, $day, $permit);
					    continue;
					}

					//GET INSPECTOR THAT IS AVAILABLE THE DATE
					if($this->availableInspector($start, $end)->count() == 0){
						//RESET LOOP TIME SLOT
						$this->resetTimeSlot($time_key, $timeSlots, $day, $permit);
					    continue;
					}

					//GET AVAILABLE INSPECTORS
					$inspectors = $this->availableInspector($start, $end)->withCount(['appointments' => function(Builder $query) use($day){
						$query->where('schedule_date_start', '>=', Carbon::parse($day->format('Y-m-d'))->startOfDay()->toDateTimeString())
						->where('schedule_date_end', '<=', Carbon::parse($day->format('Y-m-d'))->endOfDay()->toDateTimeString());
					}])->orderBy('appointments_count', 'ASC')->get();

					//CHECK PER INSPECTORS
					foreach ($inspectors as $inspector) {

						//CHECK APPOINTMENT DATE IF INSPECTOR IS WORKING
						if(!$this->isInspectorWorking($inspector, $start, $end)){
							continue;
						}
						
						//COUNT APPOINTMENTS TODAY
						$count = $this->countTodayAppointment($inspector, $day);

						//CHECK IF INSPECTOR HAS LESS THAN 3 APPOINTMENTS TODAY
						if($count < 3){

							echo $inspector->NameEn . ' - ' . '('. $start . ' - ' . $end . ')';
							
							//ADD APPOINTMENT TO INSPECTOR
							$this->saveAppointment($inspector, [
								'schedule_date_start' => $start,
								'schedule_date_end' => $end,
								'inspection_id' => $permit['id'],
								'type' => $permit['type'],
								'created_by' => Auth::user()->user_id
							]);

							//END THE LOOP
							break 2;
						}else{
							$this->resetTimeSlot($time_key, $timeSlots, $day, $permit);
					    	continue;
						}
					}
				}
			}else{
				//PROCEED TO NEXT DAY
				$day = $day->addDays(1);//ADD 1 DAY
		    	$this->checkTimeAvailability($day, $timeSlots, $permit);
			}
		}

		private function roundTime($timestamp, $precision = 30) {
		  	$timestamp = strtotime($timestamp);
		  	$precision = 60 * $precision;
		  	return date('h:i A', round($timestamp / $precision) * $precision);
		}

		private function saveAppointment($inspector, $data){
			try {
				$inspector->appointments()->create($data);
			} catch (\Exception $e) {
				
			}
		}

		private function countTodayAppointment($inspector, $today){
			return $inspector->appointments()->where('schedule_date_start', '>=', Carbon::parse($today->format('Y-m-d'))->startOfDay()->toDateTimeString())->where('schedule_date_end', '<=', Carbon::parse($today->format('Y-m-d'))->endOfDay()->toDateTimeString())->count();
		}

		private function resetTimeSlot($time_key, $timeSlots, $today, $permit){
			if ( $time_key == (count($timeSlots) - 1) ) {
		    	$today = $today->addDays(1);//ADD 1 DAY
		    	$this->checkTimeAvailability($today, $timeSlots, $permit);
		    }
		}

		private function isTimeNotAvailable($timeStart, $timeEnd){
			return Holiday::where('holiday_start', '<', $timeEnd)->where('holiday_end', '>', $timeStart)->exists();
		}

		private function SplitTime($StartTime, $EndTime, $Duration="60"){
		    $ReturnArray = array ();// Define output
		    $StartTime   = strtotime ($StartTime); //Get Timestamp
		    $EndTime     = strtotime ($EndTime); //Get Timestamp

		    $AddMins  = $Duration * 60;
		    $buffer = 30 * 60;

		    while ($StartTime <= $EndTime) //Run loop
		    {
		    	$StartTime += $buffer;
		    	$end = $StartTime + $AddMins;

		    	if($end <= $EndTime ){
		    		$ReturnArray[] = [
			        	'start' => date ("H:i:s", $StartTime),
			        	'end' => date("H:i:s", $end)
			        ];
		    	}
		        $StartTime += $AddMins; //Endtime check
		    }
		    return $ReturnArray;
		}

		private function availableInspector($startTime, $endTime){
			return User::whereDoesntHave('appointments', function(Builder $q) use($endTime, $startTime){
				$q->where('schedule_date_start', '<', $endTime)->where('schedule_date_end', '>', $startTime);
			})->whereDoesntHave('leave', function(Builder $q) use($endTime, $startTime){
				$q->where('leave_start', '<', $endTime)->where('leave_end', '>', $startTime);
			})->where('type', 4)->whereHas('roles', function(Builder $q){
				$q->where('roles.role_id', 4);
			});
		}

		private function isInspectorWorking($inspector, $startTime, $endTime){
			return $inspector->workschedule->getSchedule->getSchedule()->whereNull('is_dayoff')->where('day', Carbon::parse($startTime)->format('l'))->where('time_start', '<=', Carbon::parse($startTime)->format('H:i:s'))->where('time_end', '>=', Carbon::parse($endTime)->format('H:i:s'))->exists();
		}
	}
