<template>
  <div>
    <v-toolbar color="transparent" dark flat>
      <v-toolbar-title>
        <h2>
          DRU
        </h2>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <div>
				<v-icon left>mdi-sync</v-icon>
				<span
					v-text="`Last Sync: ${new Date().toLocaleString()}`"
				></span>
			</div>
    </v-toolbar>

    <v-row
      justify="center"
      align="center">
      <v-col
        lg="11"
        md="11"
        sm="12"
        cols="12">
        <DRUDataTable />
      </v-col>
    </v-row>
  </div>
</template>

<script>
import DRUDataTable from '@/components/dru/DRUDataTable'

export default {
  async fetch({ store }) {
    await store.dispatch('drus/fetchAll')
  },
  
  head: () => ({
    title: `${process.env.title} | Disease Reporting Unit`,
  }),
  
  components: {
    DRUDataTable,
  }
}
</script>