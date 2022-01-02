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
              DRU Info
            </v-toolbar-title>
            
            <v-spacer></v-spacer>

            <v-menu
              v-if="role !== 'admin'"
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
              <th>DRU</th>
              <td class="text-center">
                {{ name || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Type</th>
              <td class="text-center">
                {{ type || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>National Sentinel Site</th>
              <td class="text-center">
                {{ national_sentinel_site ? 'Yes' : 'No' }}
              </td>
            </tr>
            <tr>
              <th>Philmis Site</th>
              <td class="text-center">
                {{ philmis_site ? 'Yes' : 'No' }}
              </td>
            </tr>
            <tr>
              <th>Region</th>
              <td class="text-center">
                {{ address && address.region || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Province</th>
              <td class="text-center">
                {{ address && address.province || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Municity</th>
              <td class="text-center">
                {{ address && address.municity || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Barangay</th>
              <td class="text-center">
                {{ address && address.barangay || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Street</th>
              <td class="text-center">
                {{ address && address.street || 'Not specified' }}
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
          <DRUInfoEdit />
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
            @click="$store.dispatch('drus/update', {
                id: dru_id,
                data: dru,
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
import { mapFields } from 'vuex-map-fields'
import DRUInfoEdit from '@/components/users/DRUInfoEdit'

export default {
  components: {
    DRUInfoEdit
  },
  
  data: () => ({
    editDialog: false,
    avatar: 'https://api.adorable.io/avatars/285/abott@adorable.png',
  }),

  computed: {
    ...mapFields('users', [
      'user.role',
      'user.dru',
      'user.dru_id',
      'user.dru.name',
      'user.dru.type',
      'user.dru.address',
      'user.dru.national_sentinel_site',
      'user.dru.philmis_site',
    ])
  }
}
</script>