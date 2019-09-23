<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    protected $primaryKey = 'country_code';
    protected $fillable = ['country_enName', 'country_arName', 'country_enNationality', 'country_arNationality'];

    public function artist()
    {
    	return $this->hasMany(Artist::class, 'nationality', 'country_code');
    }
}
