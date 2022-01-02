<template>
  <div>
    <v-autocomplete
      label="Role"
      v-model="role"
      :items="roles"
      :error="!!errors['role']"
      :error-messages="errors['role']"
      filled>
      <!-- <template v-slot:label>
        <span>Role <b class="red--text">*</b></span>
      </template> -->
    </v-autocomplete>
    <v-text-field
      label="First Name"
      v-model="first_name"
      :error="!!errors['first_name']"
      :error-messages="errors['first_name']"
      filled>
      <!-- <template v-slot:label>
        <span>First Name <b class="red--text">*</b></span>
      </template> -->
    </v-text-field>
    <v-text-field
      label="Last Name"
      v-model="last_name"
      :error="!!errors['last_name']"
      :error-messages="errors['last_name']"
      filled>
      <!-- <template v-slot:label>
        <span>Last Name <b class="red--text">*</b></span>
      </template> -->
    </v-text-field>
    <v-text-field
      label="Email"
      v-model="email"
      :error="!!errors['email']"
      :error-messages="errors['email']"
      append-icon="mdi-email-outline"
      filled>
      <!-- <template v-slot:label>
        <span>Email <b class="red--text">*</b></span>
      </template> -->
    </v-text-field>
    <v-text-field
      label="Phone Number"
      v-model="phone_number"
      :error="!!errors['phone_number']"
      :error-messages="errors['phone_number']"
      append-icon="mdi-phone"
      hint="Optional"
      persistent-hint
      filled
    ></v-text-field>
    <v-text-field
      label="Password"
      v-model="password"
      :error="!!errors['password']"
      :error-messages="errors['password']"
      :type="showPassword ? 'text' : 'password'"
      :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
      @click:append="showPassword = !showPassword"
      filled>
      <!-- <template v-slot:label>
        <span>Password <b class="red--text">*</b></span>
      </template> -->
    </v-text-field>
    <v-text-field
      label="Confirm Password"
      v-model="password_confirmation"
      :error="!!errors['password_confirmation']"
      :error-messages="errors['password_confirmation']"
      :type="showPasswordConfirmation ? 'text' : 'password'"
      :append-icon="showPasswordConfirmation ? 'mdi-eye' : 'mdi-eye-off'"
      @click:append="showPasswordConfirmation = !showPasswordConfirmation"
      filled>
      <!-- <template v-slot:label>
        <span>Confirm Password <b class="red--text">*</b></span>
      </template> -->
    </v-text-field>
  </div>
</template>

<script>
import { mapFields } from 'vuex-map-fields'
import { roles } from '../../models/User'

export default {
  computed: mapFields('users', [
    'form.role',
    'form.first_name',
    'form.last_name',
    'form.email',
    'form.phone_number',
    'form.password',
    'form.password_confirmation',
    'errors',
  ]),

  data: () => ({
    showPassword: false,
    showPasswordConfirmation: false,
    roles: roles,
  })
}
</script>