<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{
    protected $connection = 'bls';
    protected $table = 'company_document';
    protected $primaryKey = 'doc_id';
    protected $fillable = ['doc_name', 'doc_path', 'doc_issued_date', 'doc_expired_date', 'company_id'];

    public function company()
    {
        return $this->belongTo(Company::class, 'company_id');
    }
}
