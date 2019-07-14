<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
     protected $table = 'payment_transaction';
     protected $primaryKey = 'payment_id';
     protected $fillable = [
        'reference_no', 'amount', 'company_id', 'created_by', 'updated_by'
    ];
}
