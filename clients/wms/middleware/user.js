export default async ({ $auth, store, redirect, route }) => {
  if ($auth.loggedIn && !store.getters['user/user']) {
    await store.dispatch('user/fetch')
  }
  if (
    $auth.loggedIn &&
    store.getters['user/user'] &&
    !store.getters['user/organization'] &&
    route.name !== 'organizations'
  ) {
    return redirect('/organizations')
  }
}
