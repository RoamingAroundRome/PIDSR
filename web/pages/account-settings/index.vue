<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-btn @click="$router.go(-1)" icon>
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
      <v-toolbar-title>
        <h2>
          Account
        </h2>
      </v-toolbar-title>
    </v-toolbar>

    <AuthProfile />
  </div>
</template>

<script>
import AuthProfile from '@/components/auth/AuthProfile'

export default {
  head: () => ({
    title: `${process.env.title} | Account Settings`,
  }),
  
  components: {
    AuthProfile,
  }
}
</script>