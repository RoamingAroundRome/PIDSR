<template>
	<div>
		<v-toolbar color="transparent" dark flat>
			<v-toolbar-title>
				<h2>
					Users
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
				<UserDataTable />
			</v-col>
		</v-row>
	</div>
</template>

<script>
import UserDataTable from '@/components/users/UserDataTable'

export default {
	middleware: 'admin',
	
	head: () => ({
    title: `${process.env.title} | Users`,
  }),
	
	components: {
		UserDataTable,
	},

	async fetch({ store }) {
		await store.dispatch('users/fetchAll')
	}
}
</script>
