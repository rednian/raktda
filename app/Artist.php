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
        'firstname_en', 'firstname_ar', 'lastname_en', 'lastname_ar', 'nationality', 'birthdate', 'artist_status', 'gender',  'created_by', 'updated_by', 'deleted_by', 'person_code'
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
