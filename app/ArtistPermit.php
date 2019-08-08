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
        'artist_permit_status', 'artist_id', 'permit_id', 'permit_type_id', 'created_by', 'updated_by', 'deleted_by'
    ];
    protected $dates = ['created_at', 'updated_at'];


    public function photo()
    {
        return $this->hasOne(ArtistPermitPhoto::class, 'artist_permit_id');
    }

    public function artistPermitRivision()
    {
         return $this->hasMany(ArtistPermitRivision::class, 'artist_permit_id');
    }

    public function comment()
    {
        return $this->hasMany(ArtistPermitComment::class, 'artist_permit_id');
    }

    public function checklist()
    {
        return $this->hasMany(ArtistChecklist::class, 'artist_permit_id');
    }

    public function permitType()
    {
        return $this->belongsTo(PermitType::class, 'permit_type_id');
    }

    public function permit()
    {
        return $this->belongsTo(Permit::class, 'permit_id');
    }

    public function artistPermitDocument()
    {
        return $this->hasMany(ArtistPermitDocument::class, 'artist_permit_id');
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
    }

    public function scopeDataTable($query)
    {
        return $this->join('artist', 'artist.artist_id', '=', 'artist_permit.artist_id')
                    ->join('permit', 'permit.permit_id', '=', 'artist_permit.permit_id')
                    ->join('permit_type', 'permit_type.permit_type_id', '=', 'artist_permit.permit_type_id')
                    ->join('bls.company', 'bls.company.company_id', '=', 'permit.company_id');
    }


}
