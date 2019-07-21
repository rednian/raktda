<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
     use SoftDeletes;
    protected $table = 'event_type';
    protected $primaryKey = 'event_type_id';
    protected $fillable = [
        'event_type_code', 'event_type_en', 'event_type_ar', 'event_duration',
        'event_type_amount', 'created_by', 'updated_by', 'deleted_by',
    ];

}
