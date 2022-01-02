import { 
  User,
  createUser, 
  mapUser, 
} from '../models/User.js'
import { getField, updateField } from 'vuex-map-fields'

export const state = () => ({
  users: [],
  user: {},
  errors: {},
  form: new User(),
})

export const getters = {
  getMappedUsers: state => state.users
    .map(data => {
      return mapUser(data)
    }),
  
  getField,
}

export const mutations = {
  SET_USERS: (state, payload) => 
    state.users = payload,

  SET_USER: (state, payload) =>
    state.user = payload,

  SET_FORM: (state, payload) => {
    const user = state.users.find(d => d.id === payload.id)
    if (user) {
      state.form = new User(user)
    }
  },

  SET_ERRORS: (state, payload) =>
    state.errors = payload,
    
  ADD_USER: (state, payload) =>
    state.users.push(payload),

  REMOVE_USER: (state, payload) => {
    const index = state.users.findIndex(d => d.id == payload)
    state.users.splice(index, 1)
  },

  CLEAR_FORM: state => state.form = new User(),

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
      const data = await this.$axios.$get('/api/users')

      commit("SET_USERS", data)
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
      const data = await this.$axios.$get(`/api/users/${payload}`)
      
      commit('SET_USER', data)
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
      commit('SET_FORM', payload)
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
      const user = createUser(state.form)

      await this.$axios.$post('/api/users', user)

      await commit('CLEAR_FORM')
      await commit('CLEAR_ERRORS')
      await this.$helpers.notify({
        type: 'success',
        message: 'A new user has been added.',
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
        message: 'An user was not added.',
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
      const user = createUser(state.form)
      const data = await this.$axios.$put(`/api/users/${payload}`, user)
      
      await this.$helpers.notify({
        type: 'success',
        message: 'A user has been updated.',
      })
      dispatch('fetchAll')
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
  async updateUser({ state, commit, dispatch }, payload) {
    try {
      const user = createUser(payload.data)
      const data = await this.$axios.$put(`/api/users/${payload.id}`, user)
      
      await this.$helpers.notify({
        type: 'success',
        message: 'A user has been updated.',
      })
      dispatch('fetchAll')
    } catch (error) {
      console.log(error)
      await this.$helpers.notify({
        type: 'error',
        message: 'A user was not updated.',
      })
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
      const deleted = await this.$axios.$delete(`/api/users/${payload}`)
      
      if (deleted) {
        commit('REMOVE_USER', payload)
        await this.$helpers.notify({
          type: 'success',
          message: 'A user has been removed.',
        })
      }
    } catch (error) {
      console.log(error.response)
      const statusCode = error.response.status
      if (statusCode == 422) {
        const errorMsg = error.response.data.message
        await this.$helpers.notify({
          type: 'error',
          message: errorMsg,
        })
      }
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

  /**
   * Upload user avatar.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async uploadAvatar({ commit, dispatch }, payload) {
    console.log(payload)
    if (!payload.id && !payload.img) {
      return await this.$helpers.notify({
        type: 'error',
        message: 'Must contain an image.',
      })
    }
    
    try {
      let form = new FormData()
      form.append('img', payload.img)
      await this.$axios.$post(`/api/users/upload-avatar/${payload.id}`, form)
      await dispatch('fetch', payload.id)
      await this.$helpers.notify({
        type: 'info',
        message: 'Image uploaded successfully.',
      })
    } catch (error) {
      console.log(error)
      const statusCode = error.response.status
      if (statusCode === 422) {
        const errors = error.response.data.errors
        commit("SET_ERRORS", errors)
      }

      await this.$helpers.notify({
        type: 'error',
        message: 'Image was not uploaded.',
      })
    }
  },

  /**
   * Remove user avatar.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async removeAvatar({ commit, dispatch }, payload) {
    if (!payload.id) {
      return await this.$helpers.notify({
        type: 'error',
        message: 'Must contain an ID.',
      })
    }
    
    try {
      await this.$axios.$get(`/api/users/remove-avatar/${payload.id}`)
      await dispatch('fetch', payload.id)
      await this.$helpers.notify({
        type: 'info',
        message: 'Image removed.',
      })
    } catch (error) {
      await this.$helpers.notify({
        type: 'error',
        message: 'Image was not removed.',
      })
    }
  },
}