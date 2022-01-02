<template>
  <div>
    <v-text-field
      v-model="first_name"
      label="First Name"
      hint="Required"
      persistent-hint
      filled
    ></v-text-field>
    <v-text-field
      v-model="middle_name"
      label="Middle Name"
      hint="Required"
      persistent-hint
      filled
    ></v-text-field>
    <v-text-field
      v-model="last_name"
      label="Last Name"
      hint="Required"
      persistent-hint
      filled
    ></v-text-field>
    <v-text-field
      v-model="email"
      label="Email"
      append-icon="mdi-email-outline"
      hint="Required"
      persistent-hint
      filled
    ></v-text-field>
    <v-text-field
      v-model="phone_number"
      label="Contact Number"
      append-icon="mdi-phone"
      filled
    ></v-text-field>
    <v-text-field
      v-model="date_started"
      append-icon="mdi-calendar"
      type="date"
      label="Start Date"
      filled
    ></v-text-field>
    <v-text-field
      v-model="date_ended"
      append-icon="mdi-calendar"
      type="date"
      label="End Date"
      filled
    ></v-text-field>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'

export default {
  computed: {
    ...mapFields('users', [
      'user.first_name',
      'user.middle_name',
      'user.last_name',
      'user.email',
      'user.phone_number',
      'user.date_started',
      'user.date_ended',
    ])
  }
}
</script>