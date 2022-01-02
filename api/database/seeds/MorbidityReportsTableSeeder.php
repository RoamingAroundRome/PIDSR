<?php

use App\MorbidityReport;
use App\Report;
use App\ReportDetail;
use Illuminate\Database\Seeder;

class MorbidityReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('en_PH');

        $reports = Report::get();
        $outcomes = [
            "Alive (A)",
            "Died (D)",
            "Unconfirmed (U)",
        ];

        foreach($reports as $report) {
            $morbidityReport = new MorbidityReport([
                'week' => $faker->numberBetween($min = 1, $max = 53),
                'month' => $faker->numberBetween($min = 1, $max = 12),
                'year' => $faker->year($max = 'now'),
            ]);

            $report->morbidity_report()->save($morbidityReport);

            ReportDetail::create([
                'report_id' => $report->id,
                'section' => 'clinical data',
                'question' => 'Outcome',
                'answer' => $outcomes[array_rand($outcomes)],
            ]);

            ReportDetail::create([
                'report_id' => $report->id,
                'section' => 'clinical data',
                'question' => 'Date Admitted',
                'answer' => now(),
            ]);

            ReportDetail::create([
                'report_id' => $report->id,
                'section' => 'clinical data',
                'question' => 'Date of Onset',
                'answer' => now(),
            ]);
        }        
    }
}
