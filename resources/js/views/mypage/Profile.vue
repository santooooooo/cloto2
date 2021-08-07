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

        <v-row class="mt-4" justify="center">
          <v-btn @click="profileEditDialog = true">編集する</v-btn>
        </v-row>

        <v-row class="mt-12" justify="center">
          <v-btn text color="primary" @click="deleteUserDialog = true">退会する</v-btn>
        </v-row>
      </v-card>
    </v-card>

    <!-- 編集ダイアログ -->
    <ProfileEditDialog @close="profileEditDialog = $event" v-if="profileEditDialog" />

    <!-- 退会確認ダイアログ -->
    <v-dialog v-model="deleteUserDialog" max-width="500px" persistent>
      <v-card class="headline grey darken-2 text-center pa-2">
        <p class="headline white--text text-center my-12">
          本当に退会しますか？<br />データの復旧はできません。
        </p>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" :loading="loading" @click="deleteUserDialog = false">
            キャンセル
          </v-btn>
          <v-btn color="success" :loading="loading" @click="deleteSubmit()">削除</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-card>
</template>

<script>
import ProfileEditDialog from '@/components/mypage/ProfileEditDialog';
import { OK } from '@/consts/status';

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
      loading: false, // ローディング制御
      profileEditDialog: false, // プロフィール編集ダイアログ制御
      deleteUserDialog: false, // 退会確認ダイアログ制御
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },

  methods: {
    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.loading = true;

      let response = await axios.delete('/api/user');

      if (response.status === OK) {
        this.$router.push({ name: 'index' });
      }

      this.loading = false;
    },
  },
};
</script>
