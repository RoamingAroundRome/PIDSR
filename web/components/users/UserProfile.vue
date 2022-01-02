<template>
  <div>
    <UserAvatar />
    <OfficerInfo />
    <DRUInfo v-if="role !== 'admin'" />
  </div>
</template>

<script>
import UserAvatar from '@/components/users/UserAvatar'
import OfficerInfo from '@/components/users/OfficerInfo'
import DRUInfo from '@/components/users/DRUInfo'
import { mapFields } from 'vuex-map-fields'

export default {
  components: {
    UserAvatar,
    OfficerInfo,
    DRUInfo,
  },

  computed: {
    ...mapFields('users', [
      'user.role'
    ])
  }
}
</script>