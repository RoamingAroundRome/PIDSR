<template>
  <div>
    Personal Details
    <v-divider></v-divider>
    
    <v-row>
      <v-col 
        lg="4" 
        md="4" 
        sm="12" 
        cols="12">
        <v-text-field
          v-model="first_name"
          :error="!!errors['officer.first_name']"
          :error-messages="errors['officer.first_name']"
          label="First Name"
          hint="Required"
          persistent-hint
          filled>
          <!-- <template v-slot:label>
            <span>First Name <b class="red--text">*</b></span>
          </template> -->
        </v-text-field>
      </v-col>
      <v-col 
        lg="4" 
        md="4" 
        sm="12" 
        cols="12">
        <v-text-field
          v-model="last_name"
          :error="!!errors['officer.last_name']"
          :error-messages="errors['officer.last_name']"
          label="Last Name"
          hint="Required"
          persistent-hint
          filled>
          <!-- <template v-slot:label>
            <span>Last Name <b class="red--text">*</b></span>
          </template> -->
        </v-text-field>
      </v-col>
      <v-col 
        lg="4" 
        md="4" 
        sm="12" 
        cols="12">
        <v-text-field
          v-model="middle_name"
          :error="!!errors['officer.middle_name']"
          :error-messages="errors['officer.middle_name']"
          label="Middle Name"
          hint="Required"
          persistent-hint
          filled>
          <!-- <template v-slot:label>
            <span>Middle Name <b class="red--text">*</b></span>
          </template> -->
        </v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col 
        lg="6" 
        md="6" 
        sm="12" 
        cols="12">
        <v-text-field
          v-model="email"
          :error="!!errors['officer.email']"
          :error-messages="errors['officer.email']"
          label="Email"
          hint="Required"
          persistent-hint
          append-icon="mdi-email-outline"
          filled>
          <!-- <template v-slot:label>
            <span>Email <b class="red--text">*</b></span>
          </template> -->
        </v-text-field>
      </v-col>
      <v-col 
        lg="6" 
        md="6" 
        sm="12" 
        cols="12">
        <v-text-field
          v-model="phone_number"
          :error="!!errors['officer.phone_number']"
          :error-messages="errors['officer.phone_number']"
          label="Contact Number"
          hint="Required"
          persistent-hint
          append-icon="mdi-phone"
          filled>
          <!-- <template v-slot:label>
            <span>Contact Number <b class="red--text">*</b></span>
          </template> -->
        </v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col 
        lg="5" 
        md="6" 
        sm="12" 
        cols="12">
        <v-text-field
          v-model="date_started"
          label="Date Start"
          type="date"
          filled
          append-icon="mdi-calendar"
        ></v-text-field>
      </v-col>
    </v-row>

    Address Details
    <v-divider></v-divider>

    <v-row>
      <v-col 
        lg="4" 
        md="4" 
        sm="12" 
        cols="12">
        <v-autocomplete
          v-model="region"
          label="Region"
          :items="regions"
          item-text="name"
          item-value="name"
          :error="!!errors['officer.region']"
          :error-messages="errors['officer.region']"
          @change="setProvinces($event)"
          hint="Required"
          persistent-hint
          filled
          clearable>
          <!-- <template v-slot:label>
            <span>Region <b class="red--text">*</b></span>
          </template> -->
        </v-autocomplete>
      </v-col>
      <v-col 
        lg="4" 
        md="4" 
        sm="12" 
        cols="12">
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
          :error="!!errors['officer.province']"
          :error-messages="errors['officer.province']"
          @change="setMunicities($event)"
          :disabled="!region"
          hint="Required"
          persistent-hint
          clearable>
          <!-- <template v-slot:label>
            <span>Province <b class="red--text">*</b></span>
          </template> -->
        </v-autocomplete>
      </v-col>
      <v-col 
        lg="4" 
        md="4" 
        sm="12" 
        cols="12">
        <v-autocomplete
          v-model="municity"
          label="Municipality/City"
          :items="municities
            .filter(d => {
              if (provinceCode == '') {
                return false
              }
              
              return provinceCode == d.province
            })"
          item-text="name"
          item-value="name"
          :error="!!errors['officer.municity']"
          :error-messages="errors['officer.municity']"
          @change="setBarangays($event)"
          :disabled="!province"
          clearable
          hint="Required"
          persistent-hint
          filled>
          <!-- <template v-slot:label>
            <span>Municity <b class="red--text">*</b></span>
          </template> -->
        </v-autocomplete>
      </v-col>
    </v-row>

    <v-row>
      <v-col 
        lg="8" 
        md="7" 
        sm="12" 
        cols="12">
        <v-text-field
          v-model="street"
          label="Street Address"
          filled
        ></v-text-field>
      </v-col>
      <v-col 
        lg="4" 
        md="5" 
        sm="12" 
        cols="12">
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
      'form.officer.first_name',
      'form.officer.middle_name',
      'form.officer.last_name',
      'form.officer.email',
      'form.officer.phone_number',
      'form.officer.region',
      'form.officer.province',
      'form.officer.municity',
      'form.officer.barangay',
      'form.officer.street',
      'form.officer.district',
      'form.officer.date_started',
      'errors'
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