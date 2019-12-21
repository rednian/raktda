<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{
    protected $table = 'areas';
    protected $primaryKey = 'id';

    protected $fillable = ['area_en', 'area_ar', 'emirates_id'];

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'area_id');
    }


    public function company()
    {
    	return $this->hasMany(Company::class, 'area_id', 'id');
    }


}
