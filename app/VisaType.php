<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisaType extends Model
{
    protected $table = 'visa_type';


    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'visa_type_id');
    }

    public function getNameAttribute()
    {
    	return auth()->user()->LanguageId == 1 ? ucfirst($this->visa_type_en) : ucfirst($this->visa_type_ar);
    }

}


