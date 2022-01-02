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
        lg="8" 
        md="8" 
        sm="12" 
        cols="12">
        <v-card>
          <v-card-text>
            <div class="text-center headline">
              Please select a disease that you wish to add a report
            </div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row 
      justify="center" 
      align="center">
      <v-col
        lg="11"
        md="11"
        sm="12"
        cols="12">

        <v-row>
          <v-col 
            lg="6" 
            md="6" 
            sm="12" 
            cols="12">
            <v-card height="100%">
              <v-card-text>
                <div class="text-center title font-weight-regular">
                  Category 1
                </div>
                <div class="text-center subtitle-2 font-weight-regular">
                  Immediately Notifiable Diseases
                </div>
              </v-card-text>
              <v-card-text>
                <v-list>
                  <v-list-item
                    @click="$router.push({ name: 'report-create-slug', params: { slug: disease.slug } })"
                    :key="i"
                    v-for="(disease, i) in immediately"
                    v-text="disease.name"
                  ></v-list-item>
                </v-list>
              </v-card-text>
            </v-card>  
            <v-card-text
              class="text-center"
              v-text="`${immediately.length} diseases for Category 1`"
            ></v-card-text>
          </v-col>
          <v-col 
            lg="6" 
            md="6" 
            sm="12" 
            cols="12">
            <v-card height="100%">
              <v-card-text>
                <div class="text-center title font-weight-regular">
                  Category 2
                </div>
                <div class="text-center subtitle-2 font-weight-regular">
                  Weekly Notifiable Diseases
                </div>
              </v-card-text>
              <v-card-text>
                <v-list>
                  <v-list-item
                    @click="$router.push({ name: 'report-create-slug', params: { slug: disease.slug } })"
                    :key="i"
                    v-for="(disease, i) in weekly"
                    v-text="disease.name"
                  ></v-list-item>
                </v-list>
              </v-card-text>
            </v-card>  
            <v-card-text
              class="text-center"
              v-text="`${weekly.length} diseases for Category 2`"
            ></v-card-text>
          </v-col>
        </v-row>
        
      </v-col>
    </v-row>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  head: () => ({
    title: `${process.env.title} | Reports Category Selection`,
  }),

  async fetch({ store }) {
    await store.dispatch('diseases/fetchAll')
  },
  
  computed: {
    ...mapGetters({
      immediately: 'diseases/getImmediatelyNotifiable',
      weekly: 'diseases/getWeeklyNotifiable',
    })
  }
}
</script>