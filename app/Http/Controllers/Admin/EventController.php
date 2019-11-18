<?php
	namespace App\Http\Controllers\Admin;

	use App\Notifications\EventNotification;
	use DB;
	use PDF;
	use Auth;
	use App\User;
	use Calendar;
	use App\Event;
	use App\EventType;
	use Carbon\Carbon;
	use App\Requirement;
	use App\GeneralSetting;
	use NumberToWords\NumberToWords;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use Yajra\DataTables\Facades\DataTables;

	class EventController extends Controller
	{
		public function index()
		{
			// $user = new User();
			// $user->email = 'rednianred@gmail.com';
			// dd($user);
			// $user->notify(new EventNotification());
			// $user->notify(new EventNotification());

			$event = Event::whereDate('expired_date', Carbon::now())->update(['status'=>'expired']);
			$types = EventType::all();
			$new_request = '';
			$pending_request = '';
			$active_request = '';
			return view('admin.event.index', [
				'page_title' => 'Event Permit', 
				'types'=>$types, 
				'new_request'=>Event::where('status', 'new')->count(),
				'pending_request'=>Event::where('status', 'amended')->count(),
				'active_request'=>Event::whereIn('status', ['amended', 'approved-unpaid', 'active', 'expired', 'rejected', 'need-approval'])->whereHas('comment',function($q){
					$q->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
				})->count(),
			]);
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
			
				$user = Auth::user();
				$request['user_id'] = $user->user_id;
				$request['checked_at'] = Carbon::now();
				$event->check()->where('event_id', $event->event_id)->delete();
				$event->check()->create($request->all());

				if($request->status == 'rejected'  || $request->status == 'need modification'){
					if($request->status == 'need modification'){
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
								$event->additionalRequirements()->attach($requirement->requirement_id);
							}
						}
					}
					$event->update(['status'=>$request->status]);
					$request['role_id'] = $user->roles()->first()->role_id;
					$request['type'] = 1;
					if ($request->comment) {$comment = $event->comment()->create($request->all());}
					if($request->status == 'need modification'){
						$request['status'] = 'send back for amendments';
					}
					$comment->approve()->create(array_merge($request->all(), ['event_id'=>$event->event_id]));
				}

				if ($request->status == 'approved-unpaid') {
					$comment = $event->comment()->create($request->all()); 
					$request['role_id'] = $user->roles()->first()->role_id;
					$request['type'] = $type = 1; 
					$comment->approve()->create(array_merge($request->all(), ['event_id'=>$event->event_id]));
					$event->update(['status'=>$request->status]);
				}

				if($request->status == 'need approval'){
					$request['role_id'] = $user->roles()->first()->role_id;
					$request['type']  = 0; 
					$comment = $event->comment()->create($request->all());
					$comment->approve()->create(array_merge ($request->all(), ['event_id'=>$comment->event_id ]));


					// $users = User::whereHas('roles', function($q){
					// 	$q->where('roles.role_id', 4);
					// })
					// ->whereDoesntHave('leave', function($q) use ($event){
					// 	$q->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
					// 	->whereDate('end_date', '<=', date('Y-m-d', strtotime($event->issued_date)));
					// })
					// // ->whereDoesntHave('approver', function($q){
					// // 	$q->count();//
					// // })
					// ->whereType(4)
					// // ->toSql();



					// dd($users);


					// $event->approval()->create();

					foreach ($request->approver as $role_id) {
						$request['role_id'] = $role_id;
						$request['status'] = 'pending';
						$request['user_id'] = null;
						$event->approve()->create($request->all());
					}
					$event->update(['status'=>'need approval']);
				}
		

				DB::commit();
				$result = ['success', ucfirst($event->name_en).' Successfully checked', 'Success'];
			} catch (Exception $e) {
				$result = ['error', $e->getMessage(), 'Error'];
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


			return view('admin.event.application', [
				 'page_title' => 'Event Application',
				 'event' => $event,
				 'existing_event' => $existing_event
			]);
		}

		public function show(Request $request, Event $event)
		{
			return view('admin.event.show', ['page_title' => '', 'event'=>$event, 'tab'=>$request->tab]);
		}

		public function uploadedRequiremet(Request $request, Event $event)
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


		public function applicationDatatable(Request $request, Event $event)
		{
			$event = $event->requirements()->get();
			$user = Auth::user();
			return DataTables::of($event)
				 ->addColumn('name', function($requirement) use ($user){
					 $name = $user->LanguageId == 1 ? $requirement->requirement_name : $requirement->requirement_name_ar;
					 // dd($requirement->event);
					 return '<a href="'.asset('/storage/'.$requirement->pivot->path).'"  data-fancybox data-caption="'.$name.'">'.$name.'</a>';
				 })
				 ->addColumn('issued_date', function($requirement){
				 	if($requirement->dates_required == 1){
				 		 return date('d-M-Y',strtotime($requirement->pivot->issued_date));
				 	}

					 return 'Not Required';
				 })
				 ->addColumn('expired_date', function($requirement){
					if($requirement->dates_required == 1){
				 		  return date('d-M-Y',strtotime($requirement->pivot->expired_date));
				 	}
					 return 'Not Required';
				 })
				 ->addColumn('files', function($event){

				 	return null;
				 })
				 ->rawColumns(['name', 'files'])
				 ->make(true);
//		}
		}

		public function dataTable(Request $request)
		{
			if ($request->ajax()) {
				$user = Auth::user();

				$events = Event::when($request->type, function($q) use ($request){
					$q->whereHas('owner', function($q) use ($request){
						$q->where('type', $request->type);
					});
				})
				->when($request->status, function($q) use ($request){
					$q->whereIn('status', $request->status);
				})
				->whereNotIn('status', ['draft', 'cancelled'])
				->orderBy('updated_at', 'desc')
				->get();

				return DataTables::of($events)
				->addColumn('establishment_name', function($event){
					return $event->owner->type != 2 ? $event->owner->company->company_name : null;
				})
				->addColumn('owner', function($event) use ($user){
					if ($user->LanguageId == 1) {
						return ucwords($event->owner->NameEn);
					}
					return $event->owner->NameAr;
				})
				->addColumn('event_name', function($event) use ($user){
					if ($user->LanguageId == 1) {return ucwords($event->name_en);} return $event->name_ar; })
				->addColumn('type', function($event){ return ucwords(userType($event->owner->type)); })
				->editColumn('created_at', function($event){ return $event->created_at->format('d-M-Y'); })
				->addColumn('start', function($event){ return $event->issued_date.'  '.$event->time_start; })
				->editColumn('status', function($event){ return permitStatus($event->status); })
				->addColumn('action', function($event){
					 	if($event->status == 'rejected'){ return null; }
					 	return '<a href="'.route('admin.event.download', $event->event_id).'" target="_blank" class="btn btn-download btn-sm btn-elevate btn-secondary"><i class="la la-download"></i> DOWNLOAD</a>';
					 })
					 ->rawColumns(['status', 'action'])
//				 ->setTotalRecords($totalRecords)s
					 ->make(true);
			}
		}
	}
