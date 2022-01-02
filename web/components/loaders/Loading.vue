<template>
  <div>
    <v-overlay :value="loading">
      <v-progress-circular 
        indeterminate 
        size="64"
      ></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'

export default {
  computed: {
    ...mapFields('loaders', [
      'loading'
    ])
  }
}
</script>