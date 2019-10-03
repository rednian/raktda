<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRequirement extends Model
{
	protected $table = 'event_requirement';
	protected $primaryKey = 'event_requirement_id';
	protected $casts = ['is_date_required'=> 'boolean'];
	protected $fillable = ['event_id', 'event_type_requirement_id', 'path', 'issued_date', 'expired_date', 'is_date_required'];

	public function requirement()
	{
		return $this->belongsTo(EventTypeRequirement::class, 'event_type_requirement_id');
	}
	public function event()
	{
		return $this->belongsTo(Event::class, 'event_id');
	}
}
