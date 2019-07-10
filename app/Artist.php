<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'artist';
    protected $primaryKey = 'artist_id';
    protected $fillable = [
        'name', 'nationality', 'passport_number', 'uid_number', 'birthdate', 'mobile_number',
        'phone_number', 'email', 'company_id', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function document()
    {
        return $this->hasMany(ArtistDocument::class, 'artist_id');
    }
}
