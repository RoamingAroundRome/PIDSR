<template>
  <div>
    <v-btn 
      @click="edit = !edit" 
      large
      depressed>
      Change password
    </v-btn>
    <v-dialog 
      v-model="edit" 
      max-width="400" 
      scrollable>
      <v-card>
        <v-toolbar color="transparent" flat>
          <v-toolbar-title>
            Change Password
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn 
            @click="edit = !edit"
            icon>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <div class="mb-5"></div>
          <v-text-field
            label="New Password"
            v-model="user.password"
            :error="!!errors['password']"
            :error-messages="errors['password']"
            :type="showPassword ? 'text' : 'password'"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="showPassword = !showPassword"
            outlined
          ></v-text-field>
          <v-text-field
            label="Confirm New Password"
            v-model="user.password_confirmation"
            :error="!!errors['password_confirmation']"
            :error-messages="errors['password_confirmation']"
            :type="showPassword ? 'text' : 'password'"
            :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="showPassword = !showPassword"
            outlined
          ></v-text-field>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="edit = !edit" color="primary" text>CANCEL</v-btn>
          <v-btn @click="save()" color="primary" text>SAVE</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  data: () => ({
    edit: false,
    showPassword: false,
    user: {
      password: '',
      password_confirmation: ''
    },
  }),

  computed: {
    ...mapState({
      errors: state => state.errors
    })
  },

  methods: {
    reset() {
      this.showPassword = false
      this.user = {
        password: '',
        password_confirmation: ''
      }
    },
    
    async save() {
      try {
        await this.$store.dispatch('changePassword', this.user)

        // this.reset()
      } catch (error) {
        console.log(error)
      }
    }
  }
}
</script>