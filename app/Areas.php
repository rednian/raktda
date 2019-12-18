<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'areas';
    protected $primaryKey = 'id';

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'area_id');
    }
}
