<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistType extends Model
{
    use SoftDeletes;

    protected $table = 'artist_type';
    protected $primaryKey = 'artist_type_id';
    protected $fillable = [
        'artist_type', 'amount', 'artist_permit_code', 'created_by', 'updated_by', 'deleted_by'
    ];

    

    public function artist()
    {
        return $this->hasMany(Artist::class, 'artist_type_id');
    }
}
