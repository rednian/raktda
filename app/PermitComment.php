<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitComment extends Model
{
    protected $table = 'permit_comment';
    protected $primaryKey = 'permit_comment_id';
    protected $fillable = [
        'comment', 'user_id', 'permit_id', 'comment_status', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function check()
    {
        return $this->belongsToMany(ArtistPermit::class, 'artist_permit_check','artist_permit_check_id', 'permit_comment_id');
    }

    public function artistPermit()
    {
        return $this->belongsToMany(ArtistPermit::class, 'artist_permit_comment','artist_permit_id', 'permit_comment_id');
    }

    public function checklist()
    {
        return $this->check()->belongsTo(ArtistPermitChecklist::class, 'artist_permit_check_id');
    }
}
