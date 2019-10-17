<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventApprover extends Model
{
	protected $connection = 'mysql';
	protected $table = 'event_approver';
	protected $primaryKey = 'event_approver_id';
	protected $fillable = ['event_id', 'user_id', 'role_id', 'status', 'event_comment_id'];
	protected $dates = ['created_at', 'updated_at'];

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
		return $this->belongsTo(User::class, 'user_id');
	}

	public function comment()
	{
		return $this->belongsTo(EventComment::class, 'event_comment_id');
	}
}
