<?php

use App\DiseaseField;
use Illuminate\Database\Seeder;

class AMESFieldsTableSeeder extends Seeder
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
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Place where suspected Shellfish was harvested",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Are there any other members of household or community who shared the same meal?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
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
            $field['disease_id'] = 13;
            $field['section'] = ucwords($field['section']);
            $diseaseField->create($field);    
        }
    }
}
