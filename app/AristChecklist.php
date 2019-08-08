<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AristChecklist extends Model
{
    protected $table = 'artist_checklist';
    protected $primaryKey = 'checklist_id';
    protected $fillable = [
        'checklist_status', 'field_name', 'artist_permit_id', 'permit_comment_id', 'created_by', 'updated_by', 'deleted_by'
    ];

    public function comment()
    {
        return $this->belongsTo(PermitComment::class:: 'permit_comment_id');
    }

    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class, 'artist_permit_id');
    }

}
