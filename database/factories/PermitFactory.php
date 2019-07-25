<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Permit;
use Faker\Generator as Faker;

$factory->define(Permit::class, function (Faker $faker) {
    return [
        'permit_number'=>$faker->postcode,
        'work_location'=>$faker->address,
        'permit_status'=>'pending',
        'company_id'=>rand(62, 84),
    ];
});
