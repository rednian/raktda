<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistProfession extends Model
{

    protected $table = 'artist_profession';
    protected $primaryKey = 'profession_id';

    public function artist()
    {
        return $this->hasOne(Artist::class, 'profession_id');
    }
}
