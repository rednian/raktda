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
        'artist_permit_status', 'artist_id', 'permit_id', 'permit_type_id', 'created_by', 'updated_by', 'deleted_by', 'original', 'thumbnail', 'sponsor_name_ar', 'sponsor_name_en', 'visa_expire_date', 'visa_number', 'visa_type_id', 'language_id', 'mobile_number', 'type', 'email', 'fax_number', 'po_box', 'phone_number', 'address_ar',  'city', 'area_id', 'address_en', 'passport_expire_date', 'passport_number', 'uid_expire_date', 'religion_id', 'emirates_id', 'uid_number'
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

    public function emirate()
    {
        return $this->belongsTo(Emirates::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function area()
    {
        return $this->belongsTo(Areas::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function language()
    {
        return $this->belongsTo(Language::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function religion()
    {
        return $this->belongsTo(Religion::class)->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function visaType()
    {
        return $this->belongsTo(VisaType::class)->withDefault(['visa_type_en'=> null, 'visa_type_ar'=> null ]);
    }


    // public function scopeDataTable($query)
    // {
    //     return $this->join('artist', 'artist.artist_id', '=', 'artist_permit.artist_id')
    //                 ->join('permit', 'permit.permit_id', '=', 'artist_permit.permit_id')
    //                 ->join('permit_type', 'permit_type.permit_type_id', '=', 'artist_permit.permit_type_id')
    //                 ->join('bls.company', 'bls.company.company_id', '=', 'permit.company_id');
    // }
}   
