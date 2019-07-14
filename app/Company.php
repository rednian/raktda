<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
     //use SoftDeletes; 
     protected $connection = 'bls';
     protected $table = 'company';
     protected $primaryKey = 'company_id';
     //protected $fillable = ['company_name', 'company_address', 'country', 'city', ''];  
     //
    
    public function document()
    {
        return $this->hasMany(CompanyDocument::class, 'company_id');
    } 
    
    public function permit()
    {
        return $this->hasMany(Permit::class, 'company_id');
    }

}
