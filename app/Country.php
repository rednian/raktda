<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'country_id';
    protected $fillable = ['name_en', 'name_ar', 'nationality_en', 'nationality_ar'];

    public function artist()
    {
    	return $this->hasMany(Artist::class, 'country_id');
    }
}
