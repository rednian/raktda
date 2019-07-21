<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'company_name'=>$faker->company,
        'country'=>$faker->country,
        'city'=>$faker->city,
        'contact_person'=>$faker->name,
        'company_email'=>$faker->email,
        'company_trade_license'=>$faker->swiftBicNumber,
        'contact_person_designation'=>$faker->jobTitle,
        'company_phone_number'=>$faker->phoneNumber,
        'company_address'=>$faker->streetAddress,
        'company_status'=>'active',
    ];
});
