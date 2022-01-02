export default function ({ store, redirect }) {
  if (!store.getters['isAdmin']) {
    $nuxt.$helpers.notify({
      type: "info",
      message: "Not authorized."
    })
    
    return redirect({ name: 'dashboard' })
  }
}