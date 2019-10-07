<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventApprover extends Model
{
	protected $connection = 'mysql';
	protected $table = 'event_approver';
	protected $primaryKey = 'event_approver_id';
	protected $fillable = ['event_id', 'user_id', 'role_id', 'type', 'comment', 'status', 'step'];

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
}
