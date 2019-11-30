<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\ScheduleType;
use App\EmployeeCustomWorkSchedule;
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
			'deleteCustomSchedule'
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

    public function create(){
    	return view('admin.user_management.create', ['page_title'=> 'Add New Employee']);
    }

    public function store(Request $request){
    	DB::beginTransaction();
    	try {
    		$active_sched = ScheduleType::where('is_active', 1)->first();
    		$user = User::create( array_merge($request->except(['password']), ['password' => bcrypt($request->password), 'type' => 4, 'IsActive' => 1, 'CreatedBy' => $request->user()->user_id ]) );

    		//SELECT SCHEDULE 
    		$user->workschedule()->create([
    			'schedule_type_id' => $active_sched->schedule_type_id
    		]);

    		//ADD USER ROLE
    		$user->roles()->sync($request->role_id);

    		DB::commit();
    		$result = ['success', 'Employee has been added successfully.', 'Success'];

    		if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('user_management'))->with('message', $result);
            }
    	} catch (\Exception $e) {
    		DB::rollBack();
    		$result = ['error', $e->getMessage(), 'Error'];
    	}
    	return redirect()->back()->with('message',$result);
    }

    public function datatable(Request $request){
    	$data = User::whereHas('roles', function($q){
    		$q->where('Type', 0);
    	});

    	return Datatables::of($data)->addColumn('name', function($user) use($request){
    		return $request->user()->LanguageId == 1 ? $user->NameEn : $user->NameAr;
    	})->addColumn('department', function($user){
    		return '';
    	})->addColumn('role', function($user){
    		return ucwords($user->roles()->first()->NameEn);
    	})->editColumn('CreatedAt', function($user){
    		return $user->CreatedAt->format('Y-m-d');
    	})->addColumn('actions', function($user){
    		return '';
    	})->addColumn('show_url', function($user){
    		return URL::signedRoute('user_management.details', ['user' => $user->user_id ]);
    	})->addColumn('status', function($user){
    		return  $user->IsActive == 1 ? 'Active' : 'Inactive';
    	})->make(true);
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

    	return redirect(URL::signedRoute('user_management.details', ['user' => $request->user_id]) . '#artist_requirements')->with('message', $result);
        
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
                return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#artist_requirements')->with('message', $result);
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
                return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#artist_requirements')->with('message', $result);
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
        return redirect(URL::signedRoute('user_management.details', ['user' => $user->user_id]) . '#artist_requirements')->with('message', $result);
    }
}
