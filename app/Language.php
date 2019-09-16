<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $primaryKey = 'id';
    protected $fillable = ['name_en', 'name_ar'];



    // public function artist()
    // {
    //     return $this->hasMany(ArtistPermit::class, 'permit_type_id')->where('status', 'artist');
    // }
}
