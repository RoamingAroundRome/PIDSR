export class Patient {
  constructor({ 
    patient_no = null,
    first_name = null,
    middle_name = null,
    last_name = null,
    age = null,
    ethnicity = null,
    gender = null,
    status = null,
    is_4P_member = null,
    inter_local_health_zone = null,
    blood_type = null,
    rh_type = null,
    date_of_death = null,
    date_of_birth = null,
  } = {}) {
    this.patient_no = patient_no
    this.first_name = first_name
    this.middle_name = middle_name
    this.last_name = last_name
    this.age = age
    this.ethnicity = ethnicity
    this.gender = gender
    this.status = status
    this.is_4P_member = is_4P_member
    this.inter_local_health_zone = inter_local_health_zone
    this.blood_type = blood_type
    this.rh_type = rh_type
    this.date_of_death = date_of_death
    this.date_of_birth = date_of_birth
  }
}

export const createPatient = (data) => {
  return Object.freeze(new Patient(data))
}