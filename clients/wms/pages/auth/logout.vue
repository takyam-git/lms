<template>
  <div class="container"></div>
</template>

<script>
export default {
  layout: 'guest',
  mounted() {
    this.$auth.logout()
  }
}
</script>

<style lang="scss" scoped></style>
