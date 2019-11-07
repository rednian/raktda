<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApprovalReport extends Model
{
    protected $table = 'approval_report';
    protected $primaryKey = 'approval_report_id';
    protected $fillable = ['approval_id', 'approver_id', 'thumbnail', 'original'];
    protected $dates = ['created_at', 'updated_at'];




    public function approval()
    {
        return $this->belongsTo(Approval::class, 'approval_id');
    }

    public function approver()
    {
        return $this->belongsTo(Approvers::class, 'approver_id');
    }
}
