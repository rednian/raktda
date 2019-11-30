<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleTypeDaytime extends Model
{
	use SoftDeletes;

    protected $table = 'schedule_type_daytime';
    protected $primaryKey = 'schedule_type_daytime_id';
    protected $fillable = [
        'schedule_type_id', 'day', 'time_start', 'time_end', 'is_dayoff'
    ];

    public function getScheduleType(){
    	return $this->belongsTo(ScheduleType::class, 'schedule_type_id');
    }
}
