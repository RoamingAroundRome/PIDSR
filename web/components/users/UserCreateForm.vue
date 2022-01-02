<template>
  <div>
    <v-row
      class="mx-10"
    >
      <v-col>
        <v-card>
          <v-card-text>
            <v-row justify="center">
              <v-col 
                lg="5" 
                md="6" 
                sm="12" 
                cols="12">
                <UserFields />
                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn 
                    width="150"
                    color="primary" 
                    depressed>
                    Submit
                  </v-btn>
                </v-card-actions>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import UserFields from '@/components/users/UserFields'

export default {
  components: {
    UserFields,
  }
}
</script>