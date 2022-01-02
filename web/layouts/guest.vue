<template>
  <div>
    <v-app app>
      <GuestNavbar />
      
      <v-content>
        <div class="app-background">
          <nuxt />
        </div>
      </v-content>

      <!-- <GuestFooter /> -->
    </v-app>
  </div>
</template>

<script>
import GuestFooter from "@/components/GuestFooter";
import GuestNavbar from "@/components/GuestNavbar";

export default {
  components: {
    GuestNavbar,
    GuestFooter,
  },
};
</script>

<style scoped>
.bg {
  background-image: linear-gradient(-20deg, #2b5876 0%, #4e4376 100%);
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  position: absolute;
}

.app-background {
  width: 100%;
  height: 20rem;
  background-color: #1976d2;
}
</style>