<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
	protected $table = 'smartrak_smartgov.event_comment';
	protected $primaryKey = 'event_comment_id';
	protected $fillable = ['event_id', 'user_id', 'type', 'comment', 'comment_ar', 'action', 'user_type', 'role_id', 'government_id','exempt_payment', 'exempt_percentage'];
	protected $dates = ['created_at', 'updated_at'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function event()
	{
		return $this->belongsTo(Event::class, 'event_id');
	}

	public function approve()
	{
		return $this->hasOne(EventApprover::class, 'event_comment_id');
	}

	public function government(){
		return $this->belongsTo(Government::class, 'government_id');
	}

	public function role(){
		return $this->belongsTo(Roles::class, 'role_id');
	}

	public function getRemarksAttribute()
	{
		return Auth::user()->LanguageId == 1 ? ucfirst($this->comment) : ucfirst($this->comment_ar);
	}

}
