<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveType extends Model
{
    use SoftDeletes;

    protected $table = 'leave_type';
    protected $primaryKey = 'leave_type_id';
    protected $fillable = [
        'leave_type_name',
        'leave_type_name_ar'
    ];

    public function getEmployeeLeaves(){
    	return $this->hasMany(EmployeeLeave::class, 'employee_leave_id');
    }

    public function getNameAttribute()
    {
        return auth()->user()->LanguageId = 1 ? ucfirst($this->leave_type_name) : ucfirst($this->leave_type_name_ar); 
    }
}
