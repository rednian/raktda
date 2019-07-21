<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Artist;
use Faker\Generator as Faker;

$factory->define(Artist::class, function (Faker $faker) {
    $timestamp = mt_rand(1, time());
    return [
        'name'=>$faker->name,
        'nationality'=>$faker->country,
        'passport_number'=>$faker->swiftBicNumber,
        'uid_number'=>$faker->uuid,
        'birthdate'=>date("d M Y", $timestamp),
        'mobile_number'=>$faker->phoneNumber,
        'phone_number'=>$faker->phoneNumber,
        'email'=>$faker->email,
        'company_id'=>rand(62, 84),
        'artist_permit_id'=>rand(1, 20),
        'artist_status'=>'active',
        'profession'=>$faker->jobTitle,

    ];
});
