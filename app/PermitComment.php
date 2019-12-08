<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitComment extends Model
{
    protected $table = 'smartrak_smartgov.permit_comment';
    protected $primaryKey = 'permit_comment_id';
    protected $fillable = [ 'comment', 'user_id', 'permit_id', 'type', 'action', 'role_id', 'checked_date', 'exempt_payment'];
    protected  $dates = ['created_at', 'updated_at', 'checked_date'];

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id')->withDefault(['NameEn'=>null, 'NameAr'=>null]);
    }

    public function artistPermitComment()
    {
        return $this->belongsToMany(ArtistPermit::class, 'artist_permit_comment', 'permit_comment_id', 'artist_permit_id');
    }

    public function  user()
    {
    	return $this->belongsTo(User::class, 'user_id')->withDefault(['NameEn'=>null, 'NameAr'=>null]);
    }
    public function check()
    {
        return $this->belongsToMany(ArtistPermitCheck::class, 'artist_permit_comment','permit_comment_id', 'artist_permit_check_id');
    }

    public function approver()
    {
          return $this->hasMany(PermitApprover::class,'permit_comment_id');
    }

    public function artistPermit()
    {
        return $this->belongsToMany(ArtistPermit::class, 'artist_permit_comment','artist_permit_id', 'permit_comment_id');
    }

    public function getCheckedDateAttribute($value)
    {
        return !is_null($value) ? date('d-M-Y', strtotime($value)) : '';
    }
}
