<template>
  <div>
    <v-app app>
      <GuestNavbar />
      
      <v-content app>
        <v-container class="fill-height">
          <v-row 
            justify="center" 
            align="center">
            <v-col 
              lg="6"
              md="6"
              sm="12"
              cols="12">

              <div class="text-center">
                <img 
                  src="/pidsr-logo.png" 
                  class="mb-5"
                />
                <v-btn 
                  @click="$router.push({ name: 'login' })"
                  width="300"
                  x-large>
                  Sign In
                </v-btn>
              </div>
              
            </v-col>
          </v-row>
        </v-container>
      </v-content>
    </v-app>
  </div>
</template>

<script>
import GuestNavbar from '@/components/GuestNavbar'

export default {
  auth: 'guest',
  
  layout: "none",

  components: {
    GuestNavbar
  },

  head: () => ({
    title: `${process.env.title}`,
    meta: [
      {
        hid: "description",
        name: "description",
        content: "My custom description"
      }
    ]
  }),
};
</script>

<style>
.app-background {
  width: 100%;
  height: 20rem;
  background-color: #1976d2;
}

img {
  max-height: 300px;
  max-width: 300px;
}
</style>