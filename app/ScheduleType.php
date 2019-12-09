<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleType extends Model
{
	use SoftDeletes;

    protected $table = 'schedule_type';
    protected $primaryKey = 'schedule_type_id';
    protected $fillable = [
        'schedule_type_name', 'schedule_type_name_ar', 'is_active'
    ];

    public function getSchedule(){
    	return $this->hasMany(ScheduleTypeDaytime::class, 'schedule_type_id');
    }
}
