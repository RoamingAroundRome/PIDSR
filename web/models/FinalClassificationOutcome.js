export class FinalClassificationOutcome {
  constructor({ 
    case_classification = null,
    outcome = null,
    date_died = null,
    aes_case_classification = null,
    aes_other_agent = null,
    final_diagnosis = null,
    confirmatory_test = null,
    bm_case_classification = null,
    date_discharged = null,
    recover_with_sequelae = null,
    specify_sequelae = null,
    hama_date = null,
    transferred_to = null,
    clinical_classification = null,
    blood_extracted_before_antibiotic = null,
    antibiotics_given = null,
    expected_date_follow_up = null,
    actual_date_follow_up = null,
    pe_done = null,
    final_classification = null,
    classification_data = null,
    date_classified = null,
    other_diagnosis = null,
  } = {}) {
    // 
  }
}

export const createFinalClassificationOutcome = (data) => {
  return Object.freeze(new FinalClassificationOutcome(data))
}