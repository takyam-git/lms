export default async ({ $auth, store }) => {
  console.log($auth)
  if (
    $auth.loggedIn &&
    (!store.getters['user/organization'] || !store.getters['user/user'])
  ) {
    await store.dispatch('user/fetch')
  }
}
