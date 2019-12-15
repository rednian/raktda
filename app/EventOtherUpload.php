<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventOtherUpload extends Model
{
   protected $table = 'event_other_upload';
   protected $primaryKey= 'event_other_upload_id';
   protected $fillable= ['path', 'thumbnail', 'size' , 'event_id', 'created_by', 'description'];


   function event()
   {
      return $this->belongsTo(Event::class, 'event_id');
   }
}
