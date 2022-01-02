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
              <th>Name</th>
              <td class="text-center">
                {{ `${$auth.user.first_name || 'Not specified' } ${$auth.user.last_name || '' }` }}
              </td>
            </tr>
            <tr>
              <th>Start Date</th>
              <td class="text-center">
                {{ $auth.user.date_started ? formatDate($auth.user.date_started) : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>End Date</th>
              <td class="text-center">
                {{ $auth.user.date_ended ? formatDate($auth.user.date_ended) : 'Not specified' }}
              </td>
            </tr>
            <tr>
              <th>Contact Number</th>
              <td class="text-center">
                {{ $auth.user.phone_number || 'Not specified' }}
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
  }),

  methods: {
    edit() {
      // code
    }
  }
}
</script>