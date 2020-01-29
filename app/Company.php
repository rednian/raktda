<?php
namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //use SoftDeletes;
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $fillable = [
        'name_en', 'name_ar', 'logo_original', 'logo_thumbnail', 'status', 'company_email', 'phone_number', 'website', 'trade_license', 
        'trade_license_issued_date', 'trade_license_expired_date', 'area_id', 'emirate_id', 'country_id', 'address', 'application_date', 
        'reference_number', 'company_type_id', 'registered_date', 'registered_by', 'company_description_ar','company_description_en',
        'request_type'
    ];
    
    protected $dates = ['created_at', 'updated_at', 'application_date', 'registered_date', 'trade_license_issued_date', 'trade_license_expired_date'];

    public function getFullAddressAttribute()
    {
        return ucfirst($this->address).", {$this->area->name}, {$this->emirate->name}, {$this->country->name}";
    }
    

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'company_artist', 'company_id', 'artist_id');
    }

    public function request()
    {
        return $this->hasMany(CompanyRequest::class, 'company_id');
    }


    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by', 'user_id');
    }

    public function setTradeLicenseIssuedDateAttribute($date)
    {
        $this->attributes['trade_license_issued_date'] = Carbon::parse($date)->format('Y-m-d');
    } 

    public function setTradeLicenseExpiredDateAttribute($date)
    {
        $this->attributes['trade_license_expired_date'] = Carbon::parse($date)->format('Y-m-d');
    }

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

    public function users(){
        return $this->hasMany(User::class, 'EmpClientId', 'company_id');
    }

    public function getNameAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->name_en) : ucfirst($this->name_ar);
    }

     public function getDescriptionAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->company_description_en) : ucfirst($this->company_description_ar);
    }
}
