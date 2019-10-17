<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventCheck extends Model
{
	protected $connection = 'mysql';
	protected $table = 'event_check';
	protected $primaryKey = 'event_check_id';
	protected $dates = ['created_at', 'updated_at'];
	protected $fillable = [
		 'name_en', 'name_ar', 'reference_number', 'issued_date', 'expired_date', 'time_start', 'time_end', 'permit_number', 'venue_en', 'venue_ar',
		 'company_id', 'country', 'event_type', 'area_en', 'emirate', 'address', 'user_id',
		 ];
	public function event()
	{
		return $this->belongsTo(Event::class, 'event_id');
	}
}
