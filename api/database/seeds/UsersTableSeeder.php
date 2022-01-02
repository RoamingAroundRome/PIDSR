<?php

use App\Address;
use App\DRU;
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_PH');

        $roles = [
            'admin' => Role::create(['name' => 'admin']),
            'officer' => Role::create(['name' => 'officer']),
        ];
        
        $user = User::create([
            'first_name' => 'Rommel',
            'middle_name' => 'Mid',
            'last_name' => 'Cortes',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($roles['admin']);

        $user = User::create([
            'first_name' => 'Carlo Miguel',
            'middle_name' => 'Mid',
            'last_name' => 'Dy',
            'email' => 'dev@dev.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($roles['admin']);

        $address = new Address([
            'region' => $faker->streetAddress,
            'province' => $faker->streetAddress,
            'municity' => $faker->streetAddress,
            'barangay' => $faker->streetAddress,
            'street' => $faker->streetAddress,
            'district' => $faker->streetAddress,
        ]);
        $dru = DRU::create([
            'name' => 'DRU 1',
        ]);
        $dru->address()->save($address);
        $user = User::create([
            'dru_id' => 1,
            'first_name' => 'Ali',
            'middle_name' => 'L',
            'last_name' => 'Laut',
            'email' => 'ali@laut.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($roles['officer']);
        

        $address = new Address([
            'region' => $faker->streetAddress,
            'province' => $faker->streetAddress,
            'municity' => $faker->streetAddress,
            'barangay' => $faker->streetAddress,
            'street' => $faker->streetAddress,
            'district' => $faker->streetAddress,
        ]);
        $dru = DRU::create([
            'name' => 'DRU 2',
        ]);
        $dru->address()->save($address);
        $user = User::create([
            'dru_id' => 2,
            'first_name' => 'Vaugh',
            'middle_name' => 'L',
            'last_name' => 'Billones',
            'email' => 'vaughn@billones.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($roles['officer']);

        $address = new Address([
            'region' => $faker->streetAddress,
            'province' => $faker->streetAddress,
            'municity' => $faker->streetAddress,
            'barangay' => $faker->streetAddress,
            'street' => $faker->streetAddress,
            'district' => $faker->streetAddress,
        ]);
        $dru = DRU::create([
            'name' => 'DRU 3',
        ]);
        $dru->address()->save($address);
        $user = User::create([
            'dru_id' => 3,
            'first_name' => 'Prince Eme',
            'middle_name' => 'L',
            'last_name' => 'Billones',
            'email' => 'prince@billones.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($roles['officer']);
    }
}
