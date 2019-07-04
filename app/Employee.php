<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';
    protected $primaryKey = 'emp_id';
    protected $fillable = ['emp_name', 'emp_status', 'emp_designation', 'dep_id'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }
}
