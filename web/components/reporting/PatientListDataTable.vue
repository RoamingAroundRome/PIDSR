<template>
  <v-card>
    <v-card-title class="font-weight-regular">
      Patient List
      <v-spacer></v-spacer>
      <v-text-field
        append-icon="mdi-magnify"
        v-model="search"
        label="Search"
        single-line
        hide-details
        clearable
        flat
        solo
      ></v-text-field>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn v-on="on" icon>
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </template>
        <v-list dense>
          <v-list-item @click="exportCSV()">
            <v-list-item-content>
              <v-list-item-title>
                Export to CSV
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-card-title>
    <v-card-subtitle>
      as of {{ `${formatDate(minDate ? new Date(minDate) : new Date)} to ${formatDate(maxDate ? new Date(maxDate) : new Date)}` }}
    </v-card-subtitle>
    <v-data-table
      :search="search"
      :headers="headers"
      :items="patientList"
      item-key="id"
      multi-sort
    ></v-data-table>
  </v-card>
</template>

<script>
import { mapGetters, mapState } from 'vuex'
import { toCSV } from '../../utils/Util'

export default {
  methods: {
    exportCSV () {
      if (this.patientList.length <= 0) {
        return this.$helpers.notify({
          type: 'info',
          message: 'Could not export an empty data.'
        })
      }
      
      return toCSV(this.patientList, 
        `${this.diseaseName}: Patient List as of ${this.formatDate(this.minDate)} to ${this.formatDate(this.maxDate)}`,
        `${this.slugify(this.diseaseName)}-patient-list-${this.formatDate(this.minDate)}-to-${this.formatDate(this.maxDate)}`)
    },
  },
  
  data: () => ({
    search: '',
    headers: [
      {
        text: 'Patient No.',
        value: 'patient_no',
        align: 'left',
      },
      {
        text: 'Age',
        value: 'age',
        align: 'left',
      },
      {
        text: 'Gender',
        value: 'gender',
        align: 'left',
      },
      {
        text: 'Outcome',
        value: 'outcome',
        align: 'left',
      },
      {
        text: 'Barangay',
        value: 'barangay',
        align: 'left',
      },
    ]
  }),
  
  computed: {
    ...mapState({
      minDate: state => state.reports.result.min_date,
      maxDate: state => state.reports.result.max_date,
      diseaseName: state => state.diseases.disease.name
    }),
    
    ...mapGetters({
      patientList: 'reports/patientList'
    })
  }
}
</script>