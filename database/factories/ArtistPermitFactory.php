<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ArtistPermit;
use Faker\Generator as Faker;

$factory->define(ArtistPermit::class, function (Faker $faker) {
    return [
        'artist_permit_status'=> 'active',
        'artist_id'=>rand(67, 126),
        'permit_id'=>rand(151, 210),
        'permit_type_id'=>rand(4, 6),
    ];
});
