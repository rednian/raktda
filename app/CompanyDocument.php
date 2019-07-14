<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
         use SoftDeletes; 
     protected $table = 'company';
     protected $primaryKey = 'company_id';

     public function company()
     {
        return $this->belongsTo(Company::class, 'company_id');
     }
}
