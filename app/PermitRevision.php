<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class PermitRevision extends Model
{
      use SoftDeletes;
      protected $table = 'permit_revision';
      protected $primaryKey = ['permit_revision_id'];
      protected $fillable = [ 'revision__number', 'permit_id', 'artist_permit_comment_id'];

      public function artistPermitComment()
      {
        return $this->belongsTo(ArtistPermitComment::class, 'artist_permit_comment_id');
      }

      public function permit()
      {
        return $this->belongsTo(Permit::class, 'permit_id');
      }
    
}
