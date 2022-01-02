import { getField, updateField } from 'vuex-map-fields'

export const state = () => ({
  diseases: [],
  disease: {},
  errors: {},
})

export const getters = {
  allDiseases: state => state.diseases,
  
  getWeeklyNotifiable: state => state.diseases
    .filter(d => d.category === 'weekly notifiable'),

  getImmediatelyNotifiable: state => state.diseases
    .filter(d => d.category === 'immediately notifiable'),
  
  getField,
}

export const mutations = {
  SET_DISEASES: (state, payload) => 
    state.diseases = payload,

  SET_DISEASE: (state, payload) =>
    state.disease = payload,

  SET_DETAILS: (state, payload) =>
    state.form.report.details = payload,

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
      const data = await this.$axios.$get('/api/diseases')

      commit("SET_DISEASES", data)
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
      const data = await this.$axios.$get(`/api/diseases/${payload}`)
      
      commit('SET_DISEASE', data)
    } catch (error) {
      console.log(error)
    }
  },
  
  /**
   * Sets the state form.
   * 
   * @param { Object } context 
   * @param { Integer } payload 
   */
  async edit({ state, commit }, payload) {
    try {
      // 
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
      // 
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