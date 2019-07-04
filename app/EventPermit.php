<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class EventPermit extends Model
{
    use SoftDeletes;

       protected $dates = ['deleted_at'];
       protected $table = 'event_permit';
       protected $primaryKey = 'event_permit_id';
       protected $fillable = [
        'event_permit_number', 'event_name', 'event_location', 'event_venue',
        'event_date_start', 'event_date_end', 'event_time_start', 'event_time_end',
        'company_id', 'event_type_id', 'created_by', 'updated_by', 'deleted_by'
       ];

       public function type()
       {
        return $this->belongsTo(EventPermitType::class, 'event_type_id');
       }
}
