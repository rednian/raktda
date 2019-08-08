<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistPermitPhoto extends Model
{
     use SoftDeletes;
    protected $table = 'artist_permit_photo';
    protected $primaryKey = 'artist_permit_photo_id';
    protected $fillable = [ 'original', 'thumbnail', 'artist_permit_id'];

    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }
}
