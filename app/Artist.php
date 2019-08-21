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
        'firstname_en', 'firstname_ar', 'lastname_en', 'lastname_ar', 'nationality', 'passport_number', 'uid_number', 'birthdate', 'mobile_number', 'artist_status', 'uid_expiry_date', 'pp_expiry_date', 'visa_type', 'visa_number', 'visa_expiry_date', 'sponser_name', 'id_no', 'language', 'religion', 'gender', 'emirate', 'area', 'language', 'address', 'phone_number', 'email', 'created_by', 'updated_by', 'deleted_by'
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
