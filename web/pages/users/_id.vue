<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-btn @click="$router.go(-1)" icon>
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
      <v-toolbar-title>
        <h2>
          User Profile
        </h2>
      </v-toolbar-title>
    </v-toolbar>

    <UserProfile />
  </div>
</template>

<script>
import UserProfile from '@/components/users/UserProfile'

export default {
	middleware: 'admin',
  
  async fetch({ store, params }) {
    await store.dispatch('users/fetch', params.id)
  },
  
  head: () => ({
    title: `${process.env.title} | User`,
  }),
  
  components: {
    UserProfile
  }
}
</script>