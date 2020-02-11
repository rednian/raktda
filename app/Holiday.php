<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holiday extends Model
{
    use SoftDeletes;

    protected $table = 'holiday';
    protected $primaryKey = 'holiday_id';
    protected $fillable = [
        'holiday_name', 'holiday_name_ar', 'holiday_start', 'holiday_end', 'is_working'
    ];

    public function getNameAttribute()
    {
    	return auth()->user()->LanguageId == 1 ? ucfirst($this->holiday_name) : ucfirst($this->holiday_name_ar);
    }
}
