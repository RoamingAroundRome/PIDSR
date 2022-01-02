export default function ({ store }) {
    if (!store.getters['auth/IS_AUTHENTICATED']) {
        return $nuxt.$router.push({ name: 'sign-in' })
    }
}