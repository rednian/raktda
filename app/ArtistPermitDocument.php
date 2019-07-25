<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermitDocument extends Model
{
     use SoftDeletes;
     protected $table = 'artist_permit_document';
     protected $primaryKey = 'artist_permit_document_id';
     protected $fillable = [
        'issued_date', 'expired_date', 'status', 'path', 'document_name',
        'artist_permit_id', 'created_by', 'updated_by', 'deleled_by'
     ];

     public function artistPErmit()
     {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
     }

}
