<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'country';
    protected $primaryKey = 'country_id';
    protected $fillable = ['country_code', 'name_en', 'name_er', 'nationality_en', 'nationality_ar'];
}
