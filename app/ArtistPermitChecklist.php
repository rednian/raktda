<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermitChecklist extends Model
{
    use SoftDeletes;
    protected $table = 'artist_permit_checklist';
    protected $primaryKey = 'apc_id';
    protected $fillable = [
        'field_name', 'status', 'artist_permit_id', 'artist_id'
    ];

    public function permit()
    {
        return $this->belongTo(ArtistPermit::class, 'artist_permit_id');
    }

    public function artist()
    {
        return $this->belongTo(Artist::class, 'artist_id');
    }
}
