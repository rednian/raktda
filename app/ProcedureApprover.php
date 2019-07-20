<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProcedureApprover extends Model
{
      use SoftDeletes;
      protected $table = 'procedure_approver';
      protected $primaryKey = 'proda_id';
      protected $fillable = [
        'order', 'procedure_id', 'employee_id', 'created_by', 'updated_by', 'deleted_by'
      ];

      public function procedure()
      {
        return $this->belongsTo(Procedure::class, 'prod_id');
      }
}
