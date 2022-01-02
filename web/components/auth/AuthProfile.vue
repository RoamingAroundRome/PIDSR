<template>
  <div>
    <AuthAvatar />
    <AuthOfficerInfo />
    <AuthDRUInfo />
  </div>
</template>

<script>
import AuthAvatar from '@/components/auth/AuthAvatar'
import AuthOfficerInfo from '@/components/auth/AuthOfficerInfo'
import AuthDRUInfo from '@/components/auth/AuthDRUInfo'

export default {
  components: {
    AuthAvatar,
    AuthOfficerInfo,
    AuthDRUInfo,
  }
}
</script>