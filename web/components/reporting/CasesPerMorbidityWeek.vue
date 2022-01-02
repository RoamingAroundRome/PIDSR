<template>
  <div>
    <v-card>
      <v-toolbar color="transparent" flat>
        <v-toolbar-title>Number of Cases per Morbidity Week</v-toolbar-title>
      </v-toolbar>
      <v-card-text>
        <apexchart 
          height="300"
          width="100%" 
          type="bar" 
          :options="_chartOptions || chartOptions" 
          :series="_chartData || series"
        ></apexchart>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  data: () => ({
    chartOptions: {
      chart: {
        id: 'cases'
      },
      xaxis: {
        categories: ['Week 1']
      }
    },
    series: [{
      name: 'cases-per-morbidity-week',
      data: [0]
    }]
  }),

  computed: mapGetters({
    _chartOptions: 'reports/casesPerMorbidityWeekChartOptions',
    _chartData: 'reports/casesPerMorbidityWeekChartData'
  })
}
</script>