<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PermitRivision extends Model
{
      use SoftDeletes;
      protected $table = 'permit_rivision';
      protected $primaryKey = ['permit_rivision_id'];
      protected $fillable = [ 'rivision__number', 'permit_id', 'artist_permit_comment_id'];

      public function artistPermitComment()
      {
        return $this->belongsTo(ArtistPermitComment::class, 'artist_permit_comment_id');
      }

      public function permit()
      {
        return $this->belongsTo(Permit::class, 'permit_id');
      }
    
}
