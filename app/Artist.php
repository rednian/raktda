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
        'name', 'nationality', 'passport_number', 'uid_number', 'birthdate', 'mobile_number', 'artist_status', 
        'passport_issued_date', 'passport_expired_date', 'uid_issued_date', 'uid_expired_date',
        'person_code','phone_number', 'email', 'created_by', 'updated_by', 'deleted_by'

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

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    



}
