<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = 'smartrak_smartgov.approval';
    protected $primaryKey = 'approval_id';
    protected $fillable = ['type', 'inspection_id', 'schedule_date', 'created_by', 'updated_by', 'deleted_by'];
    protected $dates = ['created_at', 'updated_at'];

    public $permit_type;


    public function permit()
    {
        if($this->type == 'event'){
            return $this->belongsTo(Event::class, 'inspection_id', 'event_id');
        }

        if($this->type == 'artist'){
            return $this->belongsTo(Permit::class, 'inspection_id', 'permit_id');
        }

        if($this->type == 'classification'){
            
        }
    }   

    public function report()
    {
        return $this->hasMany(ApprovalReport::class, 'approval_id');
    }

    public function approver()
    {
        return $this->hasMany(Approvers::class, 'approval_id');
    }

}
