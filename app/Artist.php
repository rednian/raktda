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
        'artist_status', 'person_code', 'firstname_en', 'firstname_ar', 'lastname_en', 'lastname_ar', 'nationality_en', 'nationality_ar','birthdate',
        'created_by', 'updated_by', 'deleted_by', 'gender_en', 'gender_ar'

    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'birthdate'];

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'artist_id');
    }

    public function permit()
    {
        return $this->belongsToMany(Permit::class, 'artist_permit', 'artist_id', 'permit_id');
    }

    public function getFullNameAttribute()
    {
        return $this->firstname_en.' '.$this->lastname_en;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    



}
