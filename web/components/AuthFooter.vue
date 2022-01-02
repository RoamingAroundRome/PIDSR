<template>
  <div>
    <v-footer max-height="40" inset padless app>
      <v-row>
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