<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $table = 'transaction';
    protected $primaryKey = 'transaction_id';
    protected $fillable = ['reference_number', 'transaction_type', 'transaction_date', 'company_id', 'user_id', 'created_by'];

    public function artistPermitTransaction()
    {
        return $this->hasMany(ArtistPermitTransaction::class, 'transaction_id');
    }

    public function artistPermit()
    {
        return $this->belongsToMany(ArtistPermit::class, 'artsit_permit_transaction', 'transaction_id', 'artist_permit_id')->withPivot('amount');
    }
}
