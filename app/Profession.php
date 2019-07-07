<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use SoftDeletes;

    protected $table = 'profession';
    protected $primaryKey = 'prof_id';
    protected $fillable = ['prof_name_en', 'prof_name_ar', 'prof_amount', 'prof_description', 'created_by', 'updated_by', 'deleted_by'];

    public function artist()
    {
        return $this->hasMany(Artist::class, 'prof_id');
    }
}
