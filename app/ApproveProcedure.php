<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ApproveProcedure extends Model
{
    // use SoftDeletes;
     protected $table = 'approve_procedure';
     protected $primaryKey = 'app_id';
     protected $fillable = ['role_id', 'procedure_id', 'order'];
}
