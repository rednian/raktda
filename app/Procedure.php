<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
     use SoftDeletes;
     protected $table = 'procedure';
     protected $primaryKey = 'procedure_id';
     protected $fillable = [
        'procedure_name', 'procedure_type',  'procedure_status', 'description'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function permitProcedure()
    {
        return $this->hasMany(PermitApprover::class, 'procedure_id');
    }

    public function approver()
    {
        return $this->hasMany(ApproverProcedure::class, 'procedure_id');
    }
}