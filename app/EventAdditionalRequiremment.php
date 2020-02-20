<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAdditionalRequiremment extends Model
{
    protected $table = 'event_additional_requirement';
    protected $primaryKey = 'additional_requirement_id';
    protected $fillable = ['requirement_name_ar', 'requirement_name', 'requirement_description_ar', 'requirement_description', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id')->withDefault();
    }
}