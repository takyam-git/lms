<template>
  <div>
    <nav
      v-click-outside="hide"
      class="navbar"
      role="navigation"
      aria-label="main navigation"
    >
      <div class="navbar-brand">
        <nuxt-link class="navbar-item" to="/">
          <img src="/logo.png" height="28" />
        </nuxt-link>

        <a
          role="button"
          class="navbar-burger burger"
          aria-label="menu"
          aria-expanded="false"
          data-target="navbarBasicExample"
          @click.prevent="toggle"
        >
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
          <span aria-hidden="true"></span>
        </a>
      </div>

      <div
        id="navbarBasicExample"
        class="navbar-menu"
        :class="{ 'is-active': isMenuOpened }"
      >
        <div class="navbar-start">
          <nuxt-link
            v-for="(link, linkIndex) in links"
            :key="linkIndex"
            :to="link.to"
            class="navbar-item"
          >
            {{ link.label }}
          </nuxt-link>
        </div>

        <div class="navbar-end">
          <div class="navbar-item">
            <div class="buttons">
              <nuxt-link
                v-if="!$auth.loggedIn"
                to="/login"
                class="button is-primary"
              >
                <strong>会員登録/ログイン</strong>
              </nuxt-link>
              <nuxt-link
                v-if="$auth.loggedIn"
                to="/logout"
                class="button is-light"
              >
                ログアウト
              </nuxt-link>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <section class="section">
      <div class="container is-widescreen">
        <nuxt />
      </div>
    </section>
  </div>
</template>

<script>
import ClickOutside from 'vue-click-outside'
export default {
  directives: {
    ClickOutside
  },
  data() {
    return {
      isMenuOpened: false
    }
  },
  computed: {
    links() {
      return [
        { to: '/', label: 'トップ' },
        { to: '/inbound', label: '入荷/入庫' },
        { to: '/outbound', label: '出庫' }
      ]
    }
  },
  methods: {
    toggle() {
      this.isMenuOpened = !this.isMenuOpened
    },
    hide() {
      this.isMenuOpened = false
    }
  }
}
</script>
