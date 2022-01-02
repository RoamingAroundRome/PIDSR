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
          color="primary"
          text
          width="150"
          @click="$router.push({ name: 'disease-reporting-unit-create' })">
          <v-icon small left>mdi-plus-circle-outline</v-icon>
          Add New DRU
        </v-btn>
        
        <v-btn 
          @click="refresh()"
          :loading="refreshing"
          icon>
          <v-icon>mdi-refresh</v-icon>
        </v-btn>
        
        <v-menu
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
                <v-list-item-title>Export to CSV</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="drus"
        :search="search">
        <template v-slot:item.actions="{ item }">
          <v-btn @click="$router.push({ 
            name: 'disease-reporting-unit-id', 
            params: { id: item.officer.id } 
            })" :disabled="!item.officer" icon>
            <v-icon>mdi-eye</v-icon>
          </v-btn>
          <v-btn v-if="isAdmin" @click="remove(item.id)" icon>
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card>

    <v-dialog 
      v-model="deleteDialog" 
      max-width="400" 
      scrollable>
      <v-card>
        <v-toolbar color="transparent" flat>
          <v-toolbar-title>
            Confirm Delete
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn @click="deleteDialog = false" icon>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <div class="mb-5"></div>
          Are you sure you want to delete this DRU?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn 
            @click="deleteDialog = false"
            color="primary" 
            text>
            Cancel
          </v-btn>
          <v-btn 
            @click="$store.dispatch('drus/destroy', { id }).then(() => deleteDialog = false)"
            color="primary" 
            text>
            Confirm
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import { toCSV } from '../../utils/Util'

export default {
  methods: {
    exportCSV () {
      if (this.druList.length <= 0) {
        return this.$helpers.notify({
          type: 'info',
          message: 'Could not export an empty data.'
        })
      }
      
      return toCSV(this.druList, 'DRU List')
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
      drus: 'drus/mappedDRUs'
    }),
    
    ...mapState({
      druList: state => state.drus.drus
    })
  },
  
  data: () => ({
    id: null,
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
      {
        text: 'Actions',
        value: 'actions',
        sortable: false,
      }
    ],
  }),
}
</script>

<style>

</style>