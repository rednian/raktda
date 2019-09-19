<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistPermitChecklist extends Model
{
    protected $table = 'artist_permit_checklist';
    protected $primaryKey = 'artist_permit_checklist_id';
    protected $fillable = ['fieldname', 'value', 'status', 'artist_permit_id', 'artist_permit_check_id'];

    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }

    public function check()
    {
        return $this->belongsTo(ArtistPermitCheck::class, 'artist_permit_check_id');
    }
}
