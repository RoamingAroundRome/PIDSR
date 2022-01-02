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
        
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="drus"
        :search="search">
        <template v-slot:item.actions="{ item }">
          <v-btn icon>
            <v-icon>mdi-eye</v-icon>
          </v-btn>
          <v-btn @click="remove(item.id)" icon>
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card>

  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  methods: {
    async refresh() {
      this.refreshing = true
      await this.$store.dispatch('drus/fetchAll')
      await setTimeout(async() => {
        this.refreshing = false
      }, 1500)
    },
    
    remove(id) {
      this.deleteDialog = true
    },
  },
  
  computed: {
    ...mapGetters({
      drus: 'drus/mappedDRUs'
    })
  },
  
  data: () => ({
    refreshing: false,
    deleteDialog: false,
    search: null,
    headers: [
      {
        text: '#',
        value: 'id',
      },
      {
        text: 'DRU',
        value: 'name',
      },
      {
        text: 'Name of Investigator',
        value: 'investigator',
      },
      {
        text: 'Contact Number',
        value: 'phone_number',
      },
      {
        text: 'Created',
        value: 'created_at',
      },
    ],
  }),
}
</script>