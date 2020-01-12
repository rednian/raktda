<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistPermitTransaction extends Model
{
    use SoftDeletes;
    protected $table = 'artist_permit_transaction';
    protected $primaryKey = 'artist_permit_trans_id';
    protected $fillable = ['amount', 'vat', 'transaction_type', 'artist_permit_id', 'transaction_id', 'permit_id'];

    public function artistPermit()
    {
        return $this->belongsTo(ArtistPermit::class,'artist_permit_id');
    }

    public function permit()
    {
        return $this->belongsTo(Permit::class,'permit_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }

    public function permit(){
        return $this->belongsTo(Permit::class, 'permit_id');
    }

}
