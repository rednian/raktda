<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventOtherUpload extends Model
{
   protected $table = 'event_other_upload';
   protected $primaryKey= 'event_other_upload_id';
   protected $fillable= ['name', 'path', 'issued_date', 'expiry_date', 'type', 'event_id'];

   public function event()
   {
      return $this->belongsTo(Event::class, 'event_id');
   }
}
