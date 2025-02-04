<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventApprover extends Model
{
	protected $connection = 'mysql';
	protected $table = 'smartrak_smartgov.event_approver';
	protected $primaryKey = 'event_approver_id';
	protected $fillable = ['event_id', 'user_id', 'role_id', 'status', 'event_comment_id', 'type', 'checked_at'];
	protected $dates = ['created_at', 'updated_at', 'checked_at'];

	public function event()
	{
		return $this->belongsTo(Event::class, 'event_id');
	}

	public function role()
	{
		return $this->belongsTo(Roles::class, 'role_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id')->withDefault(['NameEn'=> null, 'NameAr'=>null]);
	}

	public function comment()
	{
		return $this->belongsTo(EventComment::class, 'event_comment_id')->withDefault(['comment'=>'']);
	}
}
