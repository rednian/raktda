<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //use SoftDeletes;
    // protected $connection = 'bls';
    protected $table = 'company';
    // protected $table = 'smartrak_bls.company';
    protected $primaryKey = 'company_id';
    protected $fillable = [

        'company_name', 'company_address', 'company_type', 'company_mobile_number', 'company_email', 'comapany_status',

        'name_en', 'name_er', 'logo_original', 'logo_thumbnail', 'type', 'status', 'email', 'phone_number', 'website', 'trade_license', 'trade_license_issued_date', 'trade_license_expired_date', 'aread_id', 'emirate_id', 'country_id', 'address', 'application_date'. 'reference_number'
    ];

    protected $dates = ['created_at', 'updated_at', 'application_date', 'issued_date', 'expired_date'];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withDefault(['name_en'=> null, 'name_er'=>null]);
    }

    public function area()
    {
        return $this->belongsTo(Areas::class, 'area_id', 'id')->withDefault(['area_en'=>null, 'area_ar'=>null]);
    }

    public function emirate()
    {
        return $this->belongsTo(Emirates::class, 'emirate_id', 'id')->withDefault(['name_en'=> null, 'name_er'=>null]);
    }

    public function contact()
    {
        return $this->hasOne(CompanyContact::class, 'company_id')->withDefault(['name_en'=>null, 'name_ar'=>null]);
    }

    public function requirement()
    {
        return $this->hasMany(CompanyRequirement::class, 'company_id');
    }

    public function permit()
    {
        return $this->hasMany(Permit::class, 'company_id');
    }
}
