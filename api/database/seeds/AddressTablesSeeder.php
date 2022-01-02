<?php

use App\Address;
use App\Patient;
use Illuminate\Database\Seeder;

class AddressTablesSeeder extends Seeder
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

        $barangays = [
            'Abra',
            'Apayao',
            'Poblacion',
            'Ifugao'
        ];
        
        $regions = [
            "Autonomous Region in Muslim Mindanao", 
            // "Bicol", 
            // "Cagayan Valley", 
            // "Calabarzon", 
            // "Caraga", 
            // "Central Luzon", 
            // "Central Visayas", 
            // "Cordillera Administrative Region", 
            // "Davao", 
            // "Eastern Visayas", 
            // "Ilocos", 
            // "Mimaropa", 
            // "National Capital Region", 
            // "Northern Mindanao", 
            // "Soccsksargen", 
            // "Western Visayas", 
            // "Zamboanga Peninsula"
        ];

        foreach($patients as $patient) {
            $address = new Address([
                'region' => $regions[array_rand($regions)],
                'province' => $faker->province,
                'municity' => $faker->municipality,
                'barangay' => $barangays[array_rand($barangays)],
                'street' => $faker->streetAddress,
                'district' => $faker->streetName,
                'lat' => $faker->latitude,
                'lng' => $faker->longitude,
            ]);
            $patient->address()->save($address);
        }
    }
}
