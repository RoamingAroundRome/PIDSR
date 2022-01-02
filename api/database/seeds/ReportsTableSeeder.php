<?php

use App\Disease;
use App\Patient;
use App\Report;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_PH');

        $patients = Patient::get();

        $role = Role::whereName('officer')->first();
        // $diseases = Disease::all()->pluck('id')->toArray();
        $diseases = [ 1 ];
        $investigators = User::role($role)->get()->pluck('id')->toArray();
     
        foreach($patients as $patient) {
            Report::create([
                'uuid' => $faker->uuid,
                'investigator_id' => $investigators[array_rand($investigators)],
                'disease_id' => $diseases[array_rand($diseases)],
                'patient_id' => $patient->id,
                'date_of_entry' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
                'date_admitted' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
                'date_of_onset' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
                'date_of_investigation' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now'),
                'admit_to_entry' => $faker->randomDigit(2),
                'onset_to_admit' => $faker->randomDigit(2),
                'time_of_investigation' => $faker->time($format = 'H:i:s', $max = 'now'),
                'time_of_onset' => $faker->time($format = 'H:i:s', $max = 'now'),
            ]);
        }
    }
}
