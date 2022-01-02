<template>
  <div>
    DRU Details
    <v-divider></v-divider>

    <v-row>
      <v-col>
        <v-text-field
          v-model="name"
          :error="!!errors['dru.name']"
          :error-messages="errors['dru.name']"
          label="Name"
          hint="Required"
          persistent-hint
          filled>
        </v-text-field>
      </v-col>
      <v-col>
        <v-autocomplete
          v-model="type"
          :error="!!errors['dru.type']"
          :error-messages="errors['dru.type']"
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
          label="Type"
          hint="Required"
          persistent-hint
          filled>
        </v-autocomplete>
      </v-col>
    </v-row>

    Address Details
    <v-divider></v-divider>

    <v-row>
      <v-col>
        <v-autocomplete
          v-model="region"
          :error="!!errors['dru.region']"
          :error-messages="errors['dru.region']"
          label="Region"
          filled
          :items="regions"
          item-text="name"
          item-value="name"
          @change="setProvinces($event)"
          hint="Required"
          persistent-hint
          clearable>
        </v-autocomplete>
      </v-col>
      <v-col>
        <v-autocomplete
          v-model="province"
          :error="!!errors['dru.province']"
          :error-messages="errors['dru.province']"
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
          clearable>
        </v-autocomplete>
      </v-col>
      <v-col>
        <v-autocomplete
          v-model="municity"
          :error="!!errors['dru.municity']"
          :error-messages="errors['dru.municity']"
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
          clearable>
        </v-autocomplete>
      </v-col>
    </v-row>

    <v-row>
      <v-col>
        <v-text-field
          v-model="street"
          label="Street Address"
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
      </v-col>
      <v-col>
        <v-card-text>
          <v-checkbox
            v-model="national_sentinel_site"
            label="National Sentinel Site"
            color="primary"
          ></v-checkbox>
          <v-checkbox
            v-model="philmis_site"
            label="PHILMIS Site"
            color="primary"
          ></v-checkbox>
        </v-card-text>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import { mapFields } from 'vuex-map-fields'

export default {
  data: () => ({
    regionCode: '',
    provinceCode: '',
    municityCode: '',
  }),
  
  computed: {
    ...mapGetters({
      regions: 'philippines/getRegions',
      provinces: 'philippines/getProvinces',
      municities: 'philippines/getMunicities',
      barangays: 'philippines/getBarangays',
    }),

    ...mapFields('drus', [
      'form.dru.name',
      'form.dru.type',
      'form.dru.region',
      'form.dru.province',
      'form.dru.municity',
      'form.dru.barangay',
      'form.dru.street',
      'form.dru.district',
      'form.dru.national_sentinel_site',
      'form.dru.philmis_site',
      'errors'
    ]),
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