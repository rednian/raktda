<?php

namespace App;
use Auth;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'requirement';
    protected $primaryKey = 'requirement_id';

    protected $fillable = ['requirement_name', 'requirement_name_ar', 'dates_required', 'requirement_description', 'requirement_description_ar', 'term', 'requirement_type', 'status', 'created_by', 'updated_by', 'deleted_by', 'validity', 'type', 'is_mandatory'];

    public function company()
    {
        return $this->hasMany(CompanyRequirement::class, 'requirement_id');
    }

    public function eventLiquorTruck()
    {
        return $this->hasMany(EventLiquorTruckRequirement::class, 'requirement_id');
    }

    public function eventRequirement()
    {
        return $this->hasMany(EventRequirement::class, 'requirement_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_requirement', 'requirement_id', 'event_id')
            ->withPivot(['path', 'issued_date', 'expired_date', 'type'])
            ->withTimestamps();
    }

    public function additionalRequirements()
    {
        return $this->belongsToMany(Requirement::class, 'event_additional_requirement', 'requirement_id', 'event_id')->where('requirement_type', 'event');
    }

    public function requirementDocument()
    {
        return $this->hasMany(ArtistPermitDocument::class, 'document_id');
    }

    public function type()
    {
        return $this->belongsToMany(EventType::class, 'event_type_requirement', 'requirement_id', 'event_type_id');
    }

    public function event_type_requirements()
    {
        return $this->hasMany(EventTypeRequirement::class, 'requirement_id');
    }

    public function getNameAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->requirement_name) : ucfirst($this->requirement_name_ar);
    }

}
