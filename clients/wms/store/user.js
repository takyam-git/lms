export const state = () => ({
  user: null,
  organization: null
})

export const getters = {
  user: (state) => state.user,
  organization: (state) => state.organization
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
    console.log(res)

    // commit('user', user)
  }
}
