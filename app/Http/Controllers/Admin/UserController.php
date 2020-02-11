<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\ScheduleType;
use App\EmployeeCustomWorkSchedule;
use App\EmployeeLeave;
use App\Holiday;
use App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\URL;
use Hash;

class UserController extends Controller
{

	public function __construct(){
		$this->middleware('signed')->except([
			'updateLanguage',
			'datatable',
			'store',
			'updateUSer',
			'getSchedule',
			'setScheduleActive',
			'saveCustomSchedule',
			'updateCustomSchedule',
			'deleteCustomSchedule',
            'saveLeave',
            'getLeaves',
            'updateLeave',
            'deleteLeave',
            'getHoliday',
            'saveHoliday',
            'updateHoliday',
            'deleteHoliday',
            'getNotifications',
            'getNotificationsDatatable',
            'updateAsReadNotification'
		]);
	}

    public function updateLanguage(Request $request)
    {
        $user = User::find(Auth::user()->user_id)->update(['LanguageId' => $request->lang]);
        if ($user) return response()->json(['success' => true]);
    }

    public function index(){
    	return view('admin.user_management.index', ['page_title'=> 'Employee Management']);
    }

    public function create(Request $request){
    	return view('admin.user_management.create', ['page_title'=> 'Add New Employee', 'type' => $request->t]);
    }

    public function store(Request $request){
        // dd($request->all());
    	DB::beginTransaction();
    	try {
    		$active_sched = ScheduleType::where('is_active', 1)->first();
    		$user = User::create( array_merge($request->except(['password']), ['password' => bcrypt($request->password), 'type' => 4, 'IsActive' => 1, 'CreatedBy' => $request->user()->user_id ]) );

    		//SELECT SCHEDULE
    		$user->workschedule()->create([
    			'schedule_type_id' => $active_sched->schedule_type_id
    		]);

    		//ADD USER ROLE
    		$user->roles()->sync([ $request->role_id => [ 'IsActive' => 1] ]);

    		DB::commit();
    		$result = ['success', 'Employee has been added successfully.', 'Success'];

    		if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('user_management.index'))->with('message', $result);
            }
    	} catch (\Exception $e) {
    		DB::rollBack();
    		$result = ['error', $e->getMessage(), 'Error'];
    	}
    	return redirect()->back()->with('message',$result);
    }

    public function datatable(Request $request){

        // dd($request->all());

    	$data = User::when($request->government, function($q){
            return $q->whereNotNull('government_id');
        })->when($request->employee, function($q){
            return $q->whereNull('government_id');
        })->whereHas('roles', function($q){
    		$q->where('Type', 0);
    	});

    	return Datatables::of($data)->addColumn('name', function($user) use($request){
    		return $request->user()->LanguageId == 1 ? $user->NameEn : $user->NameAr;
    	})->addColumn('role', function($user){
    		return ucwords($user->roles()->first()->NameEn);
    	})->editColumn('CreatedAt', function($user){
    		return $user->CreatedAt->format('Y-m-d');
    	})->addColumn('actions', function($user){
    		return '<button data-url="' . URL::signedRoute('user_management.details', ['user' => $user->user_id ]) . '" class="btn btn-secondary btn-sm btn-elevate btn-edit">' . __('Details') . '</button>';
    	})->addColumn('show_url', function($user){
    		return URL::signedRoute('user_management.details', ['user' => $user->user_id ]);
    	})->addColumn('status', function($user){
    		return  $user->IsActive == 1 ? 'Active' : 'Inactive';
    	})->addColumn('department', function($user) use($request){
            if(!is_null($user->government_id)){
                return $request->user()->language_id == 1 ? $user->governmentDepartment->government_name_en : $user->governmentDepartment->government_name_ar;
            }
            return '';
        })->rawColumns(['actions'])->make(true);
    }

    public function showUser(User $user, Request $request){
    	//dd($user->workschedule);
    	return view('admin.user_management.show', ['page_title'=> $user->NameEn, 'user' => $user]);
    }

    public function updateUSer(Request $request, User $user){

    	try {
    		if($request->has('change_password')){
                if(!Hash::check($request->admin_password, $request->user()->password)){
                    $result = ['error', 'The password you have entered was incorrect.', 'Error'];
                    return redirect()->back()->with('message', $result);
                }
            }
            DB::beginTransaction();

            $status = $request->has('IsActive') ? 1 : 0;
    		$user->update(array_merge( $request->except(['password', 'IsActive']), ['password' => bcrypt($request->new_password), 'IsActive' => $status]) );

            $user->roles()->sync([ $request->role_id => [ 'IsActive' => $status]]);

    		DB::commit();
    		$result = ['success', 'Employee has been saved successfully.', 'Success'];

    	} catch (\Exception $e) {
    		DB::rollBack();
    		$result = ['error', $e->getMessage(), 'Error'];
    	}
    	return redirect()->back()->with('message',$result);
    }

    public function getSchedule(Request $request){

    	// dd($request->all());
    	$user = User::findOrFail($request->user_id);

    	if($request->type == 'system'){
    		$type = ScheduleType::find($request->id);
    	}else{
    		$type = $user->customSchedules()->where('emp_custom_id', $request->id)->first();
    	}

    	return view('admin.user_management.partial.schedules', ['sched' => $type, 'type' => $request->type, 'user' => $user, 'empSched' => $user->workschedule ]);
    }

    public function setScheduleActive(Request $request){
    	$user = User::findOrFail($request->user_id);

    	if($request->type == 'system'){
    		$data = [
    			'schedule_type_id' => $request->id,
    			'is_custom' => null,
    			'emp_custom_id' => null
    		];
    	}else{
    		$data = [
    			'emp_custom_id' => $request->id,
    			'is_custom' => 1,
    			'schedule_type_id' => null
    		];
    	}

    	try {
    		if(!is_null($user->workschedule)){
    			$user->workschedule->update($data);
    		}else{
    			$user->workschedule()->create($data);
    		}

    		$result = ['success', 'Schedule Type has been set to active.', 'Success'];

    	} catch (\Exception $e) {
    		$result = ['error', $e->getMessage(), 'Error'];
    	}

    	return redirect(URL::signedRoute('user_management.details', ['user' => $request->user_id]) . '#work_schedule')->with('message', $result);

    }

    public function addCustomSchedule(User $user, Request $request){
    	return view('admin.user_management.schedule.create', ['page_title' => 'Add New Custom Schedule', 'user' => $user]);
    }

    public function saveCustomSchedule(Request $request, User $user){

    	// dd($request->all());

    	DB::beginTransaction();
        try {
            $custom = $user->customSchedules()->create($request->all());

            //ADD SCHEDULES
            $day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            foreach ($request->day as $key => $day_sched) {
                $custom->getSchedule()->create( array_merge([ 'day' => $day[$key] ], $day_sched) );
            }

            //IF SET TO ACTIVE
            if($request->has('is_active')){
            	$user->workschedule->update([
            		'is_custom' => 1,
            		'emp_custom_id' => $custom->emp_custom_id,
            		'schedule_type_id' => null
            	]);
            }

            DB::commit();
            $result = ['success', 'Schedule Type has been added successfully.', 'Success'];

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#work_schedule')->with('message', $result);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect()->back()->with('message',$result);
    }

    public function editCustomSchedule(Request $request, User $user, EmployeeCustomWorkSchedule $custom){
    	return view('admin.user_management.schedule.edit', ['page_title' => 'Add New Custom Schedule', 'user' => $user, 'custom' => $custom]);
    }

    public function updateCustomSchedule(Request $request, User $user, EmployeeCustomWorkSchedule $custom){
    	DB::beginTransaction();
        try {
            $custom->update($request->all());

            //ADD SCHEDULES
            foreach ($request->day as $key => $day_sched) {
                $is_off = !array_key_exists('is_dayoff', $day_sched) ? ['is_dayoff' => null] : ['time_start' => null, 'time_end' => null];
                $custom->getSchedule()->where('custom_id', $key)->update( array_merge($is_off, $day_sched) );
            }

            //IF SET TO ACTIVE
            if($request->has('is_active')){
            	$user->workschedule->update([
            		'is_custom' => 1,
            		'emp_custom_id' => $custom->emp_custom_id,
            		'schedule_type_id' => null
            	]);
            }

            DB::commit();
            $result = ['success', 'Schedule Type has been saved successfully.', 'Success'];

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#work_schedule')->with('message', $result);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect()->back()->with('message',$result);
    }


    public function deleteCustomSchedule(User $user, EmployeeCustomWorkSchedule $custom, Request $request)
    {
    	DB::beginTransaction();
        try {
            $custom->delete();

            DB::commit();
            $result = ['success', 'Schedule Type has been deleted successfully.', 'Success'];
        } catch (\Exception $e) {
        	DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#work_schedule')->with('message', $result);
    }

    //LEAVE SCRIPTS
    public function addLeave(User $user, Request $request){
        return view('admin.user_management.leave.create', ['page_title' => 'Add Leave', 'user' => $user ]);
    }

    public function saveLeave(User $user, Request $request){
        try {
            $dates = [
                'leave_start' => date('Y-m-d H:i:s', strtotime($request->leave_start)),
                'leave_end' => date('Y-m-d H:i:s', strtotime($request->leave_end))
            ];

            $data = array_merge( $request->except(['leave_start', 'leave_end']), $dates );

            if(!is_null($user->user_id)){
                $user->leave()->create($data);
            }else{
                EmployeeLeave::create($data);
            }
            $result = ['success', 'Leave has been saved successfully.', 'Success'];

            if($request->submit_type == 'continue'){

                if(!is_null($user->user_id)){
                    return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#leave')->with('message', $result);
                }

                return redirect(URL::signedRoute('user_management.index') . '#leave')->with('message', $result);
            }
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }

    public function getLeaves(User $user, Request $request){

        // dd($request->all());

        $colors = [
            '#5867dd',
            '#0abb87',
            '#ffb822',
            '#fd397a',
            '#282a3c',
            '#9c27b0',
        ];

        $leaves = EmployeeLeave::when($user->user_id, function($q) use($user){
            $q->where('user_id', $user->user_id);
        })->orderBy('leave_start')->get();

        $leaves = $leaves->map(function($leave) use ($request, $colors, $user){
            return [
                'title'=> ($request->user()->LanguageId == 1 ? $leave->getLeaveType->leave_type_name : $leave->getLeaveType->leave_type_name_ar) . ' - ' . ($request->user()->LanguageId == 1 ? $leave->getUser->NameEn : $leave->getUser->NameAr),
                'start'=> $leave->leave_start,
                'end'=> $leave->leave_end,
                'id'=> $leave->employee_leave_id,
                'url'=> URL::signedRoute('user_management.leave.show', ['leave' => $leave->employee_leave_id, 'user' => $user->user_id]),
                'description'=> 'Remarks: ' . $leave->remarks,
                'backgroundColor'=> $colors[array_rand($colors)],
                'textColor' => '#fff !important',
            ];
        });

        return response()->json($leaves);
    }

    public function showLeave(EmployeeLeave $leave, User $user, Request $request){
        return view('admin.user_management.leave.show', ['page_title' => 'Edit Leave', 'user' => $user, 'leave' => $leave]);
    }

    public function updateLeave(EmployeeLeave $leave, User $user, Request $request){
        try {
            $dates = [
                'leave_start' => date('Y-m-d H:i:s', strtotime($request->leave_start)),
                'leave_end' => date('Y-m-d H:i:s', strtotime($request->leave_end))
            ];
            $data = array_merge( $request->except(['leave_start', 'leave_end']), $dates );
            $leave->update($data);

            $result = ['success', 'Leave has been saved successfully.', 'Success'];

            if($request->submit_type == 'continue'){

                if(!is_null($user->user_id)){
                    return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#leave')->with('message', $result);
                }

                return redirect(URL::signedRoute('user_management.index') . '#leave')->with('message', $result);
            }
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }

    public function deleteLeave(EmployeeLeave $leave, User $user, Request $request){
        try {
            $leave->delete();
            $result = ['success', 'Leave has been deleted successfully.', 'Success'];
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }

        if(!is_null($user->user_id)){
            return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#leave')->with('message', $result);
        }

        return redirect(URL::signedRoute('user_management.index') . '#leave')->with('message', $result);
    }

    //HOLIDAYS
    public function addHoliday(){
        return view('admin.user_management.holiday.create', ['page_title' => 'Add Holiday']);
    }

    public function saveHoliday(Request $request){
        try {
            $dates = [
                'holiday_start' => date('Y-m-d H:i:s', strtotime($request->holiday_start)),
                'holiday_end' => date('Y-m-d H:i:s', strtotime($request->holiday_end))
            ];
            $data = array_merge( $request->except(['holiday_start', 'holiday_end']), $dates );

            Holiday::create($data);
            $result = ['success', 'Holiday has been saved successfully.', 'Success'];

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('user_management.index') . '#holiday')->with('message', $result);
            }
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }

    public function getHoliday(Request $request){
        $colors = [
            '#5867dd',
            '#0abb87',
            '#ffb822',
            '#fd397a',
            '#282a3c',
            '#9c27b0',
        ];

        $holidays = Holiday::orderBy('holiday_start')->get();
        $holidays = $holidays->map(function($holiday) use ($request, $colors){
            return [
                'title'=> ($request->user()->LanguageId == 1 ? $holiday->holiday_name : $holiday->holiday_name_ar),
                'start'=> $holiday->holiday_start,
                'end'=> $holiday->holiday_end,
                'id'=> $holiday->holiday_id,
                'url'=> URL::signedRoute('user_management.holiday.show', ['holiday' => $holiday->holiday_id]),
                'description'=> ($request->user()->LanguageId == 1 ? $holiday->holiday_name : $holiday->holiday_name_ar),
                'backgroundColor'=> $colors[array_rand($colors)],
                'textColor' => '#fff !important',
            ];
        });

        return response()->json($holidays);
    }

    public function showHoliday(Holiday $holiday, Request $request){
        return view('admin.user_management.holiday.show', ['page_title' => 'Add Holiday', 'holiday' => $holiday]);
    }

    public function updateHoliday(Holiday $holiday, Request $request){
        try {
            $dates = [
                'holiday_start' => date('Y-m-d H:i:s', strtotime($request->holiday_start)),
                'holiday_end' => date('Y-m-d H:i:s', strtotime($request->holiday_end))
            ];
            $data = array_merge( $request->except(['holiday_start', 'holiday_end']), $dates );

            $holiday->update($data);
            $result = ['success', 'Holiday has been saved successfully.', 'Success'];

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('user_management.index') . '#holiday')->with('message', $result);
            }
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect()->back()->with('message',$result);
    }

    public function deleteHoliday(Holiday $holiday, Request $request){
        try {
            $holiday->delete();
            $result = ['success', 'Holdiay has been deleted successfully.', 'Success'];
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect(URL::signedRoute('user_management.index') . '#holiday')->with('message', $result);
    }

    public function getNotifications(Request $request){
        if($request->ajax()){
            $notifications = $request->user()->unreadNotifications;
            return view('layouts.notifications', ['notifications' => $notifications]);
        }
    }

    public function notifications(Request $request){
        return view('admin.notifications.index', ['page_title' => 'Notifications']);
    }

    public function getNotificationsDatatable(Request $request){
        $data = $request->user()->unreadNotifications()->orderBy('created_at');
        return Datatables::of($data)->addColumn('notification', function($notification){

            $unread = is_null($notification->read_at) ? '' : '';

            return '<div class="kt-widget3">
                        <div class="kt-widget3__item">
                            <div class="kt-widget3__header">
                                <div class="kt-widget3__user-img">
                                    <img class="kt-widget3__img" src="' . asset('/assets/media/users/default.png') . '" alt="">
                                </div>
                                <div class="kt-widget3__info">
                                    <a href="#" class="kt-widget3__username">
                                        ' . $notification->data['title'] . '
                                    </a><br>
                                    <span class="kt-widget3__time">
                                        ' . humanDate($notification->created_at) . '
                                    </span>
                                </div>
                                <span class="kt-widget3__status kt-font-info">

                                </span>
                            </div>
                            <div class="kt-widget3__body">
                                <p class="kt-widget3__text">
                                    ' . $notification->data['content'] . '
                                </p>
                            </div>
                        </div>
                    </div>';

        })->addColumn('status', function($notification){
            return is_null($notification->read_at) ? 'unread' : 'read';
        })->addColumn('url', function($notification){
            return $notification->data['url'];
        })->rawColumns(['notification'])->make(true);
    }

    public function updateAsReadNotification(Request $request){
        if($request->ajax()){
            try {
                $request->user()->notifications()->where('id', $request->id)->first()->markAsRead();
                $result = ['result' => 1];
            } catch (\Exception $e) {
                $result = ['result' => 0];
            }
            return response()->json($result);
        }
    }
}
