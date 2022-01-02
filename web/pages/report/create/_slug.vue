<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-btn @click="$router.go(-1)" icon>
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
      <v-toolbar-title>
        <h2>Add Report</h2>
      </v-toolbar-title>
    </v-toolbar>

    <v-row
      justify="center"
      align="center">
      <v-col
        lg="11"
        md="11"
        sm="12"
        cols="12">
        <v-card v-if="loading" height="40rem">
          <v-card-text class="d-flex justify-center align-center fill-height">
            <v-progress-circular
              :size="64"
              color="primary"
              indeterminate
            ></v-progress-circular>
          </v-card-text>
        </v-card>
        <NewReportFormHorizontal v-else />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import NewReportFormHorizontal from '@/components/report/NewReportFormHorizontal'

export default {
  head: () => ({
    title: `${process.env.title} | New Report`,
  }),

  components: {
    NewReportFormHorizontal
  },

  data: () => ({
    loading: false,
  }),

  async fetch({ store, params }) {
    await store.dispatch('diseases/fetch', params.slug)
  },

  async created() {
    this.loading = true

    await setTimeout(() => {
      this.loading = false
    }, 1500)
  }
}
</script>