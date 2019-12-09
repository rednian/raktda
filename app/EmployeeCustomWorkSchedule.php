<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeCustomWorkSchedule extends Model
{
    use SoftDeletes;

    protected $table = 'employee_custom_work_schedule';
    protected $primaryKey = 'emp_custom_id';
    protected $fillable = [
        'user_id', 'emp_custom_name', 'emp_custom_name_ar'
    ];

    public function getSchedule(){
    	return $this->hasMany(EmployeeCustomSchedule::class, 'emp_custom_id');
    }
}
