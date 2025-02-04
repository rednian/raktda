<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventTypeSub extends Model
{
	use SoftDeletes;

	protected $table = 'event_type_sub';
	protected $primaryKey = 'event_type_sub_id';
	protected $fillable = ['event_type_id', 'sub_name_en', 'sub_name_ar'];

	public function type()
	{
		return $this->belongsTo(EventType::class, 'event_type_id');
	}

	public function event()
	{
		return $this->hasMany(Event::class, 'event_type_sub_id');
	}

	public function getSubnameAttribute()
	{
		return auth()->user()->LanguageId == 1 ? ucfirst($this->sub_name_en) : ucfirst($this->sub_name_ar);
	}

}
