<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Transaction::class, function (Faker $faker) {
    return [
        //
        'reference_number'=>'TRN'.$faker->numberBetween($min = 200, $max =300 ),
        'transaction_type'=>'event',
        'transaction_date'=>$faker->dateTimeBetween('-1 week', '-1 month'),
        'company_id'=>function(){
           return \App\Company::all()->random()->company_id;
        },
        'payment_transaction_id'=>'EWPD'.$faker->numberBetween($min = 100, $max =200 ),
'created_by'=>2,
    ];
});
