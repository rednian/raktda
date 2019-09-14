<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Artist;
use Faker\Generator as Faker;

$factory->define(Artist::class, function (Faker $faker) {
    $timestamp = mt_rand(1, time());
    return [
        'person_code'=> rand(3434, 4000),
        'firstname_en'=>$faker->firstName,
        'lastname_en'=>$faker->lastName,
        'nationality_en'=>$faker->country,
        'birthdate'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'artist_status'=>'active',

    ];
});
