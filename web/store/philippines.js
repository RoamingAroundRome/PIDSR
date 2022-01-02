import {
  regions,
  provinces,
  citiesMunicipalities,
} from 'ph-locations';
import {
  regions as Regions,
  provinces as Provinces,
  city_mun as Municipalities,
  barangays as Barangays
} from 'phil-reg-prov-mun-brgy'

export const state = () => ({
  // regions: regions,
  // provinces: provinces,
  // municities: citiesMunicipalities,
  regions: Regions,
  provinces: Provinces,
  municities: Municipalities,
  barangays: Barangays
})

export const getters = {
  // getRegions: state => state.regions,
  // getProvinces: state => state.provinces,
  // getMunicities: state => state.municities,

  getRegions: state => state.regions.map(d => ({
    name: d.name,
    code: d.reg_code
  })),

  getProvinces: state => state.provinces.map(d => ({
    name: d.name,
    region: d.reg_code,
    code: d.prov_code
  })),

  getMunicities: state => state.municities.map(d => ({
    name: d.name,
    province: d.prov_code,
    code: d.mun_code
  })),

  getBarangays: state => state.barangays.map(d => ({
    name: d.name,
    municity: d.mun_code
  })),
}
