import { 
  DRU,
  mapDRU,
} from '../models/DRU.js'

import { 
  User,
} from '../models/User.js'

import { getField, updateField } from 'vuex-map-fields'

export const state = () => ({
  drus: [],
  dru: {},
  errors: {},
  form: {
    dru: new DRU(),
    officer: new User(),
  },
})

export const getters = {
  mappedDRUs: state => state.drus
    .map(d => mapDRU(d)),
  
  getField,
}

export const mutations = {
  SET_DRUS: (state, payload) => 
    state.drus = payload,

  SET_DRU: (state, payload) =>
    state.dru = payload,

  SET_ERRORS: (state, payload) =>
    state.errors = payload,
    
  ADD_DRU: (state, payload) =>
    state.drus.push(payload),

  REMOVE_DRU: (state, payload) => {
    const index = state.drus.findIndex(d => d.id == payload)
    state.drus.splice(index, 1)
  },

  CLEAR_FORM: state => state.form = {
    dru: new DRU(),
    officer: new User(),
  },

  CLEAR_ERRORS: state => state.errors = {},

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
      const data = await this.$axios.$get('/api/drus')

      commit("SET_DRUS", data)
    } catch (error) {
      console.log(error)
    }
  },

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
   * @param { Object } payload
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
   * Add new data.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async add({ state, commit, dispatch }) {
    try {
      const data = await this.$axios.$post('/api/drus', state.form)

      await commit('CLEAR_FORM')
      await commit('CLEAR_ERRORS')
      await this.$helpers.notify({
        type: 'success',
        message: data.message || 'A DRU was added.',
      })
      await dispatch('fetchAll')
    } catch (error) {
      const statusCode = error.response.status
      console.log(statusCode)
      if (statusCode === 422) {
        const errors = error.response.data.errors
        commit("SET_ERRORS", errors)
      }

      await this.$helpers.notify({
        type: 'error',
        message: 'A DRU was not added.',
      })
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
      const data = await this.$axios.$put(`/api/drus/${payload.id}`, payload.data)

      console.log(data)
      await this.$helpers.notify({
        type: 'success',
        message: 'A DRU was updated.',
      })
    } catch (error) {
      console.log(error)
      await this.$helpers.notify({
        type: 'error',
        message: 'A DRU was not updated.',
      })
    }
  },

  /**
   * Soft deletes a resource.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async destroy({ commit, dispatch }, payload) {
    try {
      await this.$axios.$delete(`/api/drus/${payload.id}`)
      
      await this.$helpers.notify({
        type: 'success',
        message: 'A DRU has been removed.',
      })
      await dispatch('fetchAll')
    } catch (error) {
      console.log(error)
      await this.$helpers.notify({
        type: 'error',
        message: 'Unable to delete a DRU.',
      })
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