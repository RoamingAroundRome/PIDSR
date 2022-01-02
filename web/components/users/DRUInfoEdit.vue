<template>
  <div>
    <v-text-field
      v-model="name"
      label="Name"
      hint="Required"
      persistent-hint
      filled
    ></v-text-field>
    <v-select
      v-model="type"
      label="Type"
      hint="Required"
      :items="[
        'Private Hospital',
        'Government Hospital',
        'Government Clinic',
        'Port/Airport',
        'CHO',
        'Private Clinic',
        'RHU',
        'Government Laboratory',
        'Private Laboratory',
        'Integrated Hospital',
      ]"
      persistent-hint
      filled
    ></v-select>
    <v-autocomplete
      v-model="region"
      label="Region"
      filled
      :items="regions"
      item-text="name"
      item-value="name"
      @change="setProvinces($event)"
      hint="Required"
      persistent-hint
      clearable
    ></v-autocomplete>
    <v-autocomplete
      v-model="province"
      label="Province"
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
      :disabled="!region"
      hint="Required"
      persistent-hint
      clearable
    ></v-autocomplete>
    <v-autocomplete
      v-model="municity"
      @change="setBarangays($event)"
      label="Municipality/City"
      filled
      :items="municities
        .filter(d => {
          if (provinceCode == '') {
            return false
          }
          
          return provinceCode == d.province
        })"
      item-text="name"
      item-value="name"
      :disabled="!province"
      hint="Required"
      persistent-hint
      clearable
    ></v-autocomplete>
    <v-text-field
      v-model="street"
      label="Street Address"
      filled
    ></v-text-field>
    <v-text-field
      v-model="district"
      label="District"
      filled
    ></v-text-field>
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
    <v-checkbox
      v-model="national_sentinel_site"
      label="National Sentinel Site"
      color="primary"
      filled
    ></v-checkbox>
    <v-checkbox
      v-model="philmis_site"
      label="Philmis Site"
      color="primary"
      filled
    ></v-checkbox>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    regionCode: '',
    provinceCode: '',
    municityCode: '',
  }),
  
  computed: {
    ...mapFields('users', [
      'user.role',
      'user.dru.name',
      'user.dru.type',
      'user.dru.address.region',
      'user.dru.address.province',
      'user.dru.address.municity',
      'user.dru.address.barangay',
      'user.dru.address.street',
      'user.dru.address.district',
      'user.dru.national_sentinel_site',
      'user.dru.philmis_site',
    ]),

    ...mapGetters({
      regions: 'philippines/getRegions',
      provinces: 'philippines/getProvinces',
      municities: 'philippines/getMunicities',
      barangays: 'philippines/getBarangays',
    }),
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