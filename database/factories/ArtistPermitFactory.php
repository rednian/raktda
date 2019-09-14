<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ArtistPermit;
use Faker\Generator as Faker;

$factory->define(ArtistPermit::class, function (Faker $faker) {
    return [
        'artist_permit_status'=> 'active',
        'artist_id'=>rand(148, 197),
        'permit_id'=>rand(310, 319),
        'permit_type_id'=>rand(4, 6),
        'sponsor_name_en'=>$faker->name,
        'visa_expire_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'passport_expire_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'uid_expire_date'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'uid_number'=>$faker->iban('AE'),
        'visa_number'=>$faker->ean13,
        'passport_number'=>$faker->iban('PH'),  
        'email'=>$faker->email,
        'mobile_number'=>$faker->e164PhoneNumber,
        'phone_number'=>$faker->phoneNumber,
        'address_en'=>$faker->address,
        'city_en'=>$faker->city,
        'area_en'=>$faker->state,
        'po_box'=>$faker->postcode,


    ];
});
