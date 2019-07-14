<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermit extends Model
{
      use SoftDeletes; 
      protected $table = 'artist_permit';
      protected $primaryKey = 'artist_permit_id';
      protected $fillable = [
        'work_location', 'permit_status', 'issued_date', 'expired_date',
        'company_id', 'created_by', 'updated_by', 'deleted_by'
      ];

  
}
