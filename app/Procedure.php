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

    public function artistPermit()
    {
        return $this->belongsToMany(Procedure::class, 'artist_permit_approver', 'procedure_id', 'artist_permit_id');
    }

    public function approver()
    {
        return $this->hasMany(ApproveProcedure::class, 'procedure_id');
    }



}