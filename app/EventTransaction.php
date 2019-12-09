<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTransaction extends Model
{
	protected $table = 'event_transaction';
	protected $primaryKey = 'event_transaction_id';
	protected $fillable = ['event_id', 'transaction_id', 'amount', 'vat', 'total_trucks', 'type'];
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	public function event()
	{
		return $this->belongsTo(Event::class, 'event_id');
	}

	public function transaction()
	{
		return $this->belongsTo(Transaction::class, 'transaction_id')->where('transaction_type','event');
	}
}
