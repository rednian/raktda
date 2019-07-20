<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
     use SoftDeletes;
     protected $table = 'procedures';
     protected $primaryKey = 'procedure_id';
     protected $fillable = [
        'procedure_status', 'procedure_type',  'procedure_name', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function approve()
    {
        return $this->hasMany(ProcedureApprover::class, 'procedure_id');
    }



}