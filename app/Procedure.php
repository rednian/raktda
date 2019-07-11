<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
     use SoftDeletes;
     protected $table = 'procedure';
     protected $primaryKey = 'procedure_id';
     protected $fillable = ['prod_status', 'prod_name', 'prod_description', 'created_by', 'updated_by', 'deleted_by'];
     
}
