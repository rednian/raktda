<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyRequirement extends Model
{
    // use SoftDeletes;
    // protected $connection = 'bls';
    protected $table = 'company_requirement';
    protected $primaryKey = 'company_requirement_id';
    protected $fillalble = ['company_id', 'issued_date', 'expired_date', 'path', 'requirement_id', 'page_number'];

    public function requirement()
    {
      return $this->belongsTo(Requirement::class, 'requirement_id')->where('requirement_type', 'company');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
