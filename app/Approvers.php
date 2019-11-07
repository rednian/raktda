<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approvers extends Model
{
    protected $table = 'smartrak_smartgov.approvers';
    protected $primaryKey = 'approver_id';
    protected $fillable = ['user_id', 'status', 'approval_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function approval()
    {
        return $this->belongsTo(Approval::class, 'approval_id');
    }

    public function report()
    {
        return $this->hasMany(ApprovalReport::class, 'approver_id');
    }

}
