<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLiquor extends Model
{
   protected $table = 'event_liquor';
   protected $primaryKey = 'event_liquor_id';

   protected $fillable = ['company_name_ar', 'company_name_en', 'provided', 'purchase_receipt', 'liquor_types', 'liquor_permit_no', 'event_id', 'status', 'created_by', 'paid', 'liquor_service', 'status'];

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
      return $this->hasMany(EventLiquorTruckRequirement::class, 'liquor_truck_id','event_liquor_id')->where('type', 'liquor');
   }

   public function getCompanyNameAttribute()
   {
      return auth()->user()->LanguageId == 1 ? ucfirst($this->company_name_en) : ucfirst($this->company_name_ar); 
   }
}
