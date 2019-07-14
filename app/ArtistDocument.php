<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistDocument extends Model
{
    use SoftDeletes;
    protected $table = 'artist_document';
    protected $primaryKey = 'artist_doc_id';
    protected $fillable = [
        'doc_name', 'doc_path', 'issued_date', 'company_id',
        'expired_date', 'artist_id', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }
}
