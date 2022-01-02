import { dateFormat } from '../utils/Util'

export class DRU {
  constructor({ 
    name = null,
    type = null,
    region = null,
    province = null,
    municity = null,
    barangay = null,
    street = null,
    district = null,
    national_sentinel_site = null,
    philmis_site = null,
  } = {}) {
    this.name = name
    this.type = type
    this.region = region
    this.province = province
    this.municity = municity
    this.barangay = barangay
    this.street = street
    this.district = district
    this.national_sentinel_site = national_sentinel_site
    this.philmis_site = philmis_site
  }
}

export const mapDRU = (data) => {
  return {
    id: data.id,
    officer: data.officer || null,
    name: data.name,
    investigator: `${data.officer.first_name || 'Not specified' } ${data.officer.last_name || '' }`,
    phone_number: data.officer.phone_number || 'Not specified',
    created_at: dateFormat(data.created_at),
  }
}