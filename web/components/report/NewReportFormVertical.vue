<template>
  <div>
    <v-card>
      <v-toolbar color="transparent" flat>
        <v-toolbar-title>
          New Case Record: {{ diseaseName }}
        </v-toolbar-title>
      </v-toolbar>
      <v-stepper 
        v-model="step" 
        class="elevation-0"
        vertical>
				<v-stepper-step 
					:complete="step > 1" 
					step="1">
					Patient Information
				</v-stepper-step>

				<v-stepper-content step="1">
					<PatientFields />
					<v-card flat>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn
								depressed
								color="primary"
								@click="step = 2">
								Continue
							</v-btn>
						</v-card-actions>
					</v-card>
				</v-stepper-content>

				<v-stepper-step
					:key="i"
					v-for="(section, i) in Object.keys(fields)"
					:complete="step > (i + 2)"
					:step="(i + 2)">
					{{ section }}
				</v-stepper-step>

				<v-stepper-content 
					:step="(i + 2)"
					:key="i"
					v-for="(groupFields, i) in Object.values(fields)">
					<component 
						:label="field.question"
						:items="field.choices"
						:type="field.type"
						:is="field.component" 
						v-for="(field, i) in groupFields"
						v-model="field.answer"
						:key="i"
						filled
					/>
					<v-card flat>
						<v-card-actions>
							<v-spacer></v-spacer>
							<v-btn 
								@click="step = ((i + 2) - 1)"
								text>
								Back
							</v-btn>
							<v-btn
								depressed
								color="primary"
								v-if="(Object.keys(fields).length + 1) != step"
								@click="step = (i + 3)">
								Continue
							</v-btn>
							<v-btn
								depressed
								color="primary"
								v-else
								@click="submit()">
								Submit
							</v-btn>
						</v-card-actions>
					</v-card>
				</v-stepper-content>
      </v-stepper>
    </v-card>
  </div>
</template>

<script>
import PatientFields from '@/components/report/PatientFields'
import ClinicalFields from '@/components/report/ClinicalFields'
import { mapState } from 'vuex'
import { mapFields } from 'vuex-map-fields'

export default {
  components: {
    PatientFields,
    ClinicalFields
  },

  created() {
    this.fetch()

    console.log('field set', this.fields)
  },

  data: () => ({
    step: 1,
    fields: {}
  }),

  computed: {
    ...mapState({
      diseaseName: state => state.diseases.disease.name || 'Not specified',

      disease: state => state.diseases.disease || {},
    }),
  },

  methods: {
    async fetch() {
      try {
        const data = await this.$axios.$get(`/api/diseases/${this.$route.params.slug}`)

        this.fields = data.fields
      } catch (error) {
        console.log(error)
      }
    },

    // Sets the form state from diseases store module
    // Then dispatches an action to vuex to send form data
    async submit() {
      let fields = []
      Object.values(this.fields).forEach(groupFields => {
        groupFields.forEach(field => {
          fields.push({
            section: field.section,
            question: field.question,
            answer: field.answer,
          })
        })
      })

      await this.$store.commit('diseases/SET_DETAILS', fields)
    }
  }
}
</script>