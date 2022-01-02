<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-toolbar-title>
        <h2>Report</h2>
      </v-toolbar-title>
      <v-spacer></v-spacer>
			<div>
				<v-icon left>mdi-sync</v-icon>
				<span
					v-text="`Last Sync: ${new Date().toLocaleString()}`"
				></span>
			</div>
    </v-toolbar>

    <div class="mb-10"></div>

    <v-row
      justify="center"
      align="center"
    >
      <v-col
        lg="5"
        md="6"
        sm="12"
        cols="12">
        <v-btn 
          @click="$router.push({ name: 'report-category-selection' })"
          block
          x-large>
          Add New Report
        </v-btn>

        <div class="mb-10"></div>

        <v-btn 
          @click="$router.push({ name: 'report-view' })"
          block
          x-large>
          View Report
        </v-btn>
      </v-col>
    </v-row>

  </div>
</template>

<script>
export default {
  head: () => ({
    title: `${process.env.title} | Reports`,
  }),
}
</script>