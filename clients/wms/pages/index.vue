<template>
  <div class="container">
    <div v-if="!$auth.loggedIn">
      <nuxt-link to="/auth/login">ログイン</nuxt-link>
    </div>
    <div v-if="$auth.loggedIn">
      <div class="row">
        <div class="col col-sm-9">WMS</div>
        <nuxt-link to="/auth/logout">ログアウト</nuxt-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  auth: false
}
</script>

<style lang="scss" scoped></style>
