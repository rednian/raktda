<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //use SoftDeletes;
    protected $connection = 'bls';
    protected $table = 'company';
    protected $primaryKey = 'company_id';
    protected $fillable = [
        'company_name', 'company_address', 'country', 'city', 'company_type', 'company_mobile_number',
        'company_email', 'company_status', 'contact_person', 'contact_person_designation', 'company_phone_number',
        'company_trade_license', 'city', 'country'
    ];

    public function document()
    {
        return $this->hasMany(CompanyDocument::class, 'company_id');
    }

    public function permit()
    {
        return $this->hasMany(Permit::class, 'company_id');
    }
}
