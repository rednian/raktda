<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeWorkSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'employee_work_schedule';
    protected $primaryKey = 'employee_work_schedule_id';
    protected $fillable = [
        'user_id', 'schedule_type_id', 'is_custom', 'emp_custom_id'
    ];

    public function getSchedule(){
        if ($this->is_custom) {
            return $this->belongsTo(EmployeeCustomWorkSchedule::class, 'emp_custom_id');
        }
        else{
            return $this->belongsTo(ScheduleType::class, 'schedule_type_id');
        }
    }

    public function getScheduleType(){
    	return $this->belongsTo(ScheduleType::class, 'schedule_type_id');
    }

    public function getUser(){
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function getCustomSchedule(){
        return $this->belongsTo(EmployeeCustomWorkSchedule::class, 'emp_custom_id');
    }
}
