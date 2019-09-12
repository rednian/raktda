<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistPermitCheck extends Model
{
    protected $table = 'artist_permit_check';
    protected $primaryKey = 'artist_permit_check_id';
    protected $fillable = ['artist_permit_id', 'status'];


    public function checklist()
    {
        return $this->hasMany(ArtistPermitChecklist::class, 'artist_permit_check_id');
    }

    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }

}
