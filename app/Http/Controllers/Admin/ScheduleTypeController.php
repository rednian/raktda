<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\ScheduleType;
use Illuminate\Support\Facades\URL;

class ScheduleTypeController extends Controller
{
    public function __construct(){
        $this->middleware('signed')->except([
            'store',
            'update',
            'destroy',
            'setActive',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.settings.schedule.create', ['page_title'=> 'Add New Schedule Type']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $schedule_type = ScheduleType::create($request->all());

            //ADD SCHEDULES
            $day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            foreach ($request->day as $key => $day_sched) {
                $schedule_type->getSchedule()->create( array_merge([ 'day' => $day[$key] ], $day_sched) );
            }

            //IF SET TO ACTIVE
            if($request->has('is_active')){
                $schedule_type->update(['is_active' => 1]);

                //UPDATE THE OLD ACTIVE SCHEDULE TO NONE
                ScheduleType::where('is_active', 1)->where('schedule_type_id', '!=', $schedule_type->schedule_type_id)->update(['is_active' => null]);
            }

            DB::commit();
            $result = ['success', 'Schedule Type has been added successfully.', 'Success'];

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('admin.setting.index') . '#schedule_settings')->with('message', $result);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect()->back()->with('message',$result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ScheduleType $schedule_type, Request $request)
    {
        return view('admin.settings.schedule.edit', ['page_title'=> 'Edit Schedule Type', 'schedule_type' => $schedule_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScheduleType $schedule_type)
    {
        DB::beginTransaction();
        try {
            $schedule_type->update($request->all());

            //ADD SCHEDULES
            foreach ($request->day as $key => $day_sched) {
                $is_off = !array_key_exists('is_dayoff', $day_sched) ? ['is_dayoff' => null] : ['time_start' => null, 'time_end' => null];
                $schedule_type->getSchedule()->where('schedule_type_daytime_id', $key)->update( array_merge($is_off, $day_sched) );
            }

            //IF SET TO ACTIVE
            if($request->has('is_active')){
                $schedule_type->update(['is_active' => 1]);
                //UPDATE THE OLD ACTIVE SCHEDULE TO NONE
                ScheduleType::where('is_active', 1)->where('schedule_type_id', '!=', $schedule_type->schedule_type_id)->update(['is_active' => null]);
            }

            DB::commit();
            $result = ['success', 'Schedule Type has been saved successfully.', 'Success'];

            if($request->submit_type == 'continue'){
                return redirect(URL::signedRoute('admin.setting.index') . '#schedule_settings')->with('message', $result);
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect()->back()->with('message',$result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScheduleType $schedule_type, Request $request)
    {
        try {
            $schedule_type->delete();
            $result = ['success', 'Schedule Type has been deleted successfully.', 'Success'];
        } catch (\Exception $e) {
            $result = ['error', $e->getMessage(), 'Error'];
        }
        return redirect(URL::signedRoute('admin.setting.index') . '#schedule_settings')->with('message', $result);
    }

    public function setActive(ScheduleType $schedule_type, Request $request){
        DB::beginTransaction();
        try {

            $schedule_type->update(['is_active' => 1]);

            //UPDATE THE OLD ACTIVE SCHEDULE TO NONE
            ScheduleType::where('is_active', 1)->where('schedule_type_id', '!=', $schedule_type->schedule_type_id)->update(['is_active' => null]);
            DB::commit();

            $result = ['success', 'Schedule Type has been set to active.', 'Success'];
        } catch (\Exception $e) {
            DB::rollBack();
            $result = ['error', $e->getMessage(), 'Error'];
        }

        return redirect(URL::signedRoute('admin.setting.index') . '#schedule_settings')->with('message', $result);
    }
}
