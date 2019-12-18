<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'gender';
    protected $primaryKey = 'gender_id';
    protected $fillable = ['name_en', 'name_ar'];


    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'gender_id');
    }

}
