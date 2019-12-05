<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
   protected $table = 'food_type';
   protected $primaryKey = 'food_type_id';
   protected $fillable = ['name_en', 'name_ar'];

   public function truck()
   {
      return $this->hasMany(EventTruck::class, 'food_type_id');
   }
}
