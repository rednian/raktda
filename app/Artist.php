<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artist';
    protected $primaryKey = 'artist_id';
    protected $fillable = [
        'name', 'nationality', 'passport_number', 'uid_number', 'birthdate', 'mobile_number',
        'artist_status', 'profesion', 'artist_type_id', 'permit_id', 'person_code',
        'phone_number', 'email', 'company_id', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function artistdocument()
    {
        return $this->belongsTo(ArtistDocument::class, 'artist_id');
    }

    public function artistpermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }

    public function artisttype()
    {
        return $this->belongsTo(ArtistType::class, 'artist_type_id');
    }
}
