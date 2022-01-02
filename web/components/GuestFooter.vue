<template>
  <div>
    <v-footer inset padless app>
      <v-row class="px-4">
        <v-col class="text-center">
          {{ new Date().getFullYear() }} — <strong>{{ title }}</strong>
        </v-col>
      </v-row>
    </v-footer>
  </div>
</template>

<script>
export default {
  data: () => ({
    title: process.env.title,
  }),
}
</script>