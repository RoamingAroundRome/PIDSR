<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-btn @click="$router.go(-1)" icon>
        <v-icon>mdi-arrow-left</v-icon>
      </v-btn>
      <v-toolbar-title>
        <h2>
          New DRU
        </h2>
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
        <DRUCreateForm />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import DRUCreateForm from '@/components/dru/DRUCreateForm'

export default {
  head: () => ({
    title: `${process.env.title} - Disease Reporting Unit Form`,
  }),
  
  components: {
    DRUCreateForm,
  }
}
</script>