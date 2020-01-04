<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistPermitRevision extends Model
{
    protected $table = 'artist_permit_revision';
    protected $primaryKey = 'artist_permit_revision_id';
    protected $fillable = ['artist_permit_comment_id', 'artist_permit_id', 'fieldname', 'old_value', 'ischeck', 'step'];


}
