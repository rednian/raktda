<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeLeave extends Model
{
	use SoftDeletes;

    protected $table = 'employee_leave';
    protected $primaryKey = 'employee_leave_id';
    protected $fillable = ['user_id', 'leave_type_id', 'leave_start', 'leave_end', 'remarks'];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLeaveType(){
    	return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }
}
