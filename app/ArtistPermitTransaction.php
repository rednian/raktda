<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistPermitTransaction extends Model
{
    use SoftDeletes;
     protected $table = 'artsit_permit_transaction';
     protected $primaryKey = 'artsit_permit_transaction_id';
     protected $fillable = [ 'amount', 'transaction_type', 'artist_permit_id', 'transaction_id'];


}
