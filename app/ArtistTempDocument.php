<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistTempDocument extends Model
{
    protected $table = 'artist_temp_document';
    protected $primaryKey = 'id';
    protected $fillable = [
        'status', 'issued_date', 'expired_date', 'path', 'permit_id',  'requirement_id', 'artist_permit_id', 'temp_data_id', 'created_at', 'updated_at', 'doc_id'
    ];

    public function artistTempData()
    {
        return $this->belongsTo(ArtistTempData::class, 'artist_permit_id');
    }
}
