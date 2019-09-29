<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistAction extends Model
{
	protected  $connection = 'mysql';
	protected $table = 'artist_action';
	protected $primaryKey = 'artist_action_id';
	protected $fillable = ['artist_id', 'user_id', 'remarks', 'action'];
	protected $dates = ['created_at', 'updated_at'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	public function  artist()
	{
		return $this->belongsTo(Artist::class, 'artist_id');
	}
}
