<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistDocument extends Model
{
    protected $table = 'artist_document';
    protected $primaryKey = 'artist_doc_id';
    protected $fillable = [
        'artist_doc_name', 'artist_doc_path', 'artist_doc_issued_date',
        'artist_doc_expired_date', 'artist_id', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
