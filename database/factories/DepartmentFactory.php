<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'dep_name'=>$faker->company
    ];
});
