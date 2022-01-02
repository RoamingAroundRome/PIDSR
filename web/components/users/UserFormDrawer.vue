<template>
  <div>
    <v-navigation-drawer
      :width="
        $vuetify.breakpoint.xl
        ? '700' 
        : $vuetify.breakpoint.lg || $vuetify.breakpoint.md 
        ? '450' 
        : '100%'"
      :right="true"
      :value="value"
      :temporary="true"
      :touchless="true"
      @input="toggle($event)"
      app>  
        <v-card flat>
          <v-toolbar flat>
            <v-toolbar-title
              v-text="title"
            ></v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn @click="toggle(!value)" icon>
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-toolbar>
          <v-card-text>
            <UserFields />
            <v-btn 
              @click="toggle(!value)"
              color="primary"
              block
              large
              text>
              CANCEL
            </v-btn>
            <v-btn 
              @click="$store.dispatch(action, id)
                .then(() => toggle(!value))"
              color="primary"
              block
              large
              depressed>
              SAVE
            </v-btn>
          </v-card-text>
          <v-card-text>
          </v-card-text>
        </v-card>
    </v-navigation-drawer>
  </div>
</template>

<script>
import UserFields from '@/components/users/UserFields'

export default {
  components: {
    UserFields
  },
  
  props: {
    // Title of drawer
    title: {
      type: String,
      default: () => 'Form Title',
    },
    
    // v-model toggle
    value: {
      type: Boolean,
      default: () => false,
    },

    id: {
      type: Number,
      default: () => null
    },

    // Store action
    action: {
      type: String,
      required: true,
    }
  },

  methods: {
    toggle(value) {
      this.$emit('toggle', value)
    }
  }
}
</script>