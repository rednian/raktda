<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistPermitRivision extends Model
{
    protected $table = 'artist_permit_rivision';
    protected $primaryKey = 'artist_permit_rivision_id';
    protected $fillable = ['artist_permit_comment_id', 'artist_permit_id', 'fieldname', 'old_value', 'ischeck'];

    

    
}
