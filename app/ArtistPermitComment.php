<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermitComment extends Model
{
       use SoftDeletes;
      protected $table = 'artist_permit_comment';
      protected $primaryKey = 'artist_permit_comment_id';
      protected $fillable = [ 'artist_permit_id', 'artist_permit_check_id', 'permit_comment_id'];

      
  
}
