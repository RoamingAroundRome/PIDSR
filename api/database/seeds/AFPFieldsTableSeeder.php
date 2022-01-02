<?php

use App\DiseaseField;
use Illuminate\Database\Seeder;

class AFPFieldsTableSeeder extends Seeder
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
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date of Report",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date of Investigation",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Has fever?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Has cough?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Has diarrhea or is vomitting?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Has muscle pain?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Has meningeal signs?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Is present at birth?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Is asymetric?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "aralysis fully developed within 14 days from onset illness",
                "question" => "Paralysis fully developed within 14 days from onset illness",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Direction of paralysis",
                "answer" => null,
                "choices" => [
                    "Ascending",
                    "Descending",
                    "Unknown"
                ],
                "display" => true,
            ],
            
            // Right arm
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Right arm?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from right arm field.",
                "question" => "Right arm sensory status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from right arm field.",
                "question" => "Right arm deep tendeon reflexes",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from right arm field.",
                "question" => "Right arm motor status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            
            // Left arm
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Left arm?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from left arm field.",
                "question" => "Left arm sensory status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from left arm field.",
                "question" => "Left arm deep tendeon reflexes",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from left arm field.",
                "question" => "Left arm motor status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],

            // Right leg
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Right leg?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from right leg field.",
                "question" => "Right leg sensory status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from right leg field.",
                "question" => "Right leg deep tendeon reflexes",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from right leg field.",
                "question" => "Right leg motor status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],

            // Left leg
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Left leg?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from left leg field.",
                "question" => "Left leg sensory status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from left leg field.",
                "question" => "Left leg deep tendeon reflexes",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => "Please select if 'Yes' is selected from left leg field.",
                "question" => "Left leg motor status",
                "answer" => null,
                "choices" => [
                    "1 - Normal",
                    "2 - Reduced",
                    "3 - Exaggerated",
                    "4 - Absent",
                    "5 - Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Breathing muscles",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Facial muscles",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Neck muscles",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-textarea",
                "hint" => null,
                "question" => "Working diagnosis",
                "answer" => null,
                "choices" => null,
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
                    "Died (D)",
                    "Unconfirmed (U)",
                ],
                "display" => true,
            ],

            // Epidemiologic data
            [
                "section" => "epidemiologic data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "History of neurologic disorder?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "If yes, what neurologic disorder",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Did the patient travel (> 10km from house) 1 month prior to illness?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "If yes, what place did he or she travelled",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Travel date start",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Travel date end",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "AFP in patient's community prior 60 days",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "History of injection, fall, trauma or animal bite?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "epidemiologic data",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "If yes, specify the type",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],

            // immunization history / vaccine history
            [
                "section" => "vaccine history",
                "type" => "number",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Total OPV or IPV doses received",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date of last dose OPV or IPV",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Is it a host case?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],

            // laboratory classifcation (max 2)
            [
                "section" => "laboratory result (max 2)",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Stool sample collected?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "laboratory result (max 2)",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date of sample collected",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "laboratory result (max 2)",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date sent to RITM",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "laboratory result (max 2)",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date received by RITM",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "laboratory result (max 2)",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Result",
                "answer" => null,
                "choices" => [
                    "L20B+",
                    "L20B-",
                    "NPEV"
                ],
                "display" => true,
            ],
            [
                "section" => "laboratory result (max 2)",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date of Result",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],

            // case classification & outcome
            [
                "section" => "case classification & outcome",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Expected date of follow up",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Actual date of follow up",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "P.E. Done?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No"
                ],
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Final Classification",
                "answer" => null,
                "choices" => [
                    "Confirmed wild polio",
                    "Vaccine-derived paralyic polio (VDPV)",
                    "Vaccine associated paralytic polio (VAPP)",
                    "Polio compatible",
                    "Discarded as non-polio",
                    "Not AFP"
                ],
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Classification Data",
                "answer" => null,
                "choices" => [
                    "Laboratory",
                    "EPI linked",
                    "Lost to follow-up",
                    "Death",
                    "With residual paralysis",
                    "Without residual paralysis"
                ],
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date classified",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Final Diagnosis",
                "answer" => null,
                "choices" => [
                    "Bacterial Meningitis",
                    "Brain Abscess",
                    "Brainstrem Tumor",
                    "CNS Infection",
                    "Electrolyte Imbalance",
                    "Hypokalemia",
                    "GBS",
                    "Not AFP",
                    "Pott's Disease",
                    "Stroke in the young",
                    "Transverse myelitis",
                    "TBM",
                    "Traumatic cord injury",
                    "Viral encephalitis",
                    "Viral encephalomyelitis",
                    "Viral meningitis",
                    "Viral myelits",
                    "Brain tumor",
                    "Other"
                ],
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "text",
                "component" => "v-textarea",
                "hint" => null,
                "question" => "Other Diagnosis",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "case classification & outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => "If VAPP is selected from Final Diagnosis, please select.",
                "question" => "If VAPP",
                "answer" => null,
                "choices" => [
                    "Recipient VAPP",
                    "Contact VAPP"
                ],
                "display" => true,
            ],
        ];

        $diseaseField = new DiseaseField();

        foreach ($fields as $field) {
            $field['disease_id'] = 2;
            $field['section'] = ucwords($field['section']);
            $diseaseField->create($field);    
        }
    }
}
