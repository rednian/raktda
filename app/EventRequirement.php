<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRequirement extends Model
{
    protected $table = 'event_requirement';
    protected $primaryKey = 'event_requirement_id';
    protected $dates = ['created_at', 'updated_at', 'expired_date', 'issued_date'];
    protected $fillable = ['event_id', 'event_type_id', 'path', 'issued_date', 'expired_date', 'requirement_id', 'type' ];

    public function type()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
    
    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id')->withDefault();
    }

    public function additionalRequirement()
    {
        return $this->belongsTo(EventAdditionalRequiremment::class,  'requirement_id', 'additional_requirement_id')->withDefault();
    }

}
