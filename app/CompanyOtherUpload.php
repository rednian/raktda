<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyOtherUpload extends Model
{
	protected $table = 'company_other_upload';
	protected $primaryKey = 'company_other_upload_id';
	protected $fillable = ['name_en', 'name_ar'];

	public function company()
	{
		return $this->hasMany(CompanyRequirement::class, 'company_requirement_id', 'company_other_upload_id');
	}
}
