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
                <v-list-item @click="edit()">
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
                {{ $auth.user.dru.name || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Type</th>
              <td class="text-center">
                {{ dru.type || 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>National Sentinel Site</th>
              <td class="text-center">
                {{ dru.national_sentinel_site ? 'Yes' : 'No' }}
              </td>
            </tr>
            <tr>
              <th>Philmis Site</th>
              <td class="text-center">
                {{ dru.philmis_site ? 'Yes' : 'No' }}
              </td>
            </tr>
            <tr>
              <th>Region</th>
              <td class="text-center">
                {{ dru.address ? dru.address.region : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Province</th>
              <td class="text-center">
                {{ dru.address ? dru.address.province : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Municity</th>
              <td class="text-center">
                {{ dru.address ? dru.address.municity : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Barangay</th>
              <td class="text-center">
                {{ dru.address ? dru.address.barangay : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Street</th>
              <td class="text-center">
                {{ dru.address ? dru.address.street : 'Not specified' }}
              </td>
            </tr>
          </v-simple-table>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data: () => ({
    avatar: 'https://api.adorable.io/avatars/285/abott@adorable.png',
    dru: $nuxt.$auth.user.dru,
  }),

  methods: {
    edit() {
      // code
    },
  }
}
</script>