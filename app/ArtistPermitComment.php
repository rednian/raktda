<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermitComment extends Model
{
       use SoftDeletes;
      protected $table = 'artist_permit_comment';
      protected $primaryKey = 'artist_permit_comment_id';
      protected $fillable = [ 'comment', 'user_id', 'artist_permit_id', 'comment_status'];


      public function permitRivision()
      {
        return $this->hasMany(PermitRivision::class, 'artist_permit_comment_id');
      }

      public function artistPermitRivision()
      {
        return $this->hasMany(ArtistPermitRivision::class, 'artist_permit_comment_id');
      }

      public function artistPermit()
      {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
      }

  
}
