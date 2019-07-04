<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EventPermitType extends Model
{
    use SoftDeletes;

       protected $dates = ['deleted_at'];
       protected $table = 'event_type';
       protected $primaryKey = 'event_type_id';
       protected $fillable = ['event_type_en', 'event_type_ar', 'created_by', 'updated_by', 'deleted_by'];

       public function event()
       {
        return $this->hasMany(EventPermit::class, 'event_type_id');
       }
}
