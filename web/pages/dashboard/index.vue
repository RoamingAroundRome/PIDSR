<template>
	<div>
		<v-toolbar color="transparent" dark flat>
			<v-toolbar-title>
        <h2>
					Dashboard
				</h2>
			</v-toolbar-title>
			<div class="ml-5">
				<v-autocomplete
					v-model="diseaseId"
					label="Filter by Disease"
					:items="$store.getters['diseases/allDiseases']"
					item-text="name"
					item-value="id"
					clearable
					hide-details
					light
					solo
				></v-autocomplete>
			</div>
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
				<v-row>
					<v-col
						lg="4"
						md="4"
						sm="12"
						cols="12">
						<Count 
							title="Cases in the past hour"
							:value="casesPastHour"
							borderColor="grey"
						/>
					</v-col>
					<v-col
						lg="4"
						md="4"
						sm="12"
						cols="12">
						<Count 
							title="Cases in the last 7 days"
							:value="casesPastWeek"
							borderColor="orange"
						/>
					</v-col>
					<v-col
						lg="4"
						md="4"
						sm="12"
						cols="12">
						<Count 
							title="Cases in the last 30 days"
							:value="casesPastMonth"
							borderColor="red"
						/>
					</v-col>
				</v-row>

				<v-row>
					<v-col>
						<DRULatestEntries />
					</v-col>
				</v-row>
			</v-col>
		</v-row>
	</div>
</template>

<script>
import Count from '@/components/reporting/Count'
import DRULatestEntries from '@/components/reporting/DRULatestEntries'
import { isUndefined } from '../../utils/Util'
import { mapState, mapGetters } from 'vuex'
import { mapFields } from 'vuex-map-fields'

export default {
	head: () => ({
    title: `${process.env.title} | Dashboard`,
	}),

	async fetch({ store }) {
		await store.dispatch('reports/fetchAllLatestEntries'),
		await store.dispatch('reports/fetchLatestEntries')
		await Promise.all([
			store.dispatch('reports/fetchSummary'),
			store.dispatch('diseases/fetchAll'),
		]) 
	},
	
	components: {
		Count,
		DRULatestEntries,
	},

	computed: {
		...mapGetters({
			casesPastHour: 'reports/casesPastHour',
			casesPastWeek: 'reports/casesPastWeek',
			casesPastMonth: 'reports/casesPastMonth',
		}),

		...mapFields('reports', [
			'diseaseId'
		])
	},
}
</script>