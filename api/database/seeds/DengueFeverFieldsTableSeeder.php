<?php

use App\DiseaseField;
use Illuminate\Database\Seeder;

class DengueFeverFieldsTableSeeder extends Seeder
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
                "question" => "Laboratory Test",
                "answer" => null,
                "choices" => [
                    "IgM Elisa",
                    "IgG Elisa",
                    "NS1-Ag",
                    "PCR",
                    "Not Done",
                    "IgM & IgG EliSA"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Type",
                "answer" => null,
                "choices" => [
                    "DF",
                    "DHF",
                    "DSS"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Clinical Classification",
                "answer" => null,
                "choices" => [
                    "WITH WARNING SIGNS",
                    "SEVERE DENGUE",
                    "NO WARNING SIGNS"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Laboratory Classification",
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
                "question" => "Laboratory Result",
                "answer" => null,
                "choices" => [
                    "IgM Positive",
                    "Equivocal",
                    "IgM Negative",
                    "IgG Positive",
                    "IgG Negative",
                    "NS1 Positive",
                    "NS1 Negative",
                    "Serotype 1",
                    "Serotype 2",
                    "Serotype 3",
                    "Serotype 4",
                    "Not applicable",
                    "IgM and IgG Positive",
                    "IgM and IgG Negative"
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
            $field['disease_id'] = 17;
            $field['section'] = ucwords($field['section']);
            $diseaseField->create($field);    
        }
    }
}
