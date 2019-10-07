<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTypeRequirement extends Model
{
	protected $table = 'event_type_requirement';
	protected $primaryKey = 'event_type_requirement_id';
	protected $fillable = ['event_type_id', 'requirement_name_en', 'requirement_name_ar'];

	public function eventRequirement()
	{
		return $this->hasMany(EventRequirement::class, 'event_type_requirement_id');
	}

	public function type()
	{
		return $this->belongsTo(EventType::class, 'event_type_id');
	}
}
