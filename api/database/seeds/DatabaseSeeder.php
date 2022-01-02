<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DiseasesTableSeeder::class);
        factory('App\Patient', 100)->create();
        $this->call(AddressTablesSeeder::class);
        $this->call(ABDFieldsTableSeeder::class);
        $this->call(AESFieldsTableSeeder::class);
        $this->call(AHFSFieldsTableSeeder::class);
        $this->call(BacterialMeningitisFieldsTableSeeder::class);
        $this->call(CholeraFieldsTableSeeder::class);
        $this->call(DiptheriaFieldsTableSeeder::class);
        $this->call(PSHFieldsTableSeeder::class);
        $this->call(DengueFeverFieldsTableSeeder::class);
        $this->call(AEFIFieldsTableSeeder::class);
        $this->call(AFPFieldsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        $this->call(MorbidityReportsTableSeeder::class);
    }
}
