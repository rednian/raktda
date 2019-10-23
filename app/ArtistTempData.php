<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistTempData extends Model
{
    protected $table = 'artist_temp_data';
    protected $primaryKey = 'id';
    protected $fillable = [
        'artist_id', 'permit_id', 'permit_type_id', 'original', 'thumbnail', 'sponsor_name_ar', 'sponsor_name_en', 'visa_expire_date', 'visa_number', 'visa_type', 'language', 'visa_type', 'mobile_number', 'email', 'fax_number', 'po_box', 'phone_number', 'address_ar',  'city', 'address_en', 'area', 'passport_expire_date', 'passport_number', 'uid_expire_date', 'religion',  'emirates_id', 'uid_number',  'firstname_en', 'firstname_ar', 'lastname_en', 'lastname_ar', 'nationality', 'birthdate', 'gender',  'status', 'permit_type_name', 'artist_permit_id', 'person_code', 'is_old_artist', 'profession_id', 'artist_permit_status', 'issue_date', 'expiry_date', 'work_location', 'created_by', 'company_id', 'process', 'permit_number'
    ];


    public function ArtistTempDocument()
    {
        return $this->hasMany(ArtistTempDocument::class, 'id', 'temp_data_id');
    }

    public function Nationality()
    {
        return $this->belongsTo(Countries::class, 'nationality',  'country_id');
    }

    public function Profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
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
        return $this->belongsTo(VisaType::class, 'visa_type_id', 'id');
    }
}
