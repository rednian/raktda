<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitReference extends Model
{
	protected $table = 'permit_reference';
	protected $primaryKey = 'permit_reference_id';
	protected $fillable = ['user_id'];
	protected $dates = ['created_at', 'updated_at'];

	public function permit()
	{
		return $this->hasMany(Permit::class, 'permit_reference_id');
	}

	public function createdBy()
	{
		return $this->hasMany(User::class, 'user_id');
	}
}
