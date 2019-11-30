<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_setting';
    protected $primaryKey = 'general_setting_id';
    protected $fillable = [
        'inspection_per_day',
        'artist_permit_grace_period_amendment',
        'artist_permit_grace_period_renew',
        'event_start_after',
        'artist_start_after',
        'event_grace_period_amendment'
    ];

    protected $dates = ['deleted_at'];
}
