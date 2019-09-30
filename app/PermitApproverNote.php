<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitApproverNote extends Model
{
    protected $table = 'permit_approver_note';
    protected $primaryKey = 'permit_approver_note_id';
    protected $fillable = ['permit_approver_id', 'permit_comment_id'];

    public function comment()
    {
    	return $this->belongsTo(PermitComment::class, 'permit_comment_id');
    }
}
