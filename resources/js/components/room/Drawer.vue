<template>
  <v-card class="mx-auto" width="250" min-height="100vh" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title class="text-center text-h5">{{ roomName }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item>
          <v-list-item-content>
            <v-list-item-title
              class="text-center text-h6 font-weight-bold"
              v-if="roomStatus === 'study'"
            >
              自習時間
            </v-list-item-title>

            <v-list-item-title
              class="text-center text-h6 font-weight-bold"
              v-if="roomStatus === 'break'"
            >
              休憩時間
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <!-- <v-card v-if="authUser.tasks.length" class="ma-2 pa-3 grey darken-1 text-center">
        <v-container>
          <v-card-text class="pa-1 white--text font-weight-bold">プロジェクト</v-card-text>

          <v-card class="pa-1">{{ authUser.tasks[0].project.name }}</v-card>

          <v-card-text class="pa-1 white--text font-weight-bold">タスク</v-card-text>

          <v-card class="pa-1">{{ authUser.tasks[0].body }}</v-card>

          <v-btn depressed color="mt-5 yellow darken-1" @click="$emit('input-karte')">
            <span class="white--text">カルテ記入</span>
          </v-btn>
        </v-container>
      </v-card> -->

      <!-- 着席前 -->
      <div class="pa-2" v-if="!authUser.seat">
        <v-btn block depressed color="success" @click="$router.push({ name: 'entrance' })">
          退室
        </v-btn>
      </div>

      <!-- 着席後 -->
      <div class="pa-2" v-else>
        <v-btn block depressed color="error" @click="$emit('leave-room')">退席</v-btn>

        <v-btn block depressed color="#f6bf00" dark @click="$emit('input-karte')" class="mt-3">
          カルテ記入
        </v-btn>

        <v-card class="mt-5 pa-1 grey darken-1 text-center">
          <v-container>
            <v-card-text class="pa-1 white--text font-weight-bold">いまやっていること</v-card-text>
            <v-textarea
              v-model="inProgress"
              :placeholder="authUser.in_progress"
              :disabled="loading"
              rows="2"
              solo
              class="pt-2 px-2"
            ></v-textarea>

            <v-btn small color="error" class="mx-1" :loading="loading" @click="submit(true)">
              削除
            </v-btn>
            <v-btn
              small
              color="primary"
              class="mx-1"
              :loading="loading"
              :disabled="inProgress === ''"
              @click="submit(false)"
            >
              公開
            </v-btn>
          </v-container>
        </v-card>
      </div>
    </v-navigation-drawer>
  </v-card>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  props: {
    roomName: String,
    roomStatus: String,
  },
  data() {
    return {
      loading: false, // ローディング制御
      inProgress: '', // 取り組み中のタスク
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 取り組み中のタスクの公開
     *
     * @param remove  削除するか
     */
    submit: async function (remove) {
      if (remove) {
        this.inProgress = '';
      }

      // 変化があった場合のみ更新
      if (this.inProgress !== (this.authUser.in_progress || '')) {
        this.loading = true;

        var response = await axios.post('/api/users', {
          _method: 'patch',
          in_progress: this.inProgress,
        });

        if (response.status === OK) {
          // 表示の更新
          await this.$store.dispatch('auth/syncAuthUser');

          if (remove) {
            this.$store.dispatch('alert/success', '取り組み中のタスクが削除されました！');
          } else {
            this.$store.dispatch('alert/success', '取り組み中のタスクが公開されました！');
            this.inProgress = '';
          }
        } else {
          this.$store.dispatch('alert/error', '公開に失敗しました．．．');
        }

        this.loading = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
