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
        'sponsor_name_en', 'sponsor_name_ar', 'visa_expire_date', 'visa_number', 'visa_type_en', 'visa_type_ar', 'mobile_number',
        'email', 'fax_number', 'po_box', 'phone_number', 'address_en', 'address_ar', 'area_ar', 'area_en', 'city_ar', 'city_en',
        'passport_expire_date', 'passport_number', 'uid_expire_date', 'uid_number', 'thumbnail', 'originakbl', 'artist_permit_status',
        'artist_id', 'permit_id', 'permit_type_id', 'language_en', 'language_ar', 'type'
    ];
    protected $dates = ['created_at', 'updated_at', 'deleted_at',  'uid_expire_date', 'passport_expire_date', 'visa_expire_date'];

    public function check()
    {
        return $this->hasMany(ArtistPermitCheck::class, 'artist_permit_id');
    }

    public function artistPermitRevision()
    {
         return $this->hasMany(ArtistPermitRevision::class, 'artist_permit_id');
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
