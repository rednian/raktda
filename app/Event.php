<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $connection = 'mysql';
	protected $table = 'event';
	protected $primaryKey = 'event_id';
	protected $dates = ['created_at', 'updated_at', 'deleted_at', 'issued_date', 'expired_date'];
	protected $casts = ['is_displayable'=>'boolean'];
	protected $fillable = [
		 'name_en', 'name_ar', 'reference_number', 'issued_date', 'expired_date', 'time_start', 'time_end', 'permit_number', 'venue_en', 'venue_ar',
		 'company_id', 'country_id', 'event_type_id', 'area_id', 'emirate_id', 'status', 'address', 'is_displayable'
		 ];

	public function getExpiredDateAttribute($date)
	{
		if(!$date){ return null; }
		return Carbon::parse($date)->format('d-M-Y');
	}

	public function getIssuedDateAttribute($date)
	{
		if(!$date){ return null; }
		return Carbon::parse($date)->format('d-M-Y');
	}

	public function getTimeStartAttribute($date)
	{
		if(!$date){ return null; }
		return Carbon::parse($date)->format('h:m a');
	}

	public function getTimeEndAttribute($date)
	{
		if(!$date){ return null; }
		return Carbon::parse($date)->format('h:m a');
	}


	public function company()
	{
		return $this->belongsTo(Company::class, 'company_id');
	}

	public function area()
	{
		return $this->belongsTo(Areas::class, 'area_id', 'id');
	}

	public function emirate()
	{
		return $this->belongsTo(Emirates::class, 'emirate_id', 'id');
	}

	public function country()
	{
		return $this->belongsTo(Country::class, 'country_id');
	}

	public function type()
	{
		return $this->belongsTo(EventType::class, 'event_type_id');
	}
}
