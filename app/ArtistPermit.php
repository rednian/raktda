<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ArtistPermit extends Model
{
     // use SoftDeletes; 
      protected $table = 'artist_permit';
      protected $primaryKey = 'artist_permit_id';
      protected $fillable = [
        'work_location', 'permit_status', 'issued_date', 'expired_date',
        'company_id', 'created_by', 'updated_by', 'deleted_by'
      ];

      public function scoperequestType($q, $type)
      {
        return $q->select('*', DB::raw('COUNT(artist_id) as artist_number'), DB::raw('artist_permit.created_at AS submitted_on') )
                 ->join('artist', 'artist_permit.artist_permit_id', '=', 'artist.artist_permit_id')
                 ->join('bls.company', 'bls.company.company_id', '=', 'artist_permit.company_id')
                 ->where('artist_permit.permit_status', $type)
                 ->groupBy('artist_permit.company_id');
      }


      public function scopeArtistPermit($query, $request)
      {
        return $query->join('artist', 'artist_permit.artist_permit_id', '=', 'artist.artist_permit_id')
                     ->join('bls.company', 'bls.company.company_id', '=', 'artist_permit.company_id')
                     ->orderBy('artist_permit.company_id', 'DESC')  
                    ->orderBy('artist_permit.created_at', 'DESC')
                    ->where('permit_status', '!=', 'new')
                    ->when($request->company_id, function($q) use ($request){
                        $q->where('artist_permit.company_id', $request->company_id);
                    });
      }

      public function artist()
      {
        return $this->hasMany(Artist::class, 'artist_permit_id');
      }


      public function payment()
      {
        return $this->belongsToMany(PaymentTransaction::class, 'artist_payment', 'artist_permit_id','payment_id');
      }

  
}
