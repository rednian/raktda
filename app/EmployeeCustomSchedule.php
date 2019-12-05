<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeCustomSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'employee_custom_schedule';
    protected $primaryKey = 'custom_id';
    protected $fillable = [
        'day', 'time_start', 'time_end', 'is_dayoff', 'emp_custom_id'
    ];

    public function getCustomSchedule(){
    	return $this->belongsTo(EmployeeCustomWorkSchedule::class, 'emp_custom_id');
    }
}
