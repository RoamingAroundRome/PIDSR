<template>
  <div>
    <v-form @submit.prevent="login()">
      <v-card flat>
        <v-card-title></v-card-title>
        <v-row justify="center">
          <div class="display-1">
            {{ projectTitle }}
          </div>
        </v-row>
        <v-card-text>
          <v-row>
            <v-col>
              <v-form @submit.prevent="login">
                <v-text-field
                  v-model="credentials.email"
                  label="Email"
                  :error="!!errors['email']"
                  :error-messages="errors['email']"
                  prepend-inner-icon="mdi-email-outline"
                  background-color="grey lighten-4"
                  type="text"
                  :disabled="loggingIn"
                  flat
                  solo
                ></v-text-field>

                <v-text-field
                  v-model="credentials.password"
                  label="Password"
                  :error="!!errors['password']"
                  :error-messages="errors['password']"
                  prepend-inner-icon="mdi-lock-outline"
                  background-color="grey lighten-4"
                  type="password"
                  :disabled="loggingIn"
                  flat
                  solo
                ></v-text-field>
                <v-btn
                  type="submit"
                  :loading="loggingIn"
                  color="primary"
                  depressed
                  block
                  large
                  dark>
                  SIGN IN
                </v-btn>
              </v-form>
            </v-col>
          </v-row>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-form>
  </div>
</template>

<script>
import Logo from "~/components/Logo.vue";
import { mapActions } from "vuex";

export default {
  data: () => ({
    projectTitle: process.env.title,
    errors: {},
    loggingIn: false,
    credentials: {
      email: "",
      password: ""
    },
  }),

  layout: "none",

  components: {
    Logo
  },

  methods: {
    async login() {
      this.loggingIn = true
      try {
        await this.$auth.loginWith('local', {
          data: this.credentials
        })

        this.$helpers.notify({
          type: 'success',
          message: 'You have logged in.',
        })
        
        this.loggingIn = false
        
        await this.$router.push({ name: 'dashboard' })
      } catch (error) {
        this.loggingIn = false
        const statusCode = error.response.status || 404
        if (statusCode === 422) {
          this.errors = error.response.data.errors
          return
        }
        
        return await this.$helpers.notify({
          type: 'error',
          message: 'Your email or password is incorrect. Please try again.'
        })
      }
    },
  }
};
</script>
