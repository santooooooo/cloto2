<template>

  <div class="card">
<!-- 編集ダイアログ -->
     <ProfileEditDialog
      @close ="profileEditDialog = $event"
     v-if="profileEditDialog">
     </ProfileEditDialog>
    <!-- アイコン表示 -->
    <v-card  class="text-center" flat>
              <v-avatar
            class="profile"
            color="grey"
            size="150"
          >
           <img
            :src="$storage('icon') + authUser.icon"
            class="rounded-circle"
          />
          </v-avatar>

    <!-- アイコン編集 -->
    <!-- <div class="form-group">
      <image-drop-upload
        :no-change-crop-ratio="true"
        ratio-x="1"
        ratio-y="1"
        @input="authUser.icon = $event"
      ></image-drop-upload>
    </div> -->

<!-- ハンドルネームとユーザーネーム表示 -->
  <v-card height="475" flat color="blue-grey lighten-5">
        <v-col class="pa-0">　
          <v-list-item
            color="rgba(0, 0, 0, .4)"
            dark
          >
            <v-list-item-content >
              <v-list-item-title class=" black--text">
                 {{ authUser.handlename }}
              </v-list-item-title>
              <v-list-item-subtitle class="black--text">
                 {{ '@' + authUser.username }} 
                </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-col>
 
          <v-row justify="center">   
            <v-card light flat class="mt-2 pa-2 text-center" width="400">
              {{ authUser.introduction ? authUser.introduction : '自己紹介が未記入です' }}
            </v-card>
          </v-row>

            <v-btn class="ma-4" @click="profileEditDialog = true">編集する</v-btn>
      <!-- 編集ダイアログ -->

   </v-card>

 </v-card>

  </div>
</template>

<script>
import { OK } from '@/consts/status';
import ProfileEditDialog from '@/components/mypage/ProfileEditDialog';
export default {

components:{
 ProfileEditDialog,
},


  head: {
    title() {
      return {
        inner: this.$route.params.username + ' - ' + '編集',
      };
    },
  },
  data() {
    return {
        profileEditDialog: false
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>
