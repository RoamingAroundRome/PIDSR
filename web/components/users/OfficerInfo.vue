<template>
  <div>
    <v-row
      justify="center"
      align="center">
      <v-col 
        class="mx-10"
        lg="5"
        md="6"
        sm="12"
        cols="12">
        <v-card>
          <v-toolbar color="transparent" flat>
            <v-toolbar-title>
              Officer Info
            </v-toolbar-title>
            
            <v-spacer></v-spacer>
            
            <v-menu
              v-if="isAdmin"
              offset-y
              absolute>
              <template v-slot:activator="{ on }">
                <v-btn 
                  v-on="on"
                  icon>
                  <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
              </template>
              <v-list dense>
                <v-list-item @click="editDialog = !editDialog">
                  <v-list-item-content>
                    <v-list-item-title>
                    <v-icon small left>mdi-pencil</v-icon>
                      Edit
                    </v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-list>
            </v-menu>
            
          </v-toolbar>
          
          <v-divider></v-divider>
          <v-simple-table>
            <tr>
              <th>Name</th>
              <td class="text-center">
                {{ `${first_name || 'Not specified' } ${last_name || '' }` }}
              </td>
            </tr>
            <tr>
              <th>Start Date</th>
              <td class="text-center">
                {{ date_started ? formatDate(date_started) : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>End Date</th>
              <td class="text-center">
                {{ date_ended ? formatDate(date_ended) : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Contact Number</th>
              <td class="text-center">
                {{ phone_number || 'Not specified' }}
              </td>
            </tr>
          </v-simple-table>
        </v-card>
      </v-col>
    </v-row>

    <v-dialog 
      v-model="editDialog" 
      max-width="450"
      scrollable>
      <v-card>
        <v-toolbar color="transparent" flat>
          <v-btn @click="editDialog = !editDialog" icon>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <div class="mb-5"></div>
          <OffcerInfoEdit />
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn 
            color="primary"
            @click="editDialog = !editDialog"
            text>
            CANCEL
          </v-btn>
          <v-btn 
            text
            @click="$store.dispatch('users/updateUser', {
                id: $route.params.id,
                data: user
              })
              .then(() => editDialog = !editDialog)"
            color="primary">
            SAVE
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import { mapFields } from 'vuex-map-fields'
import OffcerInfoEdit from '@/components/users/OfficerInfoEdit'

export default {
  components: {
    OffcerInfoEdit
  },
  
  data: () => ({
    editDialog: false,
    avatar: 'https://api.adorable.io/avatars/285/abott@adorable.png',
  }),

  computed: {
    ...mapState({
      user: state => state.users.user
    }),
    
    ...mapFields('users', [
      'user.first_name',
      'user.middle_name',
      'user.last_name',
      'user.email',
      'user.phone_number',
      'user.date_started',
      'user.date_ended',
    ])
  }
}
</script>