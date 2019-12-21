<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyComment extends Model
{
	protected $table = 'company_comment';
	protected $primaryKey = 'company_comment_id';
	protected $fillable = ['comment_en', 'comment_ar' , 'action', 'company_id', 'user_id'];
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
