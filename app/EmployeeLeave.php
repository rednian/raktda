<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    protected $table = 'employee_leave';
    protected $primaryKey = 'employee_leave_id';
    protected $fillable = ['user_id', 'start_date', 'end_date' , 'remarks'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
