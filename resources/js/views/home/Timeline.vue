<template>
  <v-layout class="overflow-y-auto" id="information">
    <v-container fluid>
      <!-- ローディング -->
      <v-progress-linear indeterminate absolute height="10" v-if="loading"></v-progress-linear>

      <!-- イベント案内 -->
      <v-card color="white" width="100%" max-height="40%">
        <img
          :src="$storage('system') + 'event.png?' + Math.random().toString(32).substring(2)"
          id="event"
        />
        <p class="text-h5 ma-2">
          今月のイベント一覧は<a
            href="https://freecalend.com/open/mem136363_nopopon"
            target="_blank"
            rel="noopener noreferrer"
            >こちら</a
          >
        </p>
      </v-card>

      <!-- タイムライン -->
      <v-container fluid>
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

        <vue-masonry-wall :items="items" :options="{ width: width, padding: 8 }" @append="getData">
          <template v-slot:default="{ item }">
            <v-card :width="width - 50" class="mx-auto pa-3">
              <!-- カルテ -->
              <v-card-actions class="d-block" v-if="item.activity_time">
                <div class="pointer" @click="showKarte(item.id)">
                  <v-img
                    max-height="300"
                    class="mx-auto my-2 rounded-xl"
                    contain
                    eager
                    :src="item.path + item.image"
                    v-if="item.image"
                  ></v-img>

                  <!-- タグ -->
                  <v-chip class="ma-1" v-for="tag in item.tags" :key="tag.id" :value="tag.id">
                    {{ tag.name }}
                  </v-chip>

                  <!-- 活動時間 -->
                  <p
                    :class="[
                      'text-body-2',
                      'font-weight-bold',
                      item.image || item.tags.length ? 'mt-6' : '',
                    ]"
                  >
                    活動時間：{{ item.activity_time.slice(0, 5) }}
                  </p>

                  <!-- 活動内容 -->
                  <pre class="text-body-2" v-html="$formatStr(item.body)"></pre>

                  <!-- 投稿日時 -->
                  <p class="mt-6 mb-0 text-right small">
                    {{ $moment(item.created_at).format('MM/DD HH:mm') }}
                  </p>
                </div>
              </v-card-actions>

              <!-- 投稿 -->
              <v-card-actions class="d-block" v-else>
                <v-row no-gutters justify="end" v-if="item.user.id === authUser.id">
                  <v-btn icon x-small @click="deletePost(item)">
                    <v-icon>mdi-close</v-icon>
                  </v-btn>
                </v-row>

                <div class="pointer" @click="showPost(item.id)">
                  <!-- 内容 -->
                  <pre class="text-body-2" v-html="$formatStr(item.body)"></pre>

                  <!-- 投稿日時 -->
                  <p class="mt-6 mb-0 text-right small">
                    {{ $moment(item.created_at).format('MM/DD HH:mm') }}
                  </p>
                </div>
              </v-card-actions>

              <v-divider></v-divider>

              <v-row no-gutters class="mt-3 pointer">
                <!-- ユーザーアイコン -->
                <v-col
                  cols="3"
                  class="my-auto text-center"
                  @click="showProfile(item.user.username)"
                >
                  <v-avatar
                    size="50"
                    :style="{ 'box-shadow': '0 0 0 5px ' + $statusColor(item.user.status) }"
                  >
                    <img :src="$storage('icon') + item.user.icon" />
                  </v-avatar>
                </v-col>

                <v-col cols="5" class="my-auto text-start" @click="showProfile(item.user.username)">
                  <!-- ユーザー名 -->
                  <p class="mb-0 text-body-1 text-truncate">{{ item.user.handlename }}</p>
                  <p class="mb-0 text-body-2 text-truncate">@{{ item.user.username }}</p>
                </v-col>

                <v-spacer></v-spacer>

                <v-col cols="3" class="my-auto text-center">
                  <!-- コメントボタン -->
                  <v-btn
                    icon
                    class="mx-1"
                    @click="'activity_time' in item ? showKarte(item.id) : showPost(item.id)"
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

        <!-- 投稿削除確認ダイアログ -->
        <v-dialog v-model="deletePostForm.dialog" max-width="500px" persistent>
          <v-card class="headline grey darken-2 text-center pa-2">
            <v-card-title>
              <span class="headline white--text">削除しますか？</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-card-text class="pa-1 white--text">
                  {{ deletePostForm.data.body }}
                </v-card-text>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn
                color="grey"
                class="white--text"
                :loading="deletePostForm.loading"
                @click="deleteSubmit()"
              >
                削除
              </v-btn>
              <v-btn
                color="error"
                :loading="deletePostForm.loading"
                @click="deletePostForm.dialog = false"
              >
                キャンセル
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <KarteDialog :karteId="showKarteId" @close="showKarteId = $event" />
        <PostDialog :postId="showPostId" @close="showPostId = $event" />
        <ProfileDialog
          :username="profile.username"
          @close="profile.dialog = $event"
          v-if="profile.dialog"
        />
      </v-container>
    </v-container>
  </v-layout>
</template>

<script>
import KarteDialog from '@/components/commons/KarteDialog';
import PostDialog from '@/components/commons/PostDialog';
import ProfileDialog from '@/components/commons/ProfileDialog';
import { OK, NOT_FOUND } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: 'タイムライン',
      };
    },
  },

  data() {
    return {
      loading: true, // ローディング制御
      page: 1, // ページング制御
      stopGetting: false, // データ取得の終了制御
      items: [], // 表示データ
      kartes: [], // カルテ一覧
      posts: [], // 投稿一覧
      showKarteId: null, // 詳細を表示するカルテID
      showPostId: null, // 詳細を表示する投稿ID
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
      postForm: {
        body: '', // 内容
        max: 1000, // 最大長
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '内容が無いようです。'],
        },
      },
      deletePostForm: {
        dialog: false,
        loading: false,
        data: {},
      },
    };
  },

  components: {
    KarteDialog,
    PostDialog,
    ProfileDialog,
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
     * カルテの詳細表示
     *
     * @param {Number} karteId - 詳細を表示するカルテID
     */
    showKarte: function (karteId) {
      this.showKarteId = karteId;
    },

    /**
     * 投稿の詳細表示
     *
     * @param {Number} postId - 詳細を表示する投稿ID
     */
    showPost: function (postId) {
      this.showPostId = postId;
    },

    /**
     * プロフィールの表示
     *
     * @param {String} username - プロフィールを表示するユーザー名
     */
    showProfile: function (username) {
      this.profile.username = username;
      this.profile.dialog = true;
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
      this.deletePostForm.data = post;
      this.deletePostForm.dialog = true;
    },

    /**
     * 削除データの送信
     */
    deleteSubmit: async function () {
      this.deletePostForm.loading = true;

      // 投稿削除処理
      let response = await axios.delete('/api/posts/' + this.deletePostForm.data.id);

      if (response.status === OK) {
        // 表示データから削除
        this.items = this.items.filter((item) => {
          return item.id !== this.deletePostForm.data.id;
        });
        this.deletePostForm.dialog = false;
      }

      this.deletePostForm.loading = false;
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
#information {
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

  .v-card {
    .pointer {
      cursor: pointer;
    }

    pre {
      white-space: pre-wrap;
    }
  }
}
</style>
