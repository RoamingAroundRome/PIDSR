<template>
  <div>
    <v-form @submit.prevent="submit()">
      <v-row
        justify="center"
        align="center">
        <v-col 
          lg="12" 
          md="12" 
          sm="12" 
          cols="12">
          <v-card>
            <v-toolbar color="transparent" flat>
              <v-toolbar-title>
                Disease Reporting Unit (DRU)
              </v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <DRUFields />
            </v-card-text>
          </v-card>
        </v-col>

        <v-col 
          lg="12" 
          md="12" 
          sm="12" 
          cols="12">
          <v-card>
            <v-toolbar class="transparent" flat>
              <v-toolbar-title>
                Disease Reporting Unit Officer
              </v-toolbar-title>
            </v-toolbar>
            <v-card-text>
              <DRUOfficerFields />
            </v-card-text>
          </v-card>
        </v-col>

        <v-col
          lg="12"
          md="12"
          sm="12"
          cols="12">
          <div class="text-center">
            <v-btn 
              type="submit"
              color="primary"
              width="300"
              x-large>
              Submit
            </v-btn>
          </div>
        </v-col>
      </v-row>
    </v-form>

    <div class="mb-10"></div>
  </div>
</template>

<script>
import DRUFields from '@/components/dru/DRUFields'
import DRUOfficerFields from '@/components/dru/DRUOfficerFields'

export default {
  components: {
    DRUFields,
    DRUOfficerFields,
  },

  methods: {
    async submit() {
      await this.$store.dispatch('loaders/execute', true)
      await this.$store.dispatch('drus/add')
      await setTimeout(async() => {
        await this.$store.dispatch('loaders/execute', false)
      }, 1500)
    },
  },
}
</script>