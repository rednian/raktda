<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSNotfication extends Model
{
    protected $table = 'sms_notification';
    protected $primaryKey = 'sms_notification_id';
    protected $fillable = ['module_id', 'type', 'message', 'user_sender_id', 'user_receiver_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function module()
    {
        if($this->type == 'event'){
            return $this->belongsTo(Event::class, 'module_id', 'event_id');
        }
        if($this->type == 'artist'){
            return $this->belongsTo(Event::class, 'module_id', 'permit_id');
        }
        if($this->type == 'company'){
            return $this->belongsTo(Event::class, 'module_id', 'company_id');
        }
    }
}
