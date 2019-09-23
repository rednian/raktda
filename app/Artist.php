<?php

namespace App;

use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'artist';
    protected $primaryKey = 'artist_id';
    protected $fillable = [

        'firstname_en', 'firstname_ar', 'lastname_en', 'lastname_ar', 'nationality', 'birthdate', 'artist_status', 'gender_id',  'created_by', 'updated_by', 'deleted_by', 'person_code'

    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birthdate'];

    public function country()
    {
    	return $this->belongsTo(Countries::class, 'nationality','country_code');
    }

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'artist_id');
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function permit()
    {
        return $this->belongsToMany(Permit::class, 'artist_permit', 'artist_id', 'permit_id');
    }

    public function getFullNameAttribute()
    {
        return $this->firstname_en . ' ' . $this->lastname_en;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function Nationality()
    {
        return $this->belongsTo(Countries::class, 'nationality',  'country_code');
    }
}
