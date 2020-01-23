<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRequest extends Model
{
    protected $table = 'company_request';
    protected $primaryKey = 'company_request_id';
    protected $fillable = ['company_id', 'type', 'created_by'];
    protected $dates = ['created_at', 'updated_at'];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

}
