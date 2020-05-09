<template>
  <div>
    <div class="columns">
      <div class="column is-three-fifths is-offset-one-fifth">
        <h1 class="is-size-5">新しい組織を登録する</h1>
        <form @submit.prevent="register">
          <div class="field">
            <label class="label" for="organization_name">組織名</label>
            <div class="control">
              <input
                v-model="name"
                id="organization_name"
                class="input"
                type="text"
                placeholder="会社名、拠点名など"
                required
                :disabled="loading"
              />
            </div>
            <p class="help">
              倉庫ごとなど、在庫を管理している拠点単位での登録をおすすめします
            </p>
          </div>
          <div v-if="error" class="notification is-danger">
            {{ error }}
          </div>
          <div class="field is-horizontal">
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <button
                    type="submit"
                    class="button is-fullwidth is-primary"
                    :disabled="loading"
                  >
                    登録する
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      loading: false,
      error: null
    }
  },
  methods: {
    async register() {
      if (!this.name || this.loading) {
        return
      }
      this.loading = true
      this.error = null
      try {
        await this.$axios.post('/v1/organization/createNew', {
          name: this.name
        })
        await this.$store.dispatch('user/fetch')
        await this.$router.push('/')
      } catch (e) {
        console.error(e)
        this.error = e.meessage || '登録に失敗しました'
      } finally {
        this.loading = false
      }
    }
  }
}
</script>
