<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'emp_name'=>$faker->name,
        // 'emp_company_id'=>$faker->companyNumber,
        'emp_mobile'=>$faker->phoneNumber,
        // 'emp_designation'=>$faker->department,
        'dep_id'=>1,
    ];
});
