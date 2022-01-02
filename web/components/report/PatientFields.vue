<template>
  <div>
    <v-text-field
      v-model="patient_no"
      label="Patient Number"
      filled
    ></v-text-field>
    <v-text-field
      v-model="first_name"
      label="First Name"
      hint="Required"
      persistent-hint
      filled
    ></v-text-field>
    <v-text-field
      v-model="last_name"
      label="Last Name"
      hint="Required"
      persistent-hint
      filled
    ></v-text-field>
    <v-text-field
      v-model="middle_name"
      label="Middle Name"
      filled
    ></v-text-field>
    <v-text-field
      type="date"
      v-model="date_of_birth"
      label="Birthdate"
      hint="Required"
      persistent-hint
      append-icon="mdi-calendar"
      filled
    ></v-text-field>
    <v-select
      v-model="gender"
      label="Sex"
      :items="['male', 'female']"
      filled
    ></v-select>
    <v-select
      v-model="blood_type"
      label="Blood Type"
      :items="bloodTypes"
      filled
    ></v-select>
    <v-select
      v-model="rh_type"
      label="RH Type"
      :items="rhTypes"
      filled
    ></v-select>
    <v-select
      v-model="ethnicity"
      label="Ethnic Group"
      :items="['Not part', 'Higaonon']"
      clearable
      filled
    ></v-select>
    <v-checkbox
      v-model="is_4P_member"
      label="4P Member"
      color="primary"
    ></v-checkbox>
    
    Address Details
    <v-divider class="mb-5"></v-divider>
    <v-autocomplete
      v-model="region"
      label="Region"
      :items="regions"
      item-text="name"
      item-value="name"
      @change="setProvinces($event)"
      hint="Required"
      persistent-hint
      filled
      clearable
    ></v-autocomplete>
    <v-autocomplete
      v-model="province"
      label="Province"
      hint="Required"
      persistent-hint
      :disabled="!region"
      filled
      :items="provinces
        .filter(d => {
          if (regionCode == '') {
            return false
          }
          
          return regionCode == d.region
        })"
      item-text="name"
      item-value="name"
      @change="setMunicities($event)"
      clearable
    ></v-autocomplete>
    <v-autocomplete
      v-model="municity"
      label="Municipality/City"
      :disabled="!province"
      @change="setBarangays($event)"
      :items="municities
        .filter(d => {
          if (provinceCode == '') {
            return false
          }
          
          return provinceCode == d.province
        })"
      item-text="name"
      item-value="name"
      clearable
      hint="Required"
      persistent-hint
      filled
    ></v-autocomplete>
    <v-autocomplete
      v-model="barangay"
      :items="barangays
        .filter(d => {
          if (municityCode == '') {
            return false
          }
          
          return municityCode == d.municity
        })"
      :disabled="!municity"
      item-text="name"
      item-value="name"
      label="Barangay"
      clearable
      filled
    ></v-autocomplete>
    <v-text-field
      v-model="district"
      label="Street or Purok"
      filled
    ></v-text-field>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import { mapFields } from 'vuex-map-fields'

export default {
  data: () => ({
    regionCode: '',
    provinceCode: '',
    municityCode: '',
    bloodTypes: ['N/A', 'A', 'B', 'AB', 'O'],
    rhTypes: ['+', '-'],
  }),
  
  computed: {
    ...mapGetters({
      regions: 'philippines/getRegions',
      provinces: 'philippines/getProvinces',
      municities: 'philippines/getMunicities',
      barangays: 'philippines/getBarangays',
    }),

    ...mapFields('reports', [
      'form.patient.patient_no',
      'form.patient.first_name',
      'form.patient.middle_name',
      'form.patient.last_name',
      'form.patient.age',
      'form.patient.gender',
      'form.patient.ethnicity',
      'form.patient.status',
      'form.patient.is_4P_member',
      'form.patient.inter_local_health_zone',
      'form.patient.blood_type',
      'form.patient.rh_type',
      'form.patient.date_of_death',
      'form.patient.date_of_birth',
      
      'form.address.region',
      'form.address.province',
      'form.address.municity',
      'form.address.barangay',
      'form.address.street',
      'form.address.district',
    ])
  }, 

  methods: {
    setProvinces(event) {
      if (event) {
        const region = this.regions.find(d => event == d.name)
        this.regionCode = region.code
      }
    },

    setMunicities(event) {
      if (event) {
        const province = this.provinces.find(d => event == d.name)
        this.provinceCode = province.code
      }
    },

    setBarangays(event) {
      if (event) {
        const municity = this.municities.find(d => event == d.name)
        this.municityCode = municity.code
      }
    },
  }
}
</script>