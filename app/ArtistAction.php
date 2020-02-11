<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class ArtistAction extends Model
{
	protected  $connection = 'mysql';
	protected $table = 'smartrak_smartgov.artist_action';
	protected $primaryKey = 'artist_action_id';
	protected $fillable = ['artist_id', 'user_id', 'remarks','remarks_ar', 'action'];
	protected $dates = ['created_at', 'updated_at'];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	public function  artist()
	{
		return $this->belongsTo(Artist::class, 'artist_id');
	}


	public function getRemarksAttribute()
	{
		return Auth::user()->LanguageId == 1 ? ucfirst($this->remarks_en) : ucfirst($this->remarks_ar);
	}

	// public function getRemarksAttribute()
	// {
	// 	return Auth::user()->LanguageId == 1 ? ucfirst($this->remarks) : ucfirst($this->remarks_ar);
	// }

}
