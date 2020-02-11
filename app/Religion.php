<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $table = 'religions';
    protected $primaryKey = 'id';
    protected $fillable = ['name_en', 'name_ar'];

    public function getNameAttribute()
    {
    	return auth()->user()->LanguageId == 1 ? ucfirst($this->name_en) : ucfirst($this->name_ar);
    }

}
