<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CompanyContact extends Model
{
   protected $table = 'company_contact';
   protected $primary_key = 'company_contact_id';
   protected $fillable = ['company_id', 'contact_name_en', 'contact_name_ar', 'email', 'mobile_number', 'designation_en', 'designation_ar', 'emirate_identication', 'emirate_id_issued_date', 'emirate_id_expired_date'];

   protected $dates = ['emirate_id_issued_date', 'emirate_id_expired_date'];


    public function setEmirateIdIssuedDateAttribute($date)
    {
        $this->attributes['emirate_id_issued_date'] =  Carbon::parse($date)->format('Y-m-d');
    }

     public function setEmirateIdExpiredDateAttribute($date)
    {
        $this->attributes['emirate_id_expired_date'] =  Carbon::parse($date)->format('Y-m-d');
    }  

   public function company()
   {
      return $this->belongsTo(Company::class, 'company_id');
   }
}
