<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'bls';
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $fillable = [
        'company_name', 'company_address', 'company_type', 'company_mobile_number', 
        'company_email', 'company_status', 'contact_person', 'contact_person_designation', 
        'company_phone_number', 'company_trade_license'
    ];

    public function documents()
    {
        return $this->hasMany(CompanyDocument::class, 'company_id');
    }
}
