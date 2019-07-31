<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitComment extends Model
{
    protected $table = 'permit_comment';
    protected $primaryKey = 'permit_comment_id';
    protected $fillable = [
        'comment', 'user_id', 'artist_permit_id', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function checklist()
    {
        return $this->hasMany(ArtistChecklist::class, 'checklist_id');
    }

    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }
}
