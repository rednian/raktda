<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artist';
    protected $primaryKey = 'artist_id'
    protected $fillable = [
        'artist_name', 'artist_nationality', 'artist_uid_number', 'artist_passport_number',
        'artist_birthdate', 'artist_mobile', 'artist_phone_number', 'artist_email', 'artist_status',
        'updated_by', 'created_by', 'deleted_by', 'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
