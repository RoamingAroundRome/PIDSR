<?php

use App\DiseaseField;
use Illuminate\Database\Seeder;

class AHFSFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fields = [
            [
                "section" => "clinical data",
                "type" => null,
                "component" => "v-select",
                "hint" => null,
                "question" => "Admitted?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date Admitted",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date of Onset",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "PCR Result",
                "answer" => null,
                "choices" => [
                    "Positive",
                    "Negative",
                    "Not Done",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Specify Organism",
                "answer" => null,
                "choices" => [
                    "Not applicable",
                    "Ebola Reston",
                    "Lassa virus",
                    "Yellow fever virus",
                    "Rift valley",
                    "Hanta virus",
                    "Other"
                ],
                "display" => true,
            ],
            [
                "section" => "final classification & outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Case Classification",
                "answer" => null,
                "choices" => [
                    "Suspect",
                    "Confirmed"
                ],
                "display" => true,
            ],
            [
                "section" => "final classification & outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Outcome",
                "answer" => null,
                "choices" => [
                    "Alive (A)",
                    "Dead (D)",
                    "Unconfirmed (U)"
                ],
                "display" => true,
            ],
            [
                "section" => "final classification & outcome",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date Died",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
        ];

        $diseaseField = new DiseaseField();

        foreach ($fields as $field) {
            $field['disease_id'] = 12;
            $field['section'] = ucwords($field['section']);
            $diseaseField->create($field);    
        }
    }
}
