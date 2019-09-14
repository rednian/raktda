<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PermitDuration extends Model
{
      use SoftDeletes;
      protected $table = 'permit_duration';
      protected $primaryKey = 'permit_duration_id';
      protected $fillable = ['duration_days', 'is_default'];


}
