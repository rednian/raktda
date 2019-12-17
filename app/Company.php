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
        'name_en', 'name_ar', 'logo_original', 'logo_thumbnail', 'status', 'company_email', 'phone_number', 'website', 'trade_license', 'trade_license_issued_date', 'trade_license_expired_date', 'aread_id', 'emirate_id', 'country_id', 'address', 'application_date'. 'reference_number', 'company_type_id', 'registered_date', 'registered_by'
    ];
    protected $dates = ['created_at', 'updated_at', 'application_date', 'registered_date', 'trade_license_issued_date', 'trade_license_expired_date'];


    public function comment()
    {
        return $this->hasMany(CompanyComment::class, 'company_id');
    }


    public function event()
    {
        return $this->hasManyThrough(Event::class, User::class, 'EmpClientId', 'created_by', 'company_id', 'user_id')->where('status','!=', 'draft');
    }  

    public function permit()
    {
        return $this->hasManyThrough(Permit::class, User::class, 'EmpClientId', 'created_by', 'company_id', 'user_id')->where('permit_status','!=', 'draft');
    }


    public function type()
    {
        return $this->belongsTo(CompanyType::class, 'company_type_id');
    }


    public function user()
    {
        return $this->hasMany(User::class, 'EmpClientId', 'company_id');
    }

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
        return $this->hasOne(CompanyContact::class, 'company_id')->withDefault(['contact_name_en'=>null, 'contact_name_ar'=>null]);
    }


    public function requirement()
    {
        return $this->hasMany(CompanyRequirement::class, 'company_id');
    }
}
