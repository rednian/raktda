<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name_en'=>$faker->company,
        'name_ar'=>$faker->company,
        'country_id'=>232,
        'emirate_id'=>5,
        'address'=>$faker->streetAddress,
        'email'=>$faker->email,
        'street'=>$faker->streetName,
        'phone_number'=>$faker->phoneNumber,
        'trade_license'=>$faker->swiftBicNumber,
        'status'=>'active',
    ];
});
