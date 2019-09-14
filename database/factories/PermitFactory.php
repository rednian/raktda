<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Permit;
use Faker\Generator as Faker;

$factory->define(Permit::class, function (Faker $faker) {
    return [
        'reference_number'=>$faker->randomNumber($nbDigits = NULL, $strict = false),
        'work_location'=>$faker->address,
        'request_type'=>'new',
        // 'request_type'=>$faker->randomElement($array = array ('new','renew','')),
        'permit_status'=>'pending',
        'company_id'=>rand(62, 91),
        'created_at'=>$faker->date($format = 'Y-m-d', $max = '2010-1-1'),

    ];
});
