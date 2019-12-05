<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTruck extends Model
{
   protected $table = 'event_truck';
   protected $primaryKey = 'event_truck_id';
   protected $dates = ['registration_issued_date', 'registration_expired_date'];
   protected $fillable = ['company_name_en', 'company_name_ar', 'plate_number', 'food_type_id', 'registration_issued_date', 'registration_expired_date', 'event_id'];

   public function type()
   {
      return $this->hasMany(FoodType::class, 'food_type_id');
   }

   public function event()
   {
      return $this->belongsTo(Event::class, 'event_id');
   }

   public function upload()
   {
      return $this->hasMany(LiquorTruckRequirement::class, 'liquor_truck_id', 'event_truck_id')->where('type', 'truck');
   }
}
