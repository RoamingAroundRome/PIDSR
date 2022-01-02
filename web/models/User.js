import { dateFormat, capitalize } from '../utils/Util'

export class User {
  constructor({ 
    role = null, 
    first_name = null, 
    middle_name = null, 
    last_name = null, 
    email = null, 
    phone_number = null,
    password = null,
    password_confirmation = null,
    region = null,
    province = null,
    municity = null,
    barangay = null,
    street = null,
    district = null,
    date_started = null,
    date_ended = null
  } = {}) {
    this.role = role 
    this.first_name = first_name 
    this.middle_name = middle_name 
    this.last_name = last_name 
    this.email = email 
    this.phone_number = phone_number
    this.password = password
    this.password_confirmation = password_confirmation
    this.region = region
    this.province = province
    this.municity = municity
    this.barangay = barangay
    this.street = street
    this.district = district
    this.date_started = date_started
    this.date_ended = date_ended
  }
}

export const roles = [
  'admin', 'officer'
]

export const createUser = (data) => {
  return Object.freeze(new User(data))
}

export const mapUser = (data) => {
  return {
    id: data.id,
    name: `${data.first_name || 'Not specified'} ${data.last_name || '' }`,
    role: capitalize(data.role) || 'Not specified',
    roleColor: getRoleColor(data.role),
    created_at: dateFormat(data.created_at),
  }
}

const getRoleColor = (role) => role == 'admin' 
  ? 'red darken-2' 
  : role == 'officer' 
  ? 'green' 
  : 'black'