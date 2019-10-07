<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistAction extends Model
{
	protected  $connection = 'mysql';
	protected $table = 'artist_action';
	protected $primaryKey = 'artist_action_id';
	protected $fillable = ['artist_id', 'employee_id', 'remarks', 'action'];
	protected $dates = ['created_at', 'updated_at'];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'employee_id');
	}
	public function  artist()
	{
		return $this->belongsTo(Artist::class, 'artist_id');
	}
}
