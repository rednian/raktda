<?php

namespace App;

use Auth;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
   protected $table = 'company_type';
   protected $primaryKey = 'company_type_id';
   protected $fillable = ['name_en', 'name_ar'];

   public function getNameAttribute()
   {
   	return Auth::user()->LanguageId == 1 ? ucfirst($this->name_en) : ucfirst($this->name_ar);
   }
}
