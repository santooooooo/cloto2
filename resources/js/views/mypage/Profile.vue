<template>
  <v-card flat>
    <!-- アイコン表示 -->
    <v-card class="text-center" flat>
      <v-row justify="center">
        <v-avatar class="my-10" size="150">
          <img :src="$storage('icon') + authUser.icon" />
        </v-avatar>
      </v-row>

      <!-- ハンドルネームとユーザーネーム表示 -->
      <v-card height="475" flat tile color="blue-grey lighten-5">
        <p class="text-h5 mb-2 pt-3">{{ authUser.handlename }}</p>
        <p>{{ '@' + authUser.username }}</p>

        <v-row justify="center">
          <v-card light flat class="mt-2 pa-2 text-center" width="400">
            {{ authUser.introduction ? authUser.introduction : '自己紹介が未記入です' }}
          </v-card>
        </v-row>

        <v-btn class="ma-4" @click="profileEditDialog = true">編集する</v-btn>
      </v-card>
    </v-card>

    <!-- 編集ダイアログ -->
    <ProfileEditDialog @close="profileEditDialog = $event" v-if="profileEditDialog" />
  </v-card>
</template>

<script>
import ProfileEditDialog from '@/components/mypage/ProfileEditDialog';

export default {
  head: {
    title() {
      return {
        inner: 'プロフィール',
      };
    },
  },

  components: {
    ProfileEditDialog,
  },

  data() {
    return {
      profileEditDialog: false,
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
};
</script>
