<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_setting';
    protected $primaryKey = 'general_setting_id';
    protected $fillable = ['event_inspection_per_day', 'event_inspection_per_day', 'artist_permit_grace_period', 'event_start_after', 'updated_by'];
    protected $dates = ['created_at', 'updated_at'];
}
