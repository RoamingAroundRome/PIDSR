<template>
  <div>
    <v-form @submit.prevent="search()">
      <v-card>
        <v-toolbar color="transparent" flat>
          <v-toolbar-title>Filter Report</v-toolbar-title>
        </v-toolbar>
        <v-card-text>
          <v-row dense>
            <v-col>
              <v-autocomplete
                label="Disease"
                v-model="query.disease_id"
                :items="diseases"
                item-text="name"
                item-value="id"
                filled
              ></v-autocomplete>
            </v-col>
            <v-col>
              <v-autocomplete
                label="Region"
                v-model="query.region"
                :items="regions"
                item-text="name"
                item-value="name"
                persistent-hint
                filled
                clearable
              ></v-autocomplete>
            </v-col>
            <v-col>
              <v-autocomplete
                label="Municipality/City"
                v-model="query.municity"
                :items="municities"
                item-text="name"
                item-value="name"
                clearable
                persistent-hint
                filled
              ></v-autocomplete>
            </v-col>
          </v-row>
          <v-row dense>
            <v-col>
              <v-text-field
                v-model="query.min_date"
                type="date"
                label="From"
                filled
              ></v-text-field>
            </v-col>
            <v-col>
              <v-text-field
                v-model="query.max_date"
                type="date"
                label="To"
                filled
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row justify="center">
            <v-btn 
              color="primary"
              type="submit"
              x-large 
              width="250"
              depressed
              :loading="loading">
              Search
            </v-btn>
          </v-row>
        </v-card-text>
      </v-card>
    </v-form>
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
export default {
  data: () => ({
    loading: false,
    query: {
      disease_id: null,
      region: null,
      municity: null,
      min_date: null,
      max_date: null,
    }
  }),

  computed: {
    ...mapState({
      diseases: state => state.diseases.diseases
    }),

    ...mapGetters({
      regions: 'philippines/getRegions',
      provinces: 'philippines/getProvinces',
      municities: 'philippines/getMunicities',
    }),
  },

  methods: {
    async search() {
      this.loading = true
      try {
        await this.$store.dispatch('reports/search', this.query)
        
        await setTimeout(() => {
          this.loading = false
        }, 1500)
        await this.$helpers.notify({
          type: 'info',
          message: 'Your search results is ready.'
        })
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>