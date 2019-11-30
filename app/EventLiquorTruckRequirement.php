<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLiquorTruckRequirement extends Model
{
   protected $table = 'liquor_truck_requirement';
   protected $primaryKey = 'liquor_truck_requirement_id';
   protected $fillable = ['type', 'liquor_truck_id', 'requirement_id', 'path', 'requirement_id'];

   public function requirement()
   {
      return $this->belongsTo(Requirement::class, 'requirement_id');
   }

   public function truck()
   {
      return $this->belongsTo(EventTruck::class, 'event_liquor_id' ,'liquor_truck_id');
   }

   public function liquor()
   {
      return $this->belongsTo(EventTruck::class, 'event_truck_id' ,'liquor_truck_id');
   }
}
