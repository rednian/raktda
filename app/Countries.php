<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'country_id';
    protected $fillable = ['country_code', 'name_en', 'name_er', 'nationality_en', 'nationality_ar'];

    public function artistpermit()
    {
        return $this->hasMany(ArtistPermit::class, 'country_id');
    }

    public function scopeDefaultCountry($q)
    {
    	$q->where('name_en', 'United Arab Emirates')->first();
    }
}
