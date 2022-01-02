<template>
  <div>
    <v-dialog 
      :value="value"
      @input="toggle($event)"
      max-width="400"  
      scrollable>
      <v-card>
        <v-toolbar color="transparent" flat>
          <v-toolbar-title>
            Confirm Delete
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn @click="toggle(!value)" icon>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <div class="mb-5"></div>
          Are you sure you want to delete this user?
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn 
            @click="toggle(!value)"
            color="primary" 
            text>
            CANCEL
          </v-btn>
          <v-btn 
            @click="$store.dispatch('users/destroy', id)
              .then(() => toggle(!value))"
            color="primary" 
            text>
            CONFIRM
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      default: () => 0,
    },
    
    value: {
      type: Boolean,
      default: () => false,
    },
  },

  methods: {
    toggle(value) {
      this.$emit('toggle', value)
    }
  }
}
</script>