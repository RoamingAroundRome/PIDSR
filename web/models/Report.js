export class Report {
  constructor({ 
    disease_id = null,
    details = [],
  } = {}) {
    this.disease_id = disease_id
    this.details = details
  }
}

export const createReport = (data) => {
  return Object.freeze(new Report(data))
}