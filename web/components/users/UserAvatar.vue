<template>
  <div>
    <v-row
      justify="center"
      align="center">
      <v-col 
        class="mx-10"
        lg="5"
        md="6"
        sm="12"
        cols="12">
        <div class="text-center">
          <v-menu
            offset-y
            absolute>
            <template v-slot:activator="{ on }">
              <v-avatar 
                v-on="on"
                style="cursor: pointer"
                size="250">
                <v-img 
                  :src="user.avatar || avatar">
                </v-img>
              </v-avatar>
            </template>
            <v-list dense>
              <v-list-item @click="uploadDialog = !uploadDialog">
                <v-list-item-title>
                  Upload new photo
                </v-list-item-title>
              </v-list-item>
              <v-list-item @click="$store.dispatch('users/removeAvatar', {
                  id: $route.params.id
                })">
                <v-list-item-title>
                  Remove photo
                </v-list-item-title>
              </v-list-item>
            </v-list>
          </v-menu>
        </div>
      </v-col>
    </v-row>

    <v-dialog v-model="uploadDialog" 
      scrollable
      max-width="500">
      <v-card>
        <v-card-title>
          Upload Avatar
          <v-spacer></v-spacer>
          <v-btn 
            @click="uploadDialog = !uploadDialog" 
            icon>
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <div class="text-center">
            <v-avatar 
              @click="selectFile()"
              style="cursor: pointer"
              size="250">
              <v-img 
                :src="tempUrl 
                ? tempUrl 
                : (user.avatar || avatar)"
              ></v-img>
              <input type="file" @change="onFileUpload($event)" id="avatar" hidden />
            </v-avatar>
          </div>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn 
            @click="uploadDialog = !uploadDialog" 
            text>
            CANCEL
          </v-btn>
          <v-btn 
            @click="upload($route.params.id)"
            color="primary" 
            text>
            UPLOAD
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import { mapState } from 'vuex'

export default {
  data: () => ({
    uploadDialog: false,
    uploading: false,
    avatar: 'https://i.pravatar.cc/300',
    tempUrl: null,
    file: null,
  }),

  computed: {
    ...mapState('users', [
      'user'
    ])
  },

  methods: {
    selectFile() {
      return window.document.getElementById('avatar').click()
    },
    
    onFileUpload(event) {
      if (event != null) {
        const file = event.target.files[0]
        const url = window.URL.createObjectURL(file)
        this.file = file
        this.tempUrl = url
      }
    },

    async upload(id) {
      this.uploading = true
      await this.$store.dispatch('users/uploadAvatar', {
        id,
        img: this.file,
      })
      await this.$auth.fetchUser()
      this.uploading = false
    }
  },

}
</script>