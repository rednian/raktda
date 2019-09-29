<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use SoftDeletes;
    protected $table = 'profession';
    protected $primaryKey = 'profession_id';
    protected $fillable = ['name_en', 'name_ar', 'amount', 'name_ar'];

    public function artist()
    {
        return $this->hasMany(ArtistPermit::class, 'profession_id');
    }
}
