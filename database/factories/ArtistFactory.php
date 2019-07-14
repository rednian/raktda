<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Artist;
use Faker\Generator as Faker;

$factory->define(Artist::class, function (Faker $faker) {
    $timestamp = mt_rand(1, time());
    return [
        'name'=>$faker->name,
        // 'emp_company_id'=>$faker->companyNumber,
        'nationality'=>$faker->phoneNumber,
        // 'emp_designation'=>$faker->department,
        'passport_number'=>$faker->ean13,
        'uid_number'=>$faker->uuid,
        'birthdate'=>date("d M Y", $timestamp),
        'mobile_number'=>$faker->phoneNumber,
        'phone_number'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'company_id'=>1,

    ];
});
