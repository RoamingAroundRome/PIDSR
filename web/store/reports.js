import { 
  Patient,
  createPatient,
} from '../models/Patient.js'

import { 
  Address,
  createAddress,
} from '../models/Address.js'

import { 
  Report,
  createReport,
} from '../models/Report.js'
import { getField, updateField } from 'vuex-map-fields'

export const state = () => ({
  diseaseId: null,
  reports: [],
  result: {},
  summary: {},
  latestEntries: [],
  allLatestEntries: [],
  report: {},
  form: {
    patient: new Patient(),
    address: new Address(),
    report: new Report()
  },
  errors: {},
})

export const getters = {
  getAllLatestEntries: state => state.allLatestEntries
    .map(item => {
      const cases = item.cases.filter(data => {
        if (state.diseaseId) {
          return data.disease_id === state.diseaseId 
        }

        return true
      })

      return {
        id: item.id,
        name: item.name,
        latest_entry: item.latest_entry,
        cases: cases.length
      }
    }),

  getLatestEntries: state => state.latestEntries
    .map(item => {
      const cases = item.cases.filter(data => {
        if (state.diseaseId) {
          return data.disease_id === state.diseaseId 
        }

        return true
      })

      return {
        id: item.id,
        name: item.name,
        latest_entry: item.latest_entry,
        cases: cases.length
      }
    }),
  
  casesPastHour: state => state.summary?.past_hour
    .filter(item => state.diseaseId ? item.disease_id === state.diseaseId : true)
    .length,
  
  casesPastWeek: state => state.summary?.past_week
    .filter(item => state.diseaseId ? item.disease_id === state.diseaseId : true)
    .length,


  casesPastMonth: state => state.summary?.past_month
    .filter(item => state.diseaseId ? item.disease_id === state.diseaseId : true)
    .length,

  
  casesPerBarangay: state => state.result?.cases_per_barangay || [],

  patientList: state => state.result.patient_list,
  
  // map out the retrieved data from search query
  // only for weeks and the cases count
  casesPerMorbidityWeekCount: state => {
    const _cases = state.result.cases_per_morbidity_week
    let weeks = []
    let cases = []
    for (let key in _cases) {
      if (_cases.hasOwnProperty(key)) {
        const casesCount = _cases[key].length
        const week = `Week ${key}`
        weeks.push(week)
        cases.push(casesCount)
      }
    }

    return {
      weeks,
      cases
    }
  },

  // the chart options in reporting module
  casesPerMorbidityWeekChartOptions: (state, getters, rootState, rootGetters) => ({
    chart: {
      id: 'cases'
    },
    xaxis: {
      categories: getters.casesPerMorbidityWeekCount.weeks
    }
  }),

  // for the barchart in reporting module
  casesPerMorbidityWeekChartData: (state, getters, rootState, rootGetters) => [{
    name: 'cases-per-morbidity-week',
    data: getters.casesPerMorbidityWeekCount.cases
  }],
  
  getField,
}

export const mutations = {
  SET_REPORTS: (state, payload) => 
    state.reports = payload,

  SET_REPORT: (state, payload) =>
    state.report = payload,

  SET_CASES_SUMMARY: (state, payload) =>
    state.summary = payload,

  SET_LATEST_ENTRIES: (state, payload) => 
    state.latestEntries = payload,
    
  SET_ALL_LATEST_ENTRIES: (state, payload) =>
    state.allLatestEntries = payload,

  SET_SEARCH_RESULT: (state, payload) =>
    state.result = payload,
  
  SET_DISEASE_ID: (state, payload) => 
    state.form.report.disease_id = payload,
    
  SET_DETAILS: (state, payload) =>
    state.form.report.details = payload,

  RESET_FORM: state => state.form = {
    patient: new Patient(),
    address: new Address(),
    report: new Report()
  },

  RESET_SEARCH_RESULT: (state) => state.result = {},

  updateField,
}

export const actions = {
  /**
   * Fetch all resources.
   * 
   * @param { Object } context 
   */
  async fetchAll({ commit }) {
    try {
      //   
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Fetch all reports summary.
   * # past hour
   * # past week
   * # past month
   * 
   * @param { Object } context 
   */
  async fetchSummary({ commit }) {
    try {
      const data = await this.$axios.$get('/api/reports/cases/summary')

      commit('SET_CASES_SUMMARY', data)
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Fetch all latest entries of all DRU.
   * 
   * @return { Void }
   */
  async fetchAllLatestEntries({ commit }) {
    try {
      const data = await this.$axios.$get('/api/reports/cases/all-latest-entries')

      commit('SET_ALL_LATEST_ENTRIES', data)
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Fetch all latest entries of a DRU officer.
   * 
   * @return { Void }
   */
  async fetchLatestEntries({ commit }) {
    try {
      const data = await this.$axios.$get('/api/reports/cases/latest-entries')

      commit('SET_LATEST_ENTRIES', data)
    } catch (error) {
      console.log(error)
    }
  },
  
  /**
   * Fetch a single resource.
   * 
   * @param { Object } context
   */
  async fetchAllDeleted({ commit }) {
    try {
      // 
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Fetch a single resource.
   * 
   * @param { Object } context
   * @param { Integer } payload
   * # must have id 
   */
  async fetch({ commit }, payload) {
    try {
      // 
    } catch (error) {
      console.log(error)
    }
  },
  
  /**
   * Sends a search query.
   * # payload
   * [disease id]
   * [region]
   * [municity]
   * [date from]
   * [date to]
   * 
   * @param { Object } context 
   * @param { Integer } payload 
   */
  async search({ commit, dispatch, rootState }, payload) {
    try {
      const result = await this.$axios.$post('/api/reports/search', payload)
      const diseases = rootState.diseases.diseases

      if (diseases.length > 0) {
        const index = diseases.findIndex(item => 
          item.id === payload.disease_id
        )

        await commit('diseases/SET_DISEASE', 
          diseases[index], 
          { root: true }
        )
      } 

      else {
        await dispatch('diseases/fetch', 
          payload.disease_id, 
          { root: true }
        )
      }

      commit('SET_SEARCH_RESULT', result)
    } catch (error) {
      console.log(error)
    }
  },  
  
  /**
   * Add new data.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async add({ state, commit, dispatch }) {
    try {
      const data = await this.$axios.$post(`/api/reports`, state.form)

      await commit('RESET_FORM')
      await this.$helpers.notify({
        type: 'success',
        message: 'A new case report has been submitted.'
      })
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Updates a single resource based on id.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async update({ state, commit, dispatch }, payload) {
    try {
      // 
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Softly deletes a resource.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async destroy({ commit, dispatch }, payload) {
    try {
      // 
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Restores a softly deleted resource.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async restore({ commit, dispatch }, payload) {
    try {
      // 
    } catch (error) {
      console.log(error)
    }
  },

  /**
   * Deletes a resource permanently.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async forceDestroy({ commit, dispatch }, payload) {
    try {
      // 
    } catch (error) {
      console.log(error)
    }
  },
}