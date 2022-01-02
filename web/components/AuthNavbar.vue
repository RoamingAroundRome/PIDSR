<template>
  <div>
    <v-navigation-drawer
      :color="true 
      ? 'blue-grey darken-4' 
      : 'grey lighten-4'"
      :mini-variant="mini"
      @click="mini = !mini"
      v-model="drawer"
      :clipped="false"
      dark
      app>
      <v-list>
        <v-list-item 
          v-for="(page, i) in filteredPages" 
          :to="{ name: page.route }" 
          :key="i"
          link>
          <v-list-item-action>
            <v-icon v-text="page.icon"></v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title 
            v-text="page.title"
            ></v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
      <template v-slot:append>
        <v-list-item class="px-2">
          <v-btn
            icon
            @click.stop="mini = !mini">
            <v-icon
              v-text="mini ? 
              'mdi-chevron-right' 
              : 'mdi-chevron-left'"
            ></v-icon>
          </v-btn>
          <v-list-item-avatar>
          </v-list-item-avatar>
          <v-list-item-title>
          </v-list-item-title>
        </v-list-item>
      </template>
    </v-navigation-drawer>

    <v-app-bar 
      :color="true 
      ? 'primary' 
      : 'blue-grey darken-4'" 
      :clipped-left="false" 
      :dark="true"
      :elevate-on-scroll="true"
      dense
      app>
      <v-btn icon @click.stop="drawer = !drawer">
        <v-icon
          v-text="drawer ? 
          'mdi-menu' 
          : 'mdi-menu-open'"
        ></v-icon>
      </v-btn>
      <v-toolbar-title class="mr-12 align-center">
        PIDSR
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <!-- <v-btn
        @click="$vuetify.theme.dark = !$vuetify.theme.dark"
        icon>
        <v-icon
          v-text="$vuetify.theme.dark 
          ? 'mdi-theme-light-dark' 
          : 'mdi-theme-light-dark'"
        ></v-icon>
      </v-btn> -->

      <v-btn 
        @click="notifDrawer = !notifDrawer"
        icon>
        <v-icon>mdi-bell</v-icon>
      </v-btn>

      <v-menu v-model="authMenu" offset-y>
        <template v-slot:activator="{ on }">
          <v-btn icon text v-on="on">
            <v-avatar size="35">
              <v-img :src="$auth.user.avatar || avatar" />
            </v-avatar>
          </v-btn>
        </template>
        <v-list>
          <v-list-item>
            <v-list-item-content 
              v-if="$auth.loggedIn"
              class="text-center">
              <v-list-item-title class="mb-5">
                <v-avatar size="128">
                  <v-img :src="$auth.user.avatar || avatar" />
                </v-avatar>
              </v-list-item-title>
              <v-list-item-title>
                <span 
                  v-text="`${$auth.user.first_name} ${$auth.user.last_name}`"
                ></span>
              </v-list-item-title>
              <v-list-item-subtitle>
                <v-chip 
                  color="red darken-2"
                  v-text="strCapitalize($auth.user.roleName) || 'Not applicable'"
                  dark
                  label
                  small
                ></v-chip>
              </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-divider></v-divider>

          <v-list-item @click="$router.push({ name: 'account-settings' })" link>
            <v-list-item-action>
              <v-icon small left>mdi-cog-outline</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                Account Settings
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          
          <v-list-item @click="logout()" link>
            <v-list-item-action>
              <v-icon small left>mdi-logout</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                Logout
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>

    <v-navigation-drawer
      v-model="notifDrawer"
      width="400"
      temporary
      right
      app>
      <v-card tile flat>
        <v-toolbar 
          flat
          dark
          dense
          color="primary">
          <v-toolbar-title>Alerts</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn 
            icon
            @click="notifDrawer = !notifDrawer">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-card-text class="d-flex justify-center align-center fill-height">
          <v-list style="height: 85vh; overflow-y: auto">
            <v-list-item
              v-for="(notif, i) in $store.getters['allNotifications']"
              :key="i">
              <v-list-item-content>
                <div
                  v-text="notif.data.message"
                ></div>
                <div v-if="notif.data.category">
                  <v-chip
                    v-text="strCapitalize(notif.data.category)"
                    :color="notif.data.category === 'immediately notifiable'
                      ? 'red' 
                      : 'orange'"
                    dark
                    label
                  ></v-chip>
                </div>
                <v-list-item-subtitle
                  v-text="formatStringDate(notif.created_at)"
                ></v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card-text>
      </v-card>
    </v-navigation-drawer>
    
  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import { dateFormat } from '../utils/Util'

export default {
  computed: {
    filteredPages() {
      return this.pages.filter(item => {
        if (item.route == 'users' && this.isOfficer) {
          return false
        }

        return true
      })
    },

    ...mapGetters({
      isAdmin: 'isAdmin',
      isOfficer: 'isOfficer',
      user: 'auth/GET_USER',
      role: 'auth/GET_ROLE',
    })
  },

  methods: {
    async logout() {
      await this.$auth.logout()
    },
  },
  
  data: () => ({
    mini: false,
    drawer: true,
    authMenu: false,
    notifDrawer: false,
    avatar: 'https://i.pravatar.cc/300',
    pages: [
      {
        title: 'Dashboard',
        icon: 'mdi-view-dashboard-outline',
        route: 'dashboard'
      },
      {
        title: 'Users',
        icon: 'mdi-account-group-outline',
        route: 'users'
      },
      {
        title: 'DRU',
        icon: 'mdi-hospital',
        route: 'disease-reporting-unit',
      },
      {
        title: 'Report',
        icon: 'mdi-chart-bell-curve',
        route: 'report'
      },
    ],
  }),
};
</script>
