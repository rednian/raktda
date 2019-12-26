<?php

namespace App;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use SoftDeletes;
    protected $connection = 'mysql';
    protected $table = 'smartrak_smartgov.permit';
    protected $primaryKey = 'permit_id';
    protected $fillable = [
        'issued_date', 'expired_date', 'permit_number', 'work_location', 'permit_status', 'lock', 'user_id', 'permit_revision_id',
        'company_id', 'created_by', 'updated_by', 'deleted_by', 'cancel_reason', 'reference_number', 'request_type', 'happiness', 'event_id', 'term', 'paid', 'paid_event_fee', 'work_location_ar', 'lock_user_id', 'exempt_by','exempt_payment', 'permit_reference_id'
    ];
    protected $dates = ['created_at', 'issued_date', 'expired_date', 'lock'];

    public function scopeLastMonth($q, $status = [])
    {
        return $q->has('artist')->whereHas('comment', function($q) use ($status){
             $q->where('action', $status[0])->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])->limit(1);
        })->whereIn('permit_status', [$status]);
    }

    public function permitReference()
    {
        return $this->belongsTo(PermitReference::class, 'permit_reference_id');
    }


    public function scopeHistory($q, $permit_number)
    {
        if ($this->request_type == 'renew') {
            $permit_number = explode('-', $permit_number);
            return $q->whereNotIn('permit_status', ['cancelled', 'unprocessed', 'draft'])
                ->whereNotNull('permit_number')
                ->where('permit_number', 'like', '%' . $permit_number[0] . '%');
        }
        return false;
    }

    public function event()
    {
       return $this->belongsTo(Event::class,'event_id');
    }

    public function approval()
    {
        return $this->hasMany(Approval::class, 'inspection_id', 'permit_id')->whereType('artist');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by', 'user_id');
    }

    public function comment()
    {
        return $this->hasMany(PermitComment::class, 'permit_id');
    }

    public function check()
    {
        return $this->hasManyThrough(ArtistPermitCheck::class, ArtistPermit::class, 'permit_id', 'artist_permit_id', 'permit_id', 'artist_permit_id');
    }

    public function approver()
    {
        return $this->hasMany(PermitApprover::class, 'permit_id');
    }

    public function artistPermit()
    {
        return $this->hasMany(ArtistPermit::class, 'permit_id');
    }

    public function artist()
    {
        return $this->belongsToMany(Artist::class, 'artist_permit', 'permit_id', 'artist_id')->withPivot('artist_permit_status');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function revision()
    {
        return $this->belongsTo(PermitRevision::class, 'permit_revision_id');
    }

    public function scopeGetByStatus($query, $status)
    {
        return $this->select('*', DB::raw('COUNT(artist_permit.artist_id) AS artist_number'))
            ->join('bls.company', 'permit.company_id', '=', 'bls.company.company_id')
            ->join('artist_permit', 'permit.permit_id', '=', 'artist_permit.permit_id')
            ->where('permit.permit_status', $status)
            ->groupBy('artist_permit.permit_id');
    }

    public function getPermitApproval(){
        return $this->hasMany(Approval::class, 'inspection_id', 'permit_id')->where('type', 'artist');
    }
}
