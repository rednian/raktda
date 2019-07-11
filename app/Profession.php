<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use SoftDeletes;

    protected $table = 'artist_type';
    protected $primaryKey = 'prof_id';
    protected $fillable = ['name_en', 'name_ar', 'artist_type_amount', 'artist_permit_code', 'created_by', 'updated_by', 'deleted_by'];

    

    public function artist()
    {
        return $this->hasMany(Artist::class, 'prof_id');
    }
}
