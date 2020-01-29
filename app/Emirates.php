<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Emirates extends Model
{
    protected $table = 'emirates';
    protected $primaryKey = 'id';
    protected $fillable = ['name_en', 'name_ar'];

    public function getNameAttribute()
    {
    	return Auth::user()->LanguageId == 1 ?  ucfirst($this->name_en) : ucfirst($this->name_ar);
    }
}
