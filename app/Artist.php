<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use SoftDeletes;
    protected $table = 'artist';
    protected $primaryKey = 'artist_id';
    protected $fillable = [
        'name', 'nationality', 'passport_number', 'uid_number', 'birthdate', 'mobile_number', 'artist_status',
        'person_code', 'phone_number', 'email', 'company_id', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'artist_id');
    }

    public function permit()
    {
        return $this->belongsToMany(Permit::class, 'artist_permit', 'artist_id', 'permit_id');
    }
}
