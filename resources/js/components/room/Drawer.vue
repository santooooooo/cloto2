<template>
  <v-card class="mx-auto" width="250" flat tile>
    <v-navigation-drawer permanent>
      <v-list>
        <v-row no-gutters justify="end">
          <v-btn
            small
            depressed
            color="primary"
            class="mr-2"
            @click="$emit('toggle-chat', !chatIsShow)"
          >
            <v-icon>mdi-message-text-outline</v-icon>
            <v-icon>{{ chatIsShow ? 'mdi-arrow-left' : 'mdi-arrow-right' }}</v-icon>
          </v-btn>
        </v-row>

        <v-tooltip bottom>
          <template v-slot:activator="{ on, attrs }">
            <v-list-item v-bind="attrs" v-on="on">
              <v-list-item-content>
                <v-list-item-title class="text-center text-h5 font-weight-bold">
                  {{ roomName }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </template>

          <span>{{ roomName }}</span>
        </v-tooltip>

        <!-- <v-list-item>
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
        </v-list-item> -->
      </v-list>

      <!-- 着席前 -->
      <div class="pa-2" v-if="!authUser.seat">
        <v-btn block depressed color="success" @click="$router.push({ name: 'home' })">
          退室
        </v-btn>

        <p class="text-center text-body-1 font-weight-bold mt-12">自習室にご着席ください</p>
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
              v-model="inProgress.body"
              :placeholder="authUser.in_progress"
              :disabled="inProgress.loading"
              :maxlength="inProgress.max"
              rows="2"
              solo
              hide-details
              class="pt-2 pb-4 px-2"
            ></v-textarea>

            <v-btn
              small
              color="error"
              class="mx-1"
              :loading="inProgress.loading"
              @click="submit(true)"
            >
              削除
            </v-btn>
            <v-btn
              small
              color="primary"
              class="mx-1"
              :loading="inProgress.loading"
              :disabled="inProgress.body === ''"
              @click="submit(false)"
            >
              公開
            </v-btn>
          </v-container>
        </v-card>

        <v-card class="mt-5 pa-1 grey darken-1 text-center" v-if="authUser.seat.role === 'staff'">
          <v-container>
            <v-card-text class="pa-1 white--text font-weight-bold">全体アナウンス</v-card-text>
            <v-textarea
              v-model="announcement.message"
              :disabled="announcement.loading"
              rows="2"
              solo
              hide-details
              class="pt-2 pb-4 px-2"
            ></v-textarea>

            <v-btn
              small
              color="primary"
              :loading="announcement.loading"
              :disabled="announcement.message === ''"
              @click="announce()"
            >
              送信
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
    chatIsShow: Boolean,
  },
  data() {
    return {
      inProgress: {
        max: 200, // 入力最大長
        loading: false, // ローディング制御
        body: '', // 取り組み中のタスク
      },
      announcement: {
        loading: false, // ローディング制御
        message: '', // アナウンス内容
      },
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
     * @param {Boolean} remove - 削除フラグ
     */
    submit: async function (remove) {
      if (remove) {
        this.inProgress.body = '';
      }

      // 変化があった場合のみ更新
      if (this.inProgress.body !== (this.authUser.in_progress || '')) {
        this.inProgress.loading = true;

        let response = await axios.post('/api/user', {
          _method: 'patch',
          in_progress: this.inProgress.body,
        });

        if (response.status === OK) {
          // 表示の更新
          await this.$store.dispatch('auth/syncAuthUser');

          if (remove) {
            this.$store.dispatch('alert/success', '取り組み中のタスクが削除されました！');
          } else {
            // チャットの送信
            axios.post('/api/chats', {
              body: '「' + this.inProgress.body + '」なう！',
            });

            this.$store.dispatch('alert/success', '取り組み中のタスクが公開されました！');
            this.inProgress.body = '';
          }
        } else {
          this.$store.dispatch('alert/error', '取り組み中のタスクの公開に失敗しました．．．');
        }

        this.inProgress.loading = false;
      }
    },

    /**
     * アナウンス
     */
    announce: async function () {
      this.announcement.loading = true;

      let response = await axios.post('/api/rooms/announce', {
        message: this.announcement.message,
      });

      if (response.status === OK) {
        this.announcement.message = '';
      }

      this.announcement.loading = false;
    },
  },
};
</script>

<style lang="scss" scoped>
a:hover {
  text-decoration: none;
}
</style>
