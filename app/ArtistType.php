<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistType extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'artist_type';
    protected $primaryKey = 'artist_type_id';
    protected $fillable = [
        'artist_type_en', 'artist_type_ar', 'amount', 'artist_type_code', 'created_by', 'updated_by', 'deleted_by'
    ];

    protected $auditInclude = [
           'artist_type_en', 'artist_type_ar', 'amount', 'artist_type_code', 'created_by', 'updated_by', 'deleted_by'
        ];



    public function artist()
    {
        return $this->hasMany(Artist::class, 'artist_type_id');
    }
}
