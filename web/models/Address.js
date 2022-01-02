export class Address {
  constructor({ 
    region = null,
    province = null,
    municity = null,
    barangay = null,
    street = null,
    district = null,
  } = {}) {
    this.region = region
    this.province = province
    this.municity = municity
    this.barangay = barangay
    this.street = street
    this.district = district
  }
}

export const createAddress = (data) => {
  return Object.freeze(new Address(data))
}