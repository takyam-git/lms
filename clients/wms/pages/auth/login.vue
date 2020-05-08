<template>
  <div class="container"></div>
</template>

<script>
export default {
  auth: false,
  layout: 'guest',
  created() {
    this.$auth.loginWith('auth0')
  }
}
</script>

<style lang="scss" scoped></style>
