<?php

namespace App;

use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermit extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'artist_permit';
    protected $primaryKey = 'artist_permit_id';
    protected $fillable = [
        'artist_permit_status', 'artist_id', 'permit_id', 'permit_type_id', 'created_by', 'updated_by', 'deleted_by', 'profession'
    ];

    public function permit()
    {
        return $this->belongsTo(Permit::class, 'permit_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function artistPermitDocument()
    {
        return $this->hasMany(ArtistPermitDocument::class, 'artist_permit_id', 'artist_permit_id');
    }

    public function permitType()
    {
        return $this->belongsTo(PermitType::class, 'profession', 'permit_type_id');
    }

    public function scopeDataTable($query)
    {
        return $this->join('artist', 'artist.artist_id', '=', 'artist_permit.artist_id')
            ->join('permit', 'permit.permit_id', '=', 'artist_permit.permit_id')
            ->join('bls.company', 'bls.company.company_id', '=', 'permit.company_id');
    }
}
