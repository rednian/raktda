<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyRequirement extends Model
{
    // use SoftDeletes;
    // protected $connection = 'bls';
    protected $table = 'company_requirement';
    protected $primaryKey = 'company_requirement_id';
    protected $fillable = ['company_id', 'issued_date', 'expired_date', 'path', 'requirement_id', 'page_number', 'is_submit'];
    protected $dates = ['issued_date', 'expired_date'];


    public function setIssuedDateAttribute($date)
    {
         $this->attributes['issued_date'] =  Carbon::parse($date)->format('Y-m-d');
    }

    public function setExpiredDateAttribute($date)
    {
         $this->attributes['expired_date'] =  Carbon::parse($date)->format('Y-m-d');
    }

    public function requirement()
    {
      return $this->belongsTo(Requirement::class, 'requirement_id')->where('requirement_type', 'company');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
