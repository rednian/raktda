<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermitApprover extends Model
{
    protected $connection = 'mysql';
    protected $table = 'permit_approver';
    protected $primaryKey = 'permit_approver_id';
    protected $fillable = ['permit_id', 'role_id', 'time_start', 'time_end', 'procedure_id', 'status', 'permit_comment_id'];

    public function role()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function  comment()
    {
    	return $this->belongsTo(PermitComment::class, 'permit_comment_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    public function permit()
    {
        return $this->belongsTo(Permit::class, 'permit_id');
    }
}
