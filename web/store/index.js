export const state = () => ({
  errors: {}
})

export const getters = {
  isAdmin: state => state.auth.user.roleName === 'admin',
  isOfficer: state => state.auth.user.roleName === 'officer',
  allNotifications: state => state.auth.user.all_notifications,
  readNotifications: state => state.auth.user.read_notifications,
  unreadNotifications: state => state.auth.user.unread_notifications,
}

export const mutations = {
  SET_ERRORS: (state, errors) => state.errors = errors,
}

export const actions = {
  /**
   * Change the current authenticated user's password.
   * 
   * @param { Object } context 
   * @param { Object } payload 
   */
  async changePassword({ commit }, payload) {
    try {
      await this.$axios.$post('/api/auth/password/change', payload)
      
      return await this.$helpers.notify({
        type: "info",
        message: "Password changed."
      })
    } catch (error) {
      console.log(error)
      const statusCode = error.response.status || 404
      if (statusCode === 422) {
        commit('SET_ERRORS', error.response.data.errors)
      }

      return await this.$helpers.notify({
        type: "error",
        message: "Unable to change your password."
      })
    }
  }
}