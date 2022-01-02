<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-btn @click="$router.go(-1)" icon>
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
      <v-toolbar-title>
        <h2>
          New User
        </h2>
      </v-toolbar-title>
    </v-toolbar>

    <UserCreateForm />
  </div>
</template>

<script>
import UserCreateForm from '@/components/users/UserCreateForm'

export default {
  middleware: 'admin',
  
  components: {
    UserCreateForm,
  }
}
</script>