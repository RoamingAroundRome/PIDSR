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
          clearable
          solo
          flat
        ></v-text-field>
        <v-toolbar-title></v-toolbar-title>
        <v-spacer></v-spacer>
        
        <v-btn
          color="primary"
          text
          width="150"
          @click="createData()"
        >
          <v-icon small left>mdi-plus-circle-outline</v-icon>
          Add New User
        </v-btn>
        
        <v-btn 
          @click="refresh()"
          :loading="refreshing"
          icon>
          <v-icon>mdi-refresh</v-icon>
        </v-btn>
        
        <v-menu
          offset-y
          left
        >
          <template v-slot:activator="{ on }">
            <v-btn
              v-on="on"
              icon
            >
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
        :items="users"
        :search="search">
        <template v-slot:item.role="{ item }">
          <v-chip
            v-text="item.role"
            :color="item.roleColor"
            label
            dark
          ></v-chip>
        </template>
        <template v-slot:item.actions="{ item }">
          <v-btn @click="$router.push({ name: 'users-id', params: { id: item.id } })" icon>
            <v-icon>mdi-eye</v-icon>
          </v-btn>
          <v-btn @click="editData(item.id)" icon>
            <v-icon>mdi-pencil</v-icon>
          </v-btn>
          <v-btn @click="remove(item.id)" icon>
            <v-icon>mdi-delete</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card>

    <UserDeleteDialog 
      :id="id"
      :value="deleteDialog"
      @toggle="deleteDialog = $event"
    />

    <UserFormDrawer 
      title="Create new User"
      :value="createDrawer"
      @toggle="createDrawer = $event"
      action="users/add"
    />

    <UserFormDrawer 
      title="Edit User"
      :id="id"
      :value="editDrawer"
      @toggle="editDrawer = $event"
      action="users/update"
    />
  </div>
</template>

<script>
import UserFormDrawer from '@/components/users/UserFormDrawer'
import UserDeleteDialog from '@/components/users/UserDeleteDialog'
import { toCSV } from '../../utils/Util'
import { mapState, mapGetters } from 'vuex'

export default {
  components: {
    UserFormDrawer,
    UserDeleteDialog,
  },
  
  methods: {
    exportCSV () {
      if (this.userList.length <= 0) {
        return this.$helpers.notify({
          type: 'info',
          message: 'Could not export an empty data.'
        })
      }
      
      return toCSV(this.userList, 'Users List')
    },
    
    async createData() {
      await this.$store.commit('users/CLEAR_FORM')
      this.createDrawer = !this.createDrawer
    },
    
    async refresh() {
      this.refreshing = true
      await this.$store.dispatch('users/fetchAll')
      this.refreshing = false
    },
    
    async editData(id) {
      this.id = id
      await this.$store.dispatch('users/edit', { id })
      this.editDrawer = !this.editDrawer
    },
    
    async remove(id) {
      this.id = id
      this.deleteDialog = !this.deleteDialog
    },
  },
  
  computed: {
    ...mapGetters({
      users: 'users/getMappedUsers'
    }),

    ...mapState({
      userList: state => state.users.users
    })
  },
  
  data: () => ({
    id: null,
    createDrawer: false,
    editDrawer: false,
    deleteDialog: false,
    refreshing: false,
    search: null,
    headers: [
      {
        text: '#',
        value: 'id',
      },
      {
        text: 'Name',
        value: 'name',
      },
      {
        text: 'Role',
        value: 'role',
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