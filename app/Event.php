<?php

namespace App;
use Auth;
use App\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    protected $connection = 'mysql';
    protected $table = 'smartrak_smartgov.event';
    protected $primaryKey = 'event_id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'issued_date', 'expired_date', 'lock', 'approved_date', 'cancel_date'];
    protected $casts = ['is_display_web' => 'boolean', 'is_display_all' => 'boolean'];
    protected $fillable = [
        'name_en', 'no_of_trucks', 'name_ar', 'street', 'logo_thumbnail', 'logo_original', 'reference_number', 'issued_date',
        'expired_date', 'time_start', 'time_end', 'permit_number', 'venue_en', 'venue_ar', 'description_en', 'description_ar',
        'country_id', 'event_type_id', 'area_id', 'emirate_id', 'status', 'address', 'is_display_web', 'is_display_all',
        'last_check_by', 'lock', 'created_by', 'note_en', 'note_ar', 'cancelled_by', 'cancel_reason', 'latitude',
        'longitude', 'full_address', 'firm', 'is_liquor', 'is_truck', 'audience_number', 'paid', 'paid_artist_fee',
        'owner_name','owner_name_ar', 'request_type', 'additional_location_info','cancel_date', 'event_type_sub_id','exempt_payment',
        'exempt_by', 'approved_by', 'approved_date', 'exempt_percentage'];


    public function smsNotification()
    {
        return $this->hasMany(SMSNotfication::class, 'event_id', 'module_id')->whereType('event');
    }

    public function subType()
    {
        return $this->belongsTo(EventTypeSub::class, 'event_type_sub_id')->withDefault(['sub_name_en'=> null, 'sub_name_ar'=> null]);
    }


    public function approved()
    {
        return $this->belongsTo(User::class, 'approved_by', 'user_id')->withDefault(['NameEn'=> null,'NameAr'=>null]);
    }


    public function scopeLastMonth($q, $status)
    {
        return $q->whereHas('comment', function($q) use ($status){
            return $q->where('action', $status)->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->limit(1);
        });
    }

    public function transaction()
    {
        return $this->hasMany(EventTransaction::class, 'event_id');
    }
    public function eventTransaction()
    {
        return $this->hasMany(EventTransaction::class, 'event_id');
    }

    public function liquor()
    {
        return $this->hasOne(EventLiquor::class, 'event_id')->withDefault(['company_name_en'=>null, 'company_name_ar'=>null, 'provided'=> null]);
    }

    public function truck()
    {
        return $this->hasMany(EventTruck::class, 'event_id');
    }

    public function otherUpload()
    {
        return $this->hasMany(EventOtherUpload::class, 'event_id');
    }

    public function permit()
    {
        return $this->hasOne(Permit::class, 'event_id');
    }

    public function approval()
    {
        return $this->hasMany(Approval::class, 'event_id', 'approval_id');
    }

    public function eventRequirement()
    {
        return $this->hasMany(EventRequirement::class, 'event_id');
    }

    public function additionalRequirements()
    {
        return $this->hasMany(EventAdditionalRequiremment::class, 'event_id');
        // return $this->belongsToMany(Requirement::class, 'event_additional_requirement', 'event_id', 'requirement_id')->where('requirement_type', 'event');
    }

    public function check()
    {
        return $this->hasMany(EventCheck::class, 'event_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(EventComment::class, 'event_id');
    }

    public function requirements()
    {
        return  $this->hasMany(EventRequirement::class, 'event_id');
        // return $this->belongsToMany(Requirement::class, 'event_requirement', 'event_id', 'requirement_id')
        //     ->where('requirement_type', 'event')
        //     ->withPivot(['path', 'issued_date', 'expired_date', 'type'])
        //     ->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function area()
    {
        return $this->belongsTo(Areas::class, 'area_id', 'id')->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function emirate()
    {
        return $this->belongsTo(Emirates::class, 'emirate_id', 'id')->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withDefault(['name_en' => null, 'name_ar' => null]);
    }

    public function type()
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function getExpiredDateAttribute($date)
    {
        if (!$date) {
            return null;
        }
        return Carbon::parse($date)->format('d-M-Y');
    }

    public function getIssuedDateAttribute($date)
    {
        if (!$date) {
            return null;
        }
        return Carbon::parse($date)->format('d-M-Y');
    }

    public function getTimeStartAttribute($date)
    {
        if (!$date) {
            return null;
        }
        return Carbon::parse($date)->format('h:i a');
    }

    public function getTimeEndAttribute($date)
    {
        if (!$date) {
            return null;
        }
        return Carbon::parse($date)->format('h:i a');
    }

    public function setTimeStartAttribute($time)
    {
        $this->attributes['time_start'] = Carbon::parse($time)->format('H:i:s');
    }

    public function setTimeEndAttribute($time)
    {
        $this->attributes['time_end'] = Carbon::parse($time)->format('H:i:s');
    }

    public function setIssuedDateAttribute($date)
    {
        $this->attributes['issued_date'] = Carbon::parse($date)->format('Y-m-d');
    }


    public function setCountryIdAttribute()
    {
        $this->attributes['country_id'] = Country::where('country_code', 'AE')->first()->country_id;
    }


    public function setExpiredDateAttribute($date)
    {
        $this->attributes['expired_date'] = Carbon::parse($date)->format('Y-m-d');
    }

    public function getNameAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->name_en) : ucfirst($this->name_ar);
    }

    public function getNoteAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->note_en) : ucfirst($this->note_ar);
    }

    public function getVenueAttribute()
    {
        return auth()->user()->LanguageId ==1 ? ucfirst($this->venue_en) : ucfirst($this->venue_ar);
    }

    public function getDescriptionAttribute()
    {
        return auth()->user()->LanguageId == 1 ? ucfirst($this->description_en) : ucfirst($this->description_ar);
    }



}
