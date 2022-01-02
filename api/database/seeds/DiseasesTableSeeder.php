<?php

use App\Disease;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $disease = new Disease();
        
        foreach($disease->getImmediatelyNotifiable() as $data) {
            Disease::create([
                'name' => $data,
                'slug' => Str::slug($data),
                'alert_threshold' => 1,
                'category' => 'immediately notifiable',
            ]);
        }

        foreach($disease->getWeeklyNotifiable() as $data) {
            Disease::create([
                'name' => $data,
                'slug' => Str::slug($data),
                'alert_threshold' => 5,
                'category' => 'weekly notifiable',
            ]);
        }
    }
}
