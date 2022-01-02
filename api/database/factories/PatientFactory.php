<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    $genders = [
        'Male', 
        'Female'
    ];

    return [
        'patient_no' => $faker->year."-".$faker->numberBetween($min = 1000, $max = 9000),
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'age' => $faker->randomDigit(2),
        'gender' => $genders[array_rand($genders)],
    ];
});
