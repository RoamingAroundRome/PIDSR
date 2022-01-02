<template>
  <div>
    <v-app app>
      <v-content class="primary">
        <v-container class="fill-height">
          <v-row class="mx-auto" align="center" justify="center">
            <v-col lg="5" md="6" sm="8" cols="12">
              <SignIn />
            </v-col>
          </v-row>
        </v-container>
      </v-content>

      <Snackbar />
    </v-app>
  </div>
</template>

<script>
import SignIn from "@/components/SignIn";
import Snackbar from "@/components/alerts/Snackbar";
import { mapActions } from "vuex";

export default {
  layout: "none",

  auth: 'guest',

  components: {
    SignIn,
    Snackbar,
  },
  
  head: () => ({
    title: `${process.env.title} | Sign In`,
    meta: [
      {
        hid: "description",
        name: "description",
        content: "My custom description"
      }
    ]
  }),

  data: () => ({
    projectTitle: process.env.title,
  }),
};
</script>

<style scoped>
.app-background {
  width: 100%;
  height: 100%;
  background-color: #1976d2;
}
</style>