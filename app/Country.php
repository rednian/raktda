<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'country_id';
    protected $fillable = ['country_code', 'name_en', 'name_ar', 'nationality_en', 'nationality_ar', 'continent', 'continent_code'];

    public function artistpermit()
    {
    	return $this->hasMany(ArtistPermit::class, 'country_id');
    }

}
