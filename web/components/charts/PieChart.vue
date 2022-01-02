<template>
  <div>
		<GChart
			type="PieChart"
			:data="data"
			:options="options"
			:events="events"
		/>			

  </div>
</template>

<script>
import { GChart } from 'vue-google-charts'

export default {
	components: {
    GChart
	},
	
	props: {
		data: Array,
		options: Object,
		events: Object,
	}
}
</script>