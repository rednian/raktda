<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
	protected $table = 'event_comment';
	protected $primaryKey = 'event_comment_id';
	protected $fillable = ['event_id', 'user_id', 'type', 'comment'];
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

}
