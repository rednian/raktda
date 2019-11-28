<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLiquor extends Model
{
   protected $table = 'event_liquor';
   protected $primaryKey = 'event_liquor_id';
   protected $fillable = ['company_name_ar', 'company_name_en', 'emirate_id', 'license_number', 'trade_license_number', 'license_issued_date', 'license_expired_date', 'event_id', 'trade_license_expired_date', 'trade_license_issued_date'];

   public function event()
   {
      return $this->belongsTo(Event::class, 'event_id');
   }

   public function emirate()
   {
       return $this->hasMany(Emirates::class, 'id')->withDefault(['name_en'=>null, 'name_ar'=>null]);
   }

   public function upload()
   {
      return $this->hasMany(LiquorTruckRequirement::class, 'liquor_truck_id','event_liquor_id')->where('type', 'liquor');
   }
}
