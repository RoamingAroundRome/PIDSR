<?php

use App\DiseaseField;
use Illuminate\Database\Seeder;

class AEFIFieldsTableSeeder extends Seeder
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
                "type" => "text",
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
                "hint" => "This refers to the hospital where the baby is immunized.",
                "question" => "Name of hospital or health facility",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Address of hospital or health facility",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "time",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Time of Onset",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date next higher level notified",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "time",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Time next higher level notified",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "clinical data",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Injection site abscess",
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
                "question" => "Lymphadentis",
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
                "question" => "Severe Local Reaction",
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
                "question" => "Acute Paralysis",
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
                "question" => "Encephalopathy",
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
                "question" => "Seizures",
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
                "question" => "Anaphylatic Reaction",
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
                "question" => "Anaphylatic Shock",
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
                "question" => "Brachial Neuritis",
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
                "question" => "DisseminBCGINfection",
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
                "question" => "Hypotensice-hyporesponsice",
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
                "question" => "Ostetis or Osteomylits",
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
                "question" => "Sepsis",
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
                "question" => "Thrombocytopenia",
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
                "question" => "Toxic Shock Syndrome",
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
                "question" => "Any death linked to said immunization",
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
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Other events",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Date of Vacination",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "time",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Time of Vacination",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Name of Vacinator",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Vacinator Occupation",
                "answer" => null,
                "choices" => [
                    "Physician",
                    "Midwife",
                    "Nurse",
                    "Other"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "If occupation selected is 'other' from vacinator occupation field.",
                "question" => "Vacinator's other occupation",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Place of Vacination",
                "answer" => null,
                "choices" => [
                    "Health Center",
                    "Private Hospital",
                    "Public Hospital",
                    "BHS",
                    "Outreach",
                    "Other"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "If place selected is 'other' from place of vacination field.",
                "question" => "Other place of vacination",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Did the patient get vaccinated with in 4 weeks of the event?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Did the patient take other medications at the time of vaccination?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "If 'Yes' is selected from the above field, please fill in this field.",
                "question" => "What's the name of the medication?",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "History of similar reaction",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "History of similar allergy",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "If 'Yes' is selected from the above field, please fill in this field.",
                "question" => "What are these allergies?",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Birth defects",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Family history of similar event",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "If the patient is suffering from other medical conditions",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "vaccine history",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "AEFI committee deliberation done?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                ],
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Name of suspected vaccine",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "number",
                "component" => "v-text-field",
                "hint" => "Dosage of the said vaccine.",
                "question" => "Dose",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Lot or Batch number",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Manufacturer",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => null,
                "question" => "Expiry Date",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Dilutant Used",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "number",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "D Volume",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "D Lot or Barch number",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "D Manufacturer",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "D Expiry Date",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "4W Name of vaccine",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "number",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "4W Dose",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "4W Lot or Batch number",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "text",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "4W Manufacturer",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "data for vaccine",
                "type" => "date",
                "component" => "v-text-field",
                "hint" => "Please fill this up if 'Yes' was answered from Dilutant Used field.",
                "question" => "4W Expiry Date",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "final diagnosis",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "What is the cause of AEFI",
                "answer" => null,
                "choices" => [
                    "Program Related",
                    "Vaccine-reaction",
                    "Coincidental",
                    "Injection Reaction",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "final diagnosis",
                "type" => "text",
                "component" => "v-textarea",
                "hint" => null,
                "question" => "Final Diagnosis",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "final diagnosis",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "If program Error",
                "answer" => null,
                "choices" => [
                    "Non-sterile injection",
                    "Vaccine prepared incorrectly",
                    "Wrong administration technique",
                    "Improper vaccine transport or storage",
                    "Other",
                ],
                "display" => true,
            ],
            [
                "section" => "final diagnosis",
                "type" => "text",
                "component" => "v-textarea",
                "hint" => null,
                "question" => "Other program related causes",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
            [
                "section" => "outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Outcome",
                "answer" => null,
                "choices" => [
                    "Alive (A)",
                    "Died (D)",
                    "Unconfirmed (U)"
                ],
                "display" => true,
            ],
            [
                "section" => "outcome",
                "type" => "text",
                "component" => "v-select",
                "hint" => null,
                "question" => "Patient sustained a disability?",
                "answer" => null,
                "choices" => [
                    "Yes",
                    "No",
                    "Unknown"
                ],
                "display" => true,
            ],
            [
                "section" => "outcome",
                "type" => "text",
                "component" => "v-textarea",
                "hint" => null,
                "question" => "Disability",
                "answer" => null,
                "choices" => null,
                "display" => true,
            ],
        ];

        $diseaseField = new DiseaseField();

        foreach ($fields as $field) {
            $field['disease_id'] = 1;
            $field['section'] = ucwords($field['section']);
            $diseaseField->create($field);    
        }
    }
}