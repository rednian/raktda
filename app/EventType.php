<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    protected $table = 'event_type';
    protected $primaryKey = 'event_type_id';
    protected $fillable = ['name_en', 'name_ar', 'description_en', 'description_ar', 'amount', 'created_by', 'updated_by', 'deleted_by'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'event_type_requirement', 'event_type_id', 'requirement_id');
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'event_type_id');
    }
}
