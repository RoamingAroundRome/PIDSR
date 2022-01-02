<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Disease;
use App\Patient;
use App\Report;
use App\User;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;

$factory->define(Report::class, function (Faker $faker) {
    $role = Role::whereName('officer')->first();
    // $diseases = Disease::all()->pluck('id')->toArray();
    $diseases = [ 1 ];
    $patients = Patient::all()->pluck('id')->toArray();
    $investigators = User::role($role)->get()->pluck('id')->toArray();
    
    return [
        'uuid' => $faker->uuid,
        'investigator_id' => $investigators[array_rand($investigators)],
        'disease_id' => $diseases[array_rand($diseases)],
        'patient_id' => $patients[array_rand($patients)],
        'date_of_entry' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
        'date_admitted' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
        'date_of_onset' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
        'date_of_investigation' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
        'admit_to_entry' => $faker->randomDigit(2),
        'onset_to_admit' => $faker->randomDigit(2),
        'time_of_investigation' => $faker->time($format = 'H:i:s', $max = 'now'),
        'time_of_onset' => $faker->time($format = 'H:i:s', $max = 'now'),
    ];
});
