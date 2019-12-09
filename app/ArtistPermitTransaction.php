<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistPermitTransaction extends Model
{
    use SoftDeletes;
    protected $table = 'artist_permit_transaction';
    protected $primaryKey = 'artist_permit_transaction_id';
    protected $fillable = ['amount', 'vat', 'transaction_type', 'artist_permit_id', 'transaction_id'];

}
