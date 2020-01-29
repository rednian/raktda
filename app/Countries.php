<?php

namespace App;
use Auth;
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

    public function getNameAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->name_en) : ucfirst($this->name_ar);
    }

    public function getNationalityAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->nationality_en) : ucfirst($this->nationality_ar);
    }

    public function scopeDefaultCountry($q)
    {
    	$q->where('name_en', 'United Arab Emirates')->first();
    }
}
