<template>
  <v-layout class="overflow-y-auto" id="timeline">
    <v-container fluid>
      <!-- ローディング -->
      <v-progress-linear indeterminate absolute height="10" v-if="loading"></v-progress-linear>

      <!-- イベント案内 -->
      <v-card color="white" width="100%" max-height="40%">
        <img :src="eventSrc" id="event" />
        <p class="text-h5 ma-2">
          今月のイベント一覧は<a
            href="https://freecalend.com/open/mem136363_nopopon"
            target="_blank"
            rel="noopener noreferrer"
            >こちら</a
          >
        </p>
      </v-card>

      <v-layout>
        <!-- タイムライン -->
        <v-container>
          <v-form
            ref="postForm"
            v-model="postForm.validation.valid"
            lazy-validation
            id="post-form"
            class="mx-auto my-6"
          >
            <v-textarea
              v-model="postForm.body"
              :rules="postForm.validation.bodyRules"
              :maxlength="postForm.max"
              :disabled="postForm.loading"
              append-icon="mdi-send"
              placeholder="つぶやき"
              counter
              solo
              auto-grow
              rows="1"
              @click:append="submitPost()"
            ></v-textarea>
          </v-form>

          <vue-masonry-wall
            :items="items"
            :options="{ width: width, padding: 8 }"
            @append="getData"
          >
            <template v-slot:default="{ item }">
              <v-card :width="width - 50" class="mx-auto pa-3">
                <!-- カルテ -->
                <KarteContainer :karte="item" v-if="item.activity_time" />

                <!-- 投稿 -->
                <PostContainer :post="item" @delete="deletePost($event)" v-else />

                <v-divider></v-divider>

                <v-row no-gutters class="mt-3">
                  <v-col
                    cols="7"
                    class="ml-2 pointer"
                    @click="
                      $store.dispatch('dialog/open', {
                        type: 'user',
                        username: item.user.username,
                      })
                    "
                  >
                    <v-row>
                      <!-- ユーザーアイコン -->
                      <v-col cols="3" class="my-auto text-center">
                        <v-avatar
                          size="40"
                          :style="{ 'box-shadow': '0 0 0 3px ' + $statusColor(item.user.status) }"
                        >
                          <img :src="$storage('icon') + item.user.icon" />
                        </v-avatar>
                      </v-col>

                      <!-- ユーザー名 -->
                      <v-col cols="8" class="my-auto text-start">
                        <p class="mb-0 text-body-1 text-truncate">{{ item.user.handlename }}</p>
                        <p class="mb-0 text-body-2 text-truncate">@{{ item.user.username }}</p>
                      </v-col>
                    </v-row>
                  </v-col>

                  <v-spacer></v-spacer>

                  <v-col cols="4" class="my-auto text-center" v-if="item.id">
                    <!-- コメントボタン -->
                    <v-btn
                      icon
                      class="mx-1"
                      @click="
                        $store.dispatch('dialog/open', {
                          type: 'activity_time' in item ? 'karte' : 'post',
                          id: item.id,
                        })
                      "
                    >
                      <v-icon>mdi-message-text</v-icon>
                      <span>{{ item.comments_count }}</span>
                    </v-btn>

                    <!-- いいねボタン -->
                    <v-btn
                      icon
                      class="mx-1"
                      :color="item.favorite_id_by_auth_user ? 'red' : 'gray'"
                      @click="favorite(item)"
                    >
                      <v-icon>mdi-heart</v-icon>
                      <span>{{ item.favorites_count }}</span>
                    </v-btn>
                  </v-col>
                </v-row>
              </v-card>
            </template>
          </vue-masonry-wall>
          <v-row justify="center">
            <p class="text-h5 my-12" v-if="stopGetting">これ以上データはありません。</p>
          </v-row>
        </v-container>

        <!-- カルテ数のランキングの表示 -->
        <v-card width="30%" max-height="55rem" class="my-2">
          <Rank />
        </v-card>
      </v-layout>
    </v-container>
  </v-layout>
</template>

<script>
import { OK, NOT_FOUND } from '@/consts/status';
import Rank from '@/components/home/Rank';

export default {
  components: {
    Rank,
  },
  head: {
    title() {
      return {
        inner: 'タイムライン',
      };
    },
  },

  data() {
    return {
      eventSrc: this.$storage('system') + 'event.png?' + Math.random().toString(32).substring(2), // イベント画像のURL
      loading: true, // ローディング制御
      page: 1, // ページング制御
      stopGetting: false, // データ取得の終了制御
      items: [], // 表示データ
      kartes: [], // カルテ一覧
      posts: [], // 投稿一覧
      postForm: {
        body: '', // 内容
        max: 1000, // 最大長
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '内容が無いようです。'],
        },
      },
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },

    width() {
      return (this.$windowWidth - 250) / 3;
    },
  },

  methods: {
    /**
     * データの取得
     */
    getData: async function () {
      if (!this.loading && !this.stopGetting) {
        this.loading = true;

        let response = await axios.get('/api/timeline?page=' + this.page);

        if (response.status === OK) {
          // 現在配列に含まれていないデータのみを取り出す
          let data = response.data.filter((item) => {
            return !this.items.includes(item);
          });

          // データを追加
          this.items = this.items.concat(data);

          // ページの更新
          this.page += 1;
        } else if (response.status === NOT_FOUND) {
          // データ取得の終了
          this.stopGetting = true;
        }

        this.loading = false;
      }
    },

    /**
     * 投稿
     */
    submitPost: async function () {
      if (this.$refs.postForm.validate()) {
        this.postForm.loading = true;

        let response = await axios.post('/api/posts', { body: this.postForm.body });

        if (response.status === OK) {
          this.$refs.postForm.reset();
        }

        this.postForm.loading = false;
      }
    },

    /**
     * 投稿の削除
     *
     * @param {Object} post - 削除する投稿
     */
    deletePost: function (post) {
      // 表示データから削除
      this.items.forEach((item) => {
        if (item.id === post.id) {
          item.id = null;
          item.user.id = null;
          item.body = '削除済み';
        }
      });
    },

    /**
     * いいね処理
     *
     * @param {Object} item - いいねするアイテム
     */
    favorite: async function (item) {
      if (!item.favorite_id_by_auth_user) {
        // いいね処理
        let response;
        if ('activity_time' in item) {
          // カルテにいいねする
          response = await axios.post('/api/favorites', { karte_id: item.id });
        } else {
          // 投稿にいいねする
          response = await axios.post('/api/favorites', { post_id: item.id });
        }

        if (response.status === OK) {
          // IDの追加とカウントアップ
          item.favorite_id_by_auth_user = response.data;
          item.favorites_count += 1;
        }
      } else {
        // いいね解除処理
        let response = await axios.delete('/api/favorites/' + item.favorite_id_by_auth_user);

        if (response.status === OK) {
          // IDの削除とカウントダウン
          item.favorite_id_by_auth_user = null;
          item.favorites_count -= 1;
        }
      }
    },
  },

  async created() {
    await this.getData();

    /**
     * データの同期開始
     */
    Echo.channel('timeline').listen('TimelineUpdated', (event) => {
      this.items.unshift(event);
    });

    this.loading = false;
  },

  beforeDestroy() {
    /**
     * データの同期終了
     */
    Echo.leave('timeline');
  },
};
</script>

<style lang="scss" scoped>
#timeline {
  max-width: 100%;
  height: calc(100vh - 64px);

  .v-progress-linear {
    top: 0;
  }

  #event {
    max-width: 100%;
  }

  #post-form {
    width: 60%;
  }

  .pointer {
    cursor: pointer;
  }
}
</style>
