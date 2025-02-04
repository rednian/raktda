<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use SoftDeletes;

    protected $connection = 'bls';
    protected $table = 'smartrak_bls.employee';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'emp_name', 'dep_id', 'emp_mobile', 'emp_company_id', 'emp_designation', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }
}
