<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyArtist extends Model
{ 
	protected $table = 'company_artist';
	protected $primaryKey = 'company_artist_id';
	protected $fillable = ['artist_id', 'company_id'];

	public function artist()
	{
		return $this->belongsTo(Artist::class, 'artist_id');
	}

	public function company()
	{
		return $this->belongsTo(Company::class, 'company_id');
	}
}

