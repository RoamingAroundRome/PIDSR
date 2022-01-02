<template>
  <div>
    <v-app-bar 
      :color="true 
      ? 'primary' 
      : 'blue-grey darken-4'" 
      dark
      :elevate-on-scroll="true"
      app>
      <v-toolbar-title class="mr-12 align-center">
        PIDSR
      </v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn 
      @click="$router.push({ name: 'login' })" 
      large 
      text>
        Sign In
      </v-btn>
    </v-app-bar>
  </div>
</template>