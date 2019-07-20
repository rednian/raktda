<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ArtistPermit;
use Faker\Generator as Faker;

$factory->define(ArtistPermit::class, function (Faker $faker) {
    return [
        'permit_number'=>$faker->creditCardNumber,
        'work_location'=>$faker->streetAddress,
        'permit_status'=>'new',
        'company_id'=>rand(62, 84),
    ];
});
