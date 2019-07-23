<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermitApprover extends Model
{
      use SoftDeletes;
      protected $table = 'artist_permit_approver';
      protected $primaryKey = 'ap_procedure_id';
      protected $fillable = ['app_id', 'artist_permit_id'];
}
