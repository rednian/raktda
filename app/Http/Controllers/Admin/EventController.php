<?php
	namespace App\Http\Controllers\Admin;

	use App\Notifications\EventNotification;
	use DB;
	use PDF;
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
	use App\ScheduleTypeDayTime;
	use App\EmployeeCustomSchedule;
	use Illuminate\Support\Facades\URL;
	use App\Notifications\AllNotification;
use COM;

class EventController extends Controller
	{
		public function __construct(){
			$this->middleware('signed')->except([
	            'cancel',
				'showWeb',
				'showAll',
				'calendar',
				'submit',
				'updateLock',
				'download',
				'uploadedRequirement',
				'addRequirementDatatable',
				'artistDatatable',
				'truckDatatable',
				'truckRequirementDatatable',
				'liquorRequirementDatatable',
				'applicationDatatable',
				'imageDatatable',
				'commentDatatable',
				'saveEventComment',
				'dataTable',
				'addAppointment',
				'checkTimeAvailability',
				'roundTime',
				'saveAppointment',
				'countTodayAppointment',
				'resetTimeSlot',
				'isTimeNotAvailable',
				'SplitTime',
				'availableInspector',
				'isInspectorWorking',
	        ]);
		}

		public function index(Request $request)
		{
		    $event = Event::whereIn('status', ['approved-unpaid', 'active'])->whereHas('comment',function($q){
					$q->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->limit(1);
				})->count();

			$view = $request->user()->roles()->whereIn('roles.role_id', [4, 5, 6])->exists() ? 'admin.event.inspection_index' : 'admin.event.index';


			return view($view, [
				'page_title' => __('Event Permit Dashboard'),
				'types'=> EventType::all(),
				'new_request'=>Event::whereIn('status', ['new'])->count(),
				'pending_request'=>Event::whereIn('status', ['checked', 'amended'])->count(),
				'active_request'=> $event,
				'cancelled_permit'=> Event::lastMonth(['cancelled'])->count(),
				'rejected_permit'=> Event::lastMonth(['rejected'])->count(),
				'approved_permit'=> Event::lastMonth(['approved-unpaid'])->count(),
				'processing'=> Event::whereIn('status', ['approved-unpaid', 'processing', 'need approval', 'need modification'])->count(),
				'active'=> Event::whereStatus('active')->count(),

			]);
		}


		public function cancel(Request $request, Event $event)
		{
			if ($event) {
			try {
				$request['role_id'] = $request->user()->roles()->first()->role_id;
				$request['user_id'] = $request->user()->user_id;

				$event->update([
					'cancel_reason'=> $request->comment ,
					'status'=>'cancelled',
					'cancel_date'=>Carbon::now(),
					'cancelled_by'=>$request->user_id,
					'role_id'=>$request->role_id,
                    'is_display_all'=> null,
                    'is_display_web'=> null
				]);
				$request['action'] = $request->status;
				$event->comment()->create($request->all());

				if($event->permit()->count() > 0){
					$event->permit->update(['permit_status'=>'cancelled', 'cancel_reason'=> $request->comment]);
					$event->permit->comment()->create($request->all());
				}
				$result = ['success',' ', 'Success'];

				//SEND NOTIFICATION TO COMPANY FOR PERMIT CANCELLATION BY ADMIN
		        $users = $event->owner->company->users;

		        $subject = $event->reference_number . ' - Application Cancelled';
				$title = 'Event Permit <b># ' . $event->reference_number . '</b> Application has been Approved';
				$content = 'Your application with the reference number <b>' . $event->reference_number . '</b> has been cancelled by the administrator. To view the details, please click the button below.';
				$url = URL::signedRoute('event.show', ['event' => $event->event_id, 'tab' => 'applied']);
				$buttonText = 'View Application';

		        foreach ($users as $user) {
					$user->notify(new AllNotification([
						'subject' => $subject,
						'title' => $title,
						'content' => $content,
						'button' => $buttonText,
                        'url' => $url,
                        'mail'=> ['']
					]));
                }

		        //END SEND NOTIFICATION COMPANY
			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
			}
			  return redirect()->back()->with('message',$result);
			}
		}



		public function showWeb(Request $request, Event $event)
		{
			try {
				$event->update(['is_display_web'=>$request->is_display_web]);
				$result = ['success','', 'Success'];
			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
			}
			 return response()->json(['message' => $result]);
		}



		public function showAll(Request $request, Event $event)
		{
			try {
				$event->update(['is_display_all'=>$request->is_display_all]);
				$result = ['success', '', 'Success'];
			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
			}
			 return response()->json(['message' => $result]);
		}


		public function calendar(Request $request)
		{
			$events = Event::whereNotNull('approved_by')->get();
			$events = $events->map(function($event) use ($request){
				return [
					'title'=> $request->user()->LanguageId == 1 ? ucfirst($event->name_en) : $event->name_ar,
					'start'=> date('Y-m-d', strtotime($event->issued_date)).' '.date('H:m', strtotime($event->time_start)),
					'end'=> date('Y-m-d', strtotime($event->expired_date)).' '.date('H:m', strtotime( $event->time_end)),
					'id'=>$event->event_id,
					'url'=> URL::signedRoute('admin.event.show', $event->event_id),
					'description'=> 'Venue : '.$venue = $request->user()->LanguageId == 1 ? $event->venue_en : $event->venue_ar,
					'backgroundColor'=> $event->type->color,
					'textColor' => '#fff !important',
					'businessHours'=> 	['start'=>date('H:m', strtotime($event->time_start)), 'end'=>date('H:m', strtotime( $event->time_end))]
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
				$request['role_id'] = $request->user()->roles()->first()->role_id;

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

						//SEND NOTIFICATION
                        $this->sendNotificationCompany($event, 'reject');

						$result = ['success', ucfirst($event->name_en).'Rejected Successfully', 'Success'];
                        break;

					case 'approved-unpaid':
					$request['approved_by']  =  $request->user()->user_id;
					$request['approved_date']  =  Carbon::now();
						$event->update([
							'status'=>$request->status,
							'note_en'=>$request->note_en,
							'note_ar'=>$request->note_ar,
							 'approved_by'=>$request->user()->user_id,
							 'approved_date'=> $request->approved_date
							]);
						$request['type'] = $type = 1;
						$event->comment()->create($request->all());

						//SEND NOTIFICATION
                        $this->sendNotificationCompany($event, 'approve');


						$result = ['success', ucfirst($event->name_en).' Approved Successfully', 'Success'];
						break;
					case 'need modification':

						$event->update(['status'=>$request->status]);
						$request['type'] = 1;
						$request['action'] = 'send back for amendments';
                        $event->comment()->create($request->all());

						if($request->requirements){
							foreach ($request->requirements as $requirement) {
                                if(!is_null($requirement['requirement_name'])){
                                    $event->additionalRequirements()->create($requirement);
                                }
							}
						}

                        //SEND NOTIFICATION
						$this->sendNotificationCompany($event, 'amend');

						$result = ['success', ucfirst($event->name_en).' has been checked successfully', 'Success'];
						break;
					case 'need approval':


						$event->update(['status'=>'need approval']);
						$request['type'] = 1;
						$comment = $event->comment()->create($request->all());

						//COMMENT INSPECTOR AND MANAGER
						if($request->has('approver')){
							if(!$request->has('inspection')){
								foreach ($request->approver as $role_id) {

									if($role_id == 6){
										if($request->has('department')){
											foreach ($request->department as $dep) {
												$event->comment()->create([
													'action' => 'pending',
													'role_id' => $role_id,
													'user_type' => 'admin',
													'type' => 0,
													'government_id' => $dep
												]);
											}
										}
									}else{
										$event->comment()->create([
											'action' => 'pending',
											'role_id' => $role_id,
											'user_type' => 'admin',
											'type' => 0
										]);
									}

									//SEND EMAIL NOTIFICATION
									$this->sendNotificationApproval($event, User::whereHas('roles', function($q) use($role_id){
										$q->where('roles.role_id', $role_id);
									})->when($role_id == 6, function($q) use($request){
										$q->whereIn('government_id', $request->department);
									})->get());
								}
							}else{
								if(in_array(5, $request->approver)){

									$event->comment()->create([
										'action' => 'pending',
										'role_id' => 5,
										'user_type' => 'admin',
										'type' => 0
									]);

									//SEND EMAIL NOTIFICATION
									$this->sendNotificationApproval($event, User::whereHas('roles', function($q){
										$q->where('roles.role_id', 5);
									})->get());
								}
							}
						}

						// if($request->has('inspection')){
						// 	//SAVE APPOINTMENT
						// 	$this->addAppointment([
						// 		'id' => $event->event_id,
						// 		'type' => 'event'
						// 	]);
						// }

						$result = ['success', ucfirst($event->name_en).' has been checked successfully', 'Success'];
						break;

				}


				DB::commit();

			} catch (Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
				DB::rollBack();
			}

			return redirect(URL::signedRoute('admin.event.index') . '#new-request')->with('message', $result);
		}

		private function sendNotificationCompany($event, $type){

			$buttonText = 'View Application';

			if($type == 'approve'){
				$subject = $event->reference_number . ' - Application Approved';
				$title = 'Application has been Approved';
				$content = 'Your application with the reference number <b>' . $event->reference_number . '</b> has been approved. To view the details, please click the button below.';
				$url = URL::signedRoute('event.show', ['event' => $event->event_id]);
                $buttonText = 'Make Payment';
                $sms_content = ['name'=>'event show', 'status'=> 'approved', 'reference_number'=>$event->reference_number,
                'url'=> URL::signedRoute('event.show', ['event' => $event->event_id]), 'payment'=>true];
			}

			if($type == 'amend'){
				$subject = $event->reference_number . ' - Application Requires Amendment';
				$title = 'Applications Requires Amendment';
				$content = 'Your application with the reference number <b>' . $event->reference_number . '</b> has been bounced back for amendment. To view the details, please click the button below.';
                $url = URL::signedRoute('event.show', ['event' => $event->event_id]);

                $sms_content = ['name'=>'event permit', 'status'=> 'bounced back for amendment', 'reference_number'=>$event->reference_number,
                'url'=> URL::signedRoute('event.show', ['event' => $event->event_id])];
			}

			if($type == 'reject'){
				$subject = $event->reference_number . ' - Application Rejected';
				$title = 'Application has been Rejected';
				$content = 'Your application with the reference number <b>' . $event->reference_number . '</b> has been rejected. To view the details, please click the button below.';
                $url = URL::signedRoute('event.show', ['event' => $event->event_id, 'tab' => 'applied']);

                $sms_content = ['name'=>'event permit', 'status'=> 'rejected', 'reference_number'=>$event->reference_number,
                'url'=> URL::signedRoute('event.show', ['event' => $event->event_id, 'tab' => 'applied'])];
			}

			$users = $event->owner->company->users;

			foreach ($users as $user) {
				$user->notify(new AllNotification([
					'subject' => $subject,
					'title' => $title,
					'content' => $content,
					'button' => $buttonText,
                    'url' => $url,
                    'mail'=>true
                ]));
            sms($user->number, $sms_content);
			}
		}

		private function sendNotificationApproval($event, $users){

			$subject = 'Event Permit For Approval';
			$title = 'Event Permit For Approval';
			$content = 'The event permit with reference number <b>' . $event->reference_number . '</b> needs to have an approval from your department. Please click the link below.';
			$url = URL::signedRoute('admin.event.show', $event->event_id);

			foreach ($users as $user) {
				$user->notify(new AllNotification([
					'subject' => $subject,
					'title' => $title,
					'content' => $content,
					'button' => 'View Permit',
                    'url' => $url,
                    'mail'=>true
				]));
			}
		}

		private function sendNotificationChecked($event, $users, $checked_by){

			$subject = 'Event Permit Has Been Checked';
			$title = 'Event Permit Has Been Checked';
			$content = 'The event permit with reference number <b>' . $event->reference_number . '</b> has been checked by '. $checked_by->NameEn .'.';
			$url = URL::signedRoute('admin.event.show', $event->event_id);

			if($event->comment()->where('action', 'pending')->whereNull('user_id')->count() == 0){
                $url = URL::signedRoute('admin.event.application', $event->event_id);
            }

			foreach ($users as $user) {
				$user->notify(new AllNotification([
					'subject' => $subject,
					'title' => $title,
					'content' => $content,
					'button' => 'View Permit',
                    'url' => $url,
                    'mail'=>true
				]));
			}
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

			if($event->liquor()->exists()){
			    $data['liquor'] = $event->liquor;
			}
			if($event->truck()->exists()){
			    $data['truck'] = $event->truck()->get();
			}

			$pdf = PDF::loadView('permits.event.print', $data, [], [
			    'title' => 'Event Permit',
                'default_font_size' => 10,
                'show_watermark'=> in_array($event->status , ['cancelled', 'expired']) ? true : false,
                'watermark'      => ucfirst($event->status),
			]);

			if($event->truck()->exists()){
				$pdf->getMpdf()->AddPage();
				$pdf->getMpdf()->WriteHTML(\View::make('permits.event.truckprint')->with($data)->render());
			}

			if($event->liquor()->exists()){
				if($event->liquor->provided != null || $event->liquor->provided != 1)
				{
				    $pdf->getMpdf()->AddPage();
				    $pdf->getMpdf()->WriteHTML(\View::make('permits.event.liquorprint')->with($data)->render());
				}
			}

			// $pdf = PDF::loadView('permits.event.print', $data, [], [
			//     'title' => 'Event Permit',
			//     'default_font_size' => 10
			// ]);
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
				 'page_title' => __('Processing Permit'),
				 'event' => $event,
				 'existing_event' => $existing_event,
				 'requirements' =>$requirements
			]);
		}

		public function show(Request $request, Event $event)
		{
			$name = $request->user()->LanguageId === 1 ? ucfirst($event->name_en) : $event->name_ar;
			return view('admin.event.show', ['page_title' => $name.' - '.__('Detail'), 'event'=>$event, 'tab'=>$request->tab]);
		}

		public function uploadedRequirement(Request $request, Event $event)
		{
			$requirements = Requirement::whereHas('eventRequirement', function($q) use ($event){
				return $q->where('event_id', $event->event_id);
			})->orderBy('requirement_name');


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


		public function artistDatatable(Request $request, Event $event)
		{

			if (!is_null($event->permit)) {
				$permit = $event->permit->artistPermit()->get();
			}
			else{
				$permit = [];
			}

			return DataTables::of($permit)
			->addColumn('name', function($artist) use ($request){
				$fname = $request->user()->LanguageId == 1 ? ucfirst($artist->firstname_en) : $artist->firstname_ar;
				$lastname = $request->user()->LanguageId == 1 ? ucfirst($artist->lastname_en) : $artist->lastname_ar;
				return profileName($fname.' '.$lastname, $artist->artist->artist_status);
			})
			->addColumn('profession', function($artist) use ($request){
				return $request->user()->LanguageId == 1 ? ucfirst($artist->profession->name_en) : $artist->profession->name_ar;
			})
			->addColumn('person_code', function($artist){
				return $artist->artist->person_code;
			})
			->editColumn('birthdate', function($artist){
				return $artist->birthdate->format('d-F-Y');
			})
			->addColumn('age', function($artist){
				return $artist->birthdate->age;
			})
			->editColumn('mobile_number', function($artist){
				return $artist->mobile_number;
			})
			->rawColumns(['name'])
			->make(true);

		}


		public function truckDatatable(Request $request, Event $event)
		{
			return DataTables::of($event->truck()->get())
			->addColumn('name', function($truck) use ($request){
				return $request->user()->LanguageId == 1 ?  ucfirst($truck->company_name_en) : $truck->company_name_ar;
			})
			->addColumn('type', function($truck) use ($request){
				return $request->user()->LanguageId == 1 ? $truck->food_type : $truck->food_type;
			})
			->addColumn('issued_date', function($truck){
				return date('d-F-Y', strtotime($truck->registration_issued_date));
			})
			->addColumn('expired_date', function($truck){
				return date('d-F-Y', strtotime($truck->registration_expired_date));
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
            // dd($event->requirements()->get());
			$requirements = DataTables::of($event->eventRequirement)
			->addColumn('name', function($requirement) use ($request){
                if($requirement->type == 'event'){
                    return $requirement->requirement->requirement_name;
                }
                if($requirement->type == 'additional'){
                    return $requirement->additionalRequirement->requirement_name;
                    // return $requirement->additionalRequirement->requirement_name;
                }
			})
			->addColumn('issued_date', function($requirement){
				 return $requirement->dates_required == 1 ? date('d-M-Y',strtotime($requirement->eventRequirement()->first()->issued_date)) : 'Not Required';
			})
			->addColumn('expired_date', function($requirement){
				 return $requirement->dates_required == 1 ? date('d-M-Y',strtotime($requirement->eventRequirement()->first()->expired_date)) : 'Not Required';
			})
			->addColumn('files', function($requirement) use ($request){
                if($requirement->type == 'event'){
                    $name = $requirement->requirement->requirement_name;
                }
                if($requirement->type == 'additional'){
                    if($requirement->type == 'event'){
                        $name = $requirement->requirement->requirement_name;
                    }
                    if($requirement->type == 'additional'){
                        $name = $requirement->additionalRequirement->requirement_name;
                    }
                }
				return '<a class="kt-padding-l-20" href="'.asset('/storage/'.$requirement->path).'" data-fancybox="gallery"  data-fancybox data-caption="'.$name.'">'.strtolower($name).'.'.fileName($requirement->path).'</a>';
			})
			->rawColumns(['files', 'name'])
			->make(true);

			$data = $requirements->getData(true);
				if ($event->logo_thumbnail) {
				$data['data'][] = [
				    'name' => 'Event Logo',
				    'files' => '<a class="kt-padding-l-20" href="'.asset('/storage/'.$event->logo_thumbnail).'" data-fancybox data-caption="Event Logo">event logo.'.fileName($event->logo_thumbnail).'</a>',
				    'issued_date'=> 'Not Required',
				    'expired_date'=> 'Not Required',
				];
				}

				 return response()->json($data);

			return $requirements;
		}

		public function imageDatatable(Request $request, Event $event)
		{
			return DataTables::of($event->otherUpload()->get())
			->editColumn('path', function($image){

				$html = '<a href="'.asset('/storage/'.$image->path).'" data-type="image" data-type="ajax" data-fancybox>';
				$html .= '<img  src="'.asset('storage/'.$image->thumbnail).'" class="img img-responsive img-thumbnail center-block" style="width: 60px;">';
				$html .= '</a>';
				return $html;
			})
			->editColumn('size', function($image){
				return $image->size;
			})
			->editColumn('description', function($image){
				return $image->size;
			})
			->rawColumns(['path'])
			->make(true);
		}

		public function commentDatatable(Request $request, Event $event)
		{
			if ($request->ajax()) {
				$comments = $event->comment()->where('action', '!=' ,'pending')->latest();

				return DataTables::of($comments)
				->addColumn('name', function($comment) use($request){
					$role_name = $comment->role->NameEn;
					if(!is_null($comment->government_id)){
						$role_name = $request->LanguageId == 1 ? $comment->government->government_name_en : $comment->government->government_name_ar;
					}

					if(is_null($comment->user_id)){
						return profileName($role_name, '');
					}

					return profileName($comment->user->NameEn, $role_name);
				})
				->editColumn('comment', function($comment){
					$c = ucfirst($comment->comment);
					if($comment->exempt_payment){
                      $c .= '<br><span class="kt-badge kt-badge--warning kt-badge--inline">' . __('Exempted for Payment') . '</span>';
					}
                    return $c;
				})
				->addColumn('date', function($comment){
					return '<span class="text-underline" title="'.$comment->created_at->format('l h:i A |d-F-Y').'">'.humanDate($comment->created_at).'</span>';
					return ;
				})
				->addColumn('action_taken', function($comment){
					return permitStatus(ucwords($comment->action));
				})
				->rawColumns(['name', 'date', 'comment', 'action_taken'])
				->make(true);
			}
		}

		public function saveEventComment(Event $event, Request $request){
			DB::beginTransaction();
			try {
				$comment = $event->comment()->where([
		            'action' => 'pending',
		            'role_id' => $request->user()->roles()->first()->role_id,
		        ])->latest()->first();

		        if(!is_null($request->user()->government_id)){
		            $comment = $event->comment()->where([
		                'action' => 'pending',
		                'role_id' => $request->user()->roles()->first()->role_id,
		                'government_id' => $request->user()->government_id
		            ])->latest()->first();
		        }

				$comment->update([
          			'action' => $request->action,
          			'comment' => $request->comment,
          			'comment_ar' => $request->comment_ar,
          			'user_id' => $request->user()->user_id
          		]);

				// CHECK IF EXEMPTED FOR PAYMENT
          		if($request->has('bypass_payment')){
                  $comment->exempt_payment = 1;
                  $comment->save();

                  $event->exempt_payment = 1;
                  $event->exempt_by = $request->user()->user_id;
                  $event->exempt_percentage = $request->exempt_percentage;
                  $event->save();
              	}

          		//CHECK IF I AM THE LAST APPROVER
                if($event->comment()->where('action', 'pending')->whereNull('user_id')->count() == 0){
                    $event->update(['status'=>'checked']);
                }

                //SEND NOTIFICATIONS TO ALL ADMIN
                $this->sendNotificationChecked($event, User::whereHas('roles', function($q){
					$q->where('roles.role_id', 1);
				})->get(), $request->user());

          		$result = ['success', ucfirst($event->name_en).' has been checked successfully', 'Success'];
          		DB::commit();

			} catch (\Exception $e) {
				$result = ['danger', $e->getMessage(), 'Error'];
				DB::rollBack();
			}
			return redirect(URL::signedRoute('admin.event.index'))->with('message',$result);
		}

		public function dataTable(Request $request)
		{
			if ($request->ajax()) {

				$user = Auth::user();

				$events = Event::when($request->type, function($q) use ($request){
					$q->where('firm', $request->type);
				})
				->when($request->event_type_id, function($q) use ($request){
					$q->where('event_type_id', $request->event_type_id);
				})
				->when($request->status, function($q) use ($request){
					$q->whereIn('status', $request->status);
				})
				->when($request->event_type_sub_id, function($q) use ($request){
					$q->where('event_type_sub_id', $request->event_type_sub_id);
				})
				->when($request->approval, function($q) use($request){
					$q->whereHas('comment', function($q1) use($request){
			          	$q1->where('action', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->when($request->gov, function($q) use($request){
			          		$q->where('government_id', $request->user()->government_id);
			          	});
			        });
				})
				->when($request->checked, function($q) use($request){
					$q->whereHas('comment', function($q) use($request){
						$q->where('action', '!=', 'pending')->where('role_id', $request->user()->roles()->first()->role_id)->whereNotNull('user_id')->when($request->gov, function($q) use($request){
			          		$q->where('government_id', $request->user()->government_id);
			          	});;
					});
				})
				->whereNotIn('status', ['draft'])
				->get();


				return DataTables::of($events)
                    ->addColumn('establishment_name', function($event) use ($user){
                        return $user->LanguageId != 2 ? ucfirst($event->owner->company->name_en) : ucfirst($event->owner->company->name_ar);
                    })
                    ->addColumn('duration', function($event) use ($user){
                        $date = Carbon::parse($event->expired_date)->diffInDays($event->issued_date);
                        $date = $date !=  0 ? $date : 1;
                        $day = $date > 1 ? ' Days': ' Day';
                        return $date.$day;
                        return Carbon::parse($event->issued_date)->diffInDays($event->expired_date);
                    })
                    ->addColumn('expected_audience', function($event){ return $event->audience_number; })
                    ->addColumn('owner',function($event) use ($request){
                        return $request->user()->LanguageId == 1 ? ucfirst($event->owner_name) : $event->owner_name_ar;
                    })
                    ->editColumn('approved_date', function($event){
                        if ($event->approved_by) {
                            return '<span class="text-underline" title="'.$event->approved_date->format('l h:i A | d-F-Y').'">'.humanDate($event->approved_date).'</span>';
                        }
                        return null;
                    })
                    ->editColumn('approved_by', function($event) use ($user){
                        return $user->LanguageId == 1 ? ucwords($event->approved->NameEn) : ucwords($event->approved->NameAr);
                    })
                    ->addColumn('has_liquor', function($event){ return $event->liquor()->exists() ? __('YES') : __('NO'); })
                    ->addColumn('has_truck', function($event){ return $event->truck()->exists() ? __('YES') : __('NO'); })
                    ->addColumn('has_artist', function($event){ return $event->permit()->exists() ? __('YES') : __('NO'); })
                    ->addColumn('location',function($event) use ($request){
                        return ucfirst($event->address);
                    })
                    ->editColumn('request_type', function($event){

                        return ucwords(requestType($event->request_type));
                    })
                    ->addColumn('description',function($event) use ($user){
                        return ucfirst($event->description);
                    })
                    ->addColumn('website', function($event){
                        return $event->is_display_web ? __('YES'): __('NO');
                    })
                    ->addColumn('event_type', function($event) use ($request){

                        $sub = !empty($event->subtype->subname) ? $event->subtype->subname : '-';
                        return type($event->type->name, $sub);
                    })
                    ->addColumn('venue', function($event) use ($user){
                        return ucfirst($event->venue);
                    })
                    ->addColumn('show', function($event){
					$display = $event->is_display_all ? __('YES'): __('NO');
                    })
                    ->addColumn('event_name', function($event) use ($user){ return ucfirst($event->name); })
                    ->addColumn('type', function($event){return ucwords(__($event->firm)); })
                    ->editColumn('updated_at', function($event){
                        return '<span title="'.$event->updated_at->format('l d-F-Y h:i A').'" data-original-title="'.$event->updated_at->format('l d-F-Y h:i A').'" data-toggle="kt-tooltip" data-skin="brand" data-placement="top" class="text-underline">'.humanDate($event->updated_at).'</span>';
                    })
                    ->addColumn('start', function($event){ return date('d-F-Y', strtotime($event->issued_date)); })
                    ->addColumn('end', function($event){ return date('d-F-Y', strtotime($event->expired_date)); })
                    ->addColumn('time', function($event){ return $event->time_start.' - '.$event->time_end; })
                    ->editColumn('status', function($event){ return permitStatus($event->status); })
                    ->addColumn('action', function($event){
                        if (in_array($event->status, ['active', 'cancelled', 'expired'])) {
						return '<a class="btn btn-sm btn-secondary btn-download" target="_blank" href="'. URL::signedRoute('admin.event.download', $event->event_id).'"><i class="la la-download"></i>'.__('DOWNLOAD').'</a>';
                        }
                        return '-';
                    })
                    ->addColumn('application_link', function($event){
                        return URL::signedRoute('admin.event.application', $event->event_id);
                    })
                    ->addColumn('show_link', function($event){
                        return URL::signedRoute('admin.event.show', $event->event_id);
                    })
                    ->addColumn('checked_date', function($event) use($user){
                        if($event->comment()->where('action', '!=', 'pending')->where('role_id', $user->roles()->first()->role_id)->latest()->first()){
                            return $event->comment()->where('action', '!=', 'pending')->where('role_id', $user->roles()->first()->role_id)->latest()->first()->updated_at;
                        }
                        return '';
                    })
                    ->addColumn('checked_by', function($event) use($user){
                        if($event->comment()->where('action', '!=', 'pending')->where('role_id', $user->roles()->first()->role_id)->latest()->first()){
                            if(!is_null($event->comment()->where('action', '!=', 'pending')->where('role_id', $user->roles()->first()->role_id)->latest()->first()->user)){
                                return $event->comment()->where('action', '!=', 'pending')->where('role_id', $user->roles()->first()->role_id)->latest()->first()->user->NameEn;
                            }
                        }
                        return '';
                    })
                    ->addColumn('checked_status', function($event) use($user){
                        if($event->comment()->where('action', '!=', 'pending')->where('role_id', $user->roles()->first()->role_id)->latest()->first()){
                            if(!is_null($event->comment)){
                                $status = $event->comment()->where('action', '!=', 'pending')->where('role_id', $user->roles()->first()->role_id)->latest()->first()->action;
                                return permitStatus($status);
                            }
                        }
                        return '';
                    })
                    ->with('pending_count', function(){
                        return Event::whereIn('status', ['checked', 'amended'])->count();
                    })
                    ->with('new_count', function(){
                        return Event::whereIn('status', ['new'])->count();
                    })
                    ->with('cancelled_count', function(){
                        return Event::where('status', 'cancelled')->count();
                    })
                    ->with('processing', function(){
                        return Event::whereIn('status', ['approved-unpaid', 'processing', 'need approval', 'need modification'])->count();
                    })
                    ->rawColumns(['status', 'action', 'show', 'website', 'updated_at', 'duration', 'checked_status', 'event_type', 'approved_date', 'request_type'])
                    ->make(true);
			}
		}

		public function addAppointment($data = null){

			// $timeSlots = $this->SplitTime($this->roundTime(Carbon::now()->format('Y-m-d H:i:s'), 30), '05:00 PM', 60);
			$timeSlots = $this->SplitTime('09:00 AM', '05:00 PM', 60);
			// $day = Carbon::now();
			$day = Carbon::now()->addDays(1);
			$this->checkTimeAvailability($day, $timeSlots, $data);

		}

		private function checkTimeAvailability($day, $timeSlots, $permit){

			// $today = Carbon::now()->format('Y-m-d');
			$today = Carbon::now()->addDays(1)->format('Y-m-d');

			if ($day->format('Y-m-d') > $today){
				$timeSlots = $this->SplitTime('09:00 AM', '05:00 PM', 60);
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
					$inspectors = $this->availableInspector($start, $end)
					->withCount('appointments')
					// ->withCount(['appointments' => function(Builder $query) use($day){
					// 	$query->where('schedule_date_start', '>=', Carbon::parse($day->format('Y-m-d'))->startOfDay()->toDateTimeString())
					// 	->where('schedule_date_end', '<=', Carbon::parse($day->format('Y-m-d'))->endOfDay()->toDateTimeString());
					// }])
					->orderBy('appointments_count', 'ASC')->get();

					//CHECK PER INSPECTORS
					foreach ($inspectors as $keyInspector => $inspector) {

						//CHECK APPOINTMENT DATE IF INSPECTOR IS WORKING
						if(!$this->isInspectorWorking($inspector, $start, $end)){

							if ( $time_key == (count($timeSlots) - 1) && (count($inspectors)-1) == $keyInspector) {

						    	$day = $day->addDays(1);//ADD 1 DAY
		    					$this->checkTimeAvailability($day, $timeSlots, $permit);
						    }
						}

						//COUNT APPOINTMENTS TODAY
						$count = $this->countTodayAppointment($inspector, $day);

						//CHECK IF INSPECTOR HAS LESS THAN 3 APPOINTMENTS TODAY
						if($count < 3){

							//ADD APPOINTMENT TO INSPECTOR
							$this->saveAppointment($inspector, [
								'schedule_date_start' => $start,
								'schedule_date_end' => $end,
								'inspection_id' => $permit['id'],
								'type' => $permit['type'],
								'created_by' => Auth::user()->user_id,
								'approval_status' => 'new'
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

		// public function isTimeAvailable($type, $startTime, $endTime){
		// 	if($type == 'system'){
		// 		return ScheduleTypeDayTime::whereNull('is_dayoff')->where('day', Carbon::parse($startTime)->format('l'))->where('time_start', '<=', Carbon::parse($startTime)->format('H:i:s'))->where('time_end', '>=', Carbon::parse($endTime)->format('H:i:s'))->exists();
		// 	}

		// }
	}
