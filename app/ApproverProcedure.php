<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ApproverProcedure extends Model
{
     use SoftDeletes;
     protected $connection = 'mysql';
     protected $table = 'approver_procedure';
     protected $primaryKey = 'approver_procedure_id';
     protected $fillable = [
        'role_id', 'procedure_id',  'duration', 'order', 'required_check'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    
    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }
}
