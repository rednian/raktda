<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
   protected $table = 'company_contact';
   protected $primary_key = 'company_contact_id';
   protected $fillable = ['company_id', 'name_en', 'name_ar', 'email', 'mobile_number', 'designation_en', 'designation_ar'];

   public function company()
   {
      return $this->belongsTo(Company::class, 'company_id');
   }
}
