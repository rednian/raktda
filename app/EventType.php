<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventType extends Model
{
    use SoftDeletes;

    protected $table = 'event_type';
    protected $primaryKey = 'event_type_id';
    protected $fillable = ['name_en', 'name_ar', 'description_en', 'color', 'description_ar', 'amount', 'created_by', 'updated_by', 'deleted_by'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'event_type_requirement', 'event_type_id', 'requirement_id');
    }

    public function event()
    {
        return $this->hasMany(Event::class, 'event_type_id');
    }

    public function subType()
    {
        return $this->hasMany(EventTypeSub::class, 'event_type_id');
    }

    public function event_type_requirements(){
        return $this->hasMany(EventTypeRequirement::class, 'event_type_id');
    }

    public function getNameAttribute()
    {
        return auth()->user()->LanguageId == 1 ? ucfirst($this->name_en) : ucfirst($this->name_ar);
    }

    public function getDescriptionAttribute()
    {
        return auth()->user()->LanguageId == 1 ? ucfirst($this->description_en) : ucfirst($this->description_ar);
    }
}
