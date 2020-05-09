export const state = () => ({
  user: null,
  organization: null
})

export const getters = {
  user: (state) => state.user,
  organization: (state) => (state.user && state.user.organization) || null
}

export const mutations = {
  user(state, user) {
    state.user = user
  },
  organization(state, organization) {
    state.organization = organization
  }
}

export const actions = {
  async fetch({ commit }) {
    const res = await this.$axios.get('/v1/user/getMe')
    commit('user', res.data.data)
  }
}
