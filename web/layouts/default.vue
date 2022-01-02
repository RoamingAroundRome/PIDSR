<template>
  <div>
    <v-app app>
      <AuthNavbar />
      
      <v-content app>
        <div class="app-background primary">
          <v-container 
            fluid
          >
            <nuxt />
          </v-container>

        </div>
      </v-content>

      <!-- <AuthFooter /> -->
      <Snackbar />
      <Loading />
    </v-app>
  </div>
</template> 

<script>
import AuthNavbar from '@/components/AuthNavbar'
import AuthFooter from '@/components/AuthFooter'
import Snackbar from '@/components/alerts/Snackbar'
import Loading from '@/components/loaders/Loading'

export default {
  components: {
    AuthNavbar,
    Snackbar,
    Loading,
    AuthFooter,
  },
  
  data: () => ({
    title: process.env.title,
    avatar: 'https://api.adorable.io/avatars/285/abott@adorable.png',
  }),
}
</script>

<style>
html {
  scroll-behavior: smooth;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

.app-background {
  width: 100%;
  height: 25rem;
}

.app-footer {
  height: 20rem;
  bottom: 0;
  left: 0;
  background-color: #1976d2;
}
</style>

