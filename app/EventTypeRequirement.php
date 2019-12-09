<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTypeRequirement extends Model
{
    protected $table = 'event_type_requirement';
    protected $primaryKey = 'event_type_requirement_id';
    protected $fillable = ['event_type_id', 'requirement_id', 'is_mandatory'];

     public function requirement()
    {
      return $this->belongsTo(Requirement::class, 'requirement_id');
    }

   
}
