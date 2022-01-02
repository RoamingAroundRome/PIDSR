import { getField, updateField } from 'vuex-map-fields'

export const state = () => ({
  loading: false,
})

export const getters = {
  getField,
}

export const mutations = {
  setLoading: (state, payload) => state.loading = payload,
  
  updateField,
}

export const actions = {
  /**
   * Triggers the laoding overlay.
   * 
   * @param { Boolean } show 
   * @param { String } message 
   * @param { String } type # success or error 
   */
  execute({ commit }, payload) {
    commit('setLoading', payload)
  },
}