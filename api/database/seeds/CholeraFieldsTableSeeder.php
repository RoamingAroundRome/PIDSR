<?php

use App\DiseaseField;
use Illuminate\Database\Seeder;

class CholeraFieldsTableSeeder extends Seeder
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
                "question" => "Laboratory Result",
                "answer" => null,
                "choices" => [
                    "(+)Bacteriological Culture",
                    "Negative",
                    "Not Done",
                    "Pending",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Case Classification",
                "answer" => null,
                "choices" => [
                    "Suspect",
                    "Probable",
                    "Confirmed"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
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
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Specify Organism",
                "answer" => null,
                "choices" => [
                    "Vibrio Cholera Ogawa",
                    "Vibrio Cholera Inaba",
                    "Hikajima",
                    "Vibrio Cholera 0139"
                ],
                "display" => true,
            ],
            
            [
                "section" => "clinical data",
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
            $field['disease_id'] = 16;
            $field['section'] = ucwords($field['section']);
            $diseaseField->create($field);    
        }
    }
}
