<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistPermitChecklist extends Model
{
     use SoftDeletes;
     protected $table = 'artist_permit_checklist';
     protected $primaryKey = 'artist_permit_checklist_id';
     protected $fillable = ['fieldname', 'value', 'status', 'artist_permit_id'];

     public function artistPermit()
     {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
     }
}
