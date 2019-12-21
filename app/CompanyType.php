<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
   protected $table = 'company_type';
   protected $primaryKey = 'company_type_id';
   protected $fillable = ['name_en', 'name_ar'];
}
