<template>
  <div>
    <v-card>
      <v-toolbar color="transparent" flat>
        <v-text-field
          label="Search"
          single-line
          hide-details
          v-model="search"
          append-icon="mdi-magnify"
          dense
          solo
          flat
          clearable
        ></v-text-field>
        <v-toolbar-title></v-toolbar-title>
        <v-spacer></v-spacer>
        
        <v-btn 
          @click="refresh()"
          :loading="refreshing"
          icon>
          <v-icon>mdi-refresh</v-icon>
        </v-btn>
        
        <!-- <v-menu
          offset-y
          left>
          <template v-slot:activator="{ on }">
            <v-btn
              v-on="on"
              icon>
              <v-icon>mdi-dots-vertical</v-icon>
            </v-btn>
          </template>
          <v-list dense>
            <v-list-item @click="exportCSV()">
              <v-list-item-content>
                <v-list-item-title>Export to PDF</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-menu> -->
      </v-toolbar>
      <v-data-table
        v-if="isAdmin"
        :headers="headers"
        :items="getAllLatestEntries"
        :search="search">
        <template v-slot:item.latest_entry="{ item }">
          {{ item.latest_entry ? formatDate(item.latest_entry) : 'No entries' }}
        </template>
        <template v-slot:item.actions="{ item }">
          <v-btn icon>
            <v-icon>mdi-eye</v-icon>
          </v-btn>
        </template>
      </v-data-table>
      <v-data-table
        v-else-if="isOfficer"
        :headers="headers"
        :items="getLatestEntries"
        :search="search">
        <template v-slot:item.latest_entry="{ item }">
          {{ item.latest_entry ? formatDate(item.latest_entry) : 'No entries' }}
        </template>
        <template v-slot:item.actions="{ item }">
          <v-btn icon>
            <v-icon>mdi-eye</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card>

  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import { toCSV } from '../../utils/Util'

export default {
  methods: {
    exportCSV () {
      if (this.getAllLatestEntries.length <= 0) {
        return this.$helpers.notify({
          type: 'info',
          message: 'Could not export an empty data.'
        })
      }
      
      return toCSV(this.getAllLatestEntries, 'DRU List')
    },
    
    async refresh() {
      this.refreshing = true
      await this.$store.dispatch('drus/fetchAll')
      await setTimeout(async() => {
        this.refreshing = false
      }, 1500)
    },
    
    remove(id) {
      this.id = id
      this.deleteDialog = true
    },
  },
  
  computed: {
    ...mapGetters({
      getAllLatestEntries: 'reports/getAllLatestEntries',

      getLatestEntries: 'reports/getLatestEntries',

      isAdmin: 'isAdmin',

      isOfficer: 'isOfficer'
    }),
    
    ...mapState({
      allLatestEntries: state => state.reports.allLatestEntries,

      latestEntries: state => state.reports.latestEntries,
    })
  },
  
  data: () => ({
    id: null,
    refreshing: false,
    deleteDialog: false,
    search: null,
    headers: [
      {
        text: 'DRU',
        value: 'name',
      },
      {
        text: 'Date',
        value: 'latest_entry',
      },
      {
        text: 'Cases',
        value: 'cases',
      },
      {
        text: 'Actions',
        value: 'actions',
        sortable: false,
      }
    ],
  }),
}
</script>