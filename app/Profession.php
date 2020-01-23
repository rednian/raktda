<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profession extends Model
{
    use SoftDeletes;
    protected $table = 'profession';
    protected $primaryKey = 'profession_id';
    protected $fillable = ['name_en', 'name_ar', 'amount', 'is_multiple', 'created_by', 'updated_by', 'deleted_by'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'profession_id');
    }

    public function createdBy(){
    	return $this->belongsTo(User::class, 'created_by', 'user_id')->withDefault([
	        'NameEn' => 'Not Available',
	        'NameAr' => 'Not Available'
	    ]);
    }
    public function getNameAttribute()
    {
        return Auth::user()->LanguageId == 1 ? ucfirst($this->name_en) : ucfirst($this->name_ar);
    }
}
