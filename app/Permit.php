<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{

     use SoftDeletes;
     protected $connection = 'mysql';
     protected $table = 'permit';
     protected $primaryKey = 'permit_id';
     protected $fillable = [
        'permit_number', 'issued_date', 'expired_date', 'work_location', 'permit_status',
        'company_id', 'created_by', 'updated_by', 'deleted_by', 'cancel_reason'
    ];
    protected $dates = ['created_at', 'issued_date', 'expired_date'];

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

    public function rivision()
    {
        return $this->hasMany(Rivision::class, 'permit_id');
    }

    public function scopeGetByStatus($query, $status)
    {
        return $this->select('*',DB::raw('COUNT(artist_permit.artist_id) AS artist_number'))
                    ->join('bls.company', 'permit.company_id', '=', 'bls.company.company_id')
                    ->join('artist_permit', 'permit.permit_id', '=', 'artist_permit.permit_id')
                    ->where('permit.permit_status', $status)
                    ->groupBy('artist_permit.permit_id');
    }
}
