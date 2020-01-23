<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class CompanyComment extends Model
{
	protected $table = 'company_comment';
	protected $primaryKey = 'company_comment_id';
	protected $fillable = ['comment_en', 'comment_ar' , 'action', 'company_id', 'user_id', 'request_type'];
	protected $dates = ['created_at', 'updated_at'];

	public function company()
	{
		return $this->belongsTo(Company::class, 'company_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function getCommentAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->comment_en) :  ucfirst($this->comment_ar);
    }


}
