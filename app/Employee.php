<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
     use SoftDeletes;

    protected $connection = 'bls';
    protected $table = 'employee';
    protected $primaryKey = 'emp_id';
    protected $fillable = [
        'emp_name', 'dep_id', 'emp_mobile', 'emp_company_id', 'emp_designation', 'created_by', 'updated_by', 'deleted_by'
    ];
}
