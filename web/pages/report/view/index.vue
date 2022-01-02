<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-btn @click="$router.go(-1)" icon>
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
			<v-toolbar-title>
				<h2>View Report</h2>
			</v-toolbar-title>
		</v-toolbar>

    <v-row
      justify="center"
      align="center">
      <v-col
        lg="11"
        md="11"
        sm="12"
        cols="12">
        <v-row>
          <v-col>
            <SearchComponent />
          </v-col>
        </v-row>

        <v-row>
          <v-col cols="12">
            <CasesPerMorbidityWeek />
          </v-col>

          <v-col cols="12">
            <CasesPerBarangayDataTable />
          </v-col>

          <v-col cols="12">
            <PatientListDataTable />
          </v-col>
        </v-row>

      </v-col>
    </v-row>
  </div>
</template>

<script>
import SearchComponent from '@/components/report/SearchComponent'
import CasesPerMorbidityWeek from '@/components/reporting/CasesPerMorbidityWeek'
import CasesPerBarangayDataTable from '@/components/reporting/CasesPerBarangayDataTable'
import PatientListDataTable from '@/components/reporting/PatientListDataTable'

export default {
  head: () => ({
    title: `${process.env.title} | View Report`,
  }),
  
  components: {
    SearchComponent,
    CasesPerMorbidityWeek,
    CasesPerBarangayDataTable,
    PatientListDataTable,
  },
  
  async fetch({ store }) {
    await store.commit('reports/RESET_SEARCH_RESULT')
    
    if ( !(store.state.diseases.diseases > 0) ) {
      await store.dispatch('diseases/fetchAll')
    }
  },
}
</script>