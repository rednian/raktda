<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTruck extends Model
{
   protected $table = 'event_truck';
   protected $primaryKey = 'event_truck_id';
   protected $fillable = ['company_name_en', 'company_name_ar', 'plate_number', 'food_type', 'registration_issued_date', 'registration_expired_date', 'event_id', 'status', 'created_by'];


   public function event()
   {
      return $this->belongsTo(Event::class, 'event_id');
   }

   public function upload()
   {
      return $this->hasMany(EventLiquorTruckRequirement::class, 'liquor_truck_id','event_truck_id')->whereType('truck');
   }

   public function getCompanyNameAttribute()
   {
      return auth()->user()->LanguageId == 1 ? ucfirst($this->company_name_en) :  ucfirst($this->company_name_ar);
   }
}
