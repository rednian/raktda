<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermitDocument extends Model
{
    use SoftDeletes;
    protected $table = 'artist_permit_document';
    protected $primaryKey = 'permit_document_id';
    protected $fillable = [
        'issued_date', 'expired_date', 'status', 'path',
        'artist_permit_id', 'created_by', 'updated_by', 'deleled_by', 'requirement_id'
    ];
    protected $dates = ['issued_date', 'expired_date', 'created_at'];


    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id');
    }

    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }
}
