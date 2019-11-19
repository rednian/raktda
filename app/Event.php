<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{

    protected $connection = 'mysql';
    protected $table = 'smartrak_smartgov.event';
    protected $primaryKey = 'event_id';
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'issued_date', 'expired_date', 'lock'];
    protected $casts = ['is_display_web' => 'boolean', 'is_display_all'=>'boolean'];
    protected $fillable = [
        'name_en', 'name_ar', 'street', 'logo_thumbnail', 'logo_original', 'reference_number', 'issued_date', 'expired_date', 'time_start', 'time_end', 'permit_number', 'venue_en', 'venue_ar', 'description_en', 'description_ar',
        'country_id', 'event_type_id', 'area_id', 'emirate_id', 'status', 'address', 'is_display_web', 'is_display_all', 'last_check_by', 'lock', 'created_by','note_en', 'note_ar'
    ];
    public function permits()
    {
        return $this->belongsToMany(Permit::class, 'event_artist_permit', 'event_id', 'permit_id');
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
        return $this->belongsToMany(Requirement::class, 'event_additional_requirement', 'event_id', 'requirement_id')->where('requirement_type', 'event');
    }

    public function approve()
    {
        return $this->hasMany(EventApprover::class, 'event_id');
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
        return $this->belongsToMany(Requirement::class, 'event_requirement', 'event_id', 'requirement_id')
            ->where('requirement_type', 'event')
            ->withPivot(['path', 'issued_date', 'expired_date'])
            ->withTimestamps();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function area()
    {
        return $this->belongsTo(Areas::class, 'area_id', 'id')->withDefault(['name_en'=> null, 'name_ar'=>null]);
    }

    public function emirate()
    {
        return $this->belongsTo(Emirates::class, 'emirate_id', 'id')->withDefault(['name_en'=> null, 'name_ar'=>null]);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withDefault(['name_en'=> null, 'name_ar'=>null]);
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

    public function setExpiredDateAttribute($date)
    {
        $this->attributes['expired_date'] = Carbon::parse($date)->format('Y-m-d');
    }
}
