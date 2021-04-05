<template>
  <v-container>
    <v-form ref="postForm" v-model="postForm.validation.valid" lazy-validation class="mt-6 mb-9">
      <v-textarea
        v-model="postForm.body"
        :rules="postForm.validation.bodyRules"
        :maxlength="postForm.max"
        :disabled="postForm.loading"
        placeholder="つぶやき"
        counter
        solo
        auto-grow
        rows="1"
      ></v-textarea>
      <v-btn color="primary" :loading="postForm.loading" @click="submitPost()">投稿する</v-btn>
    </v-form>

    <v-row v-masonry="'timeline'" item-selector=".item">
      <v-col
        v-masonry-tile
        class="item"
        v-for="(item, index) in data"
        :key="index"
        xs="6"
        sm="6"
        md="4"
        lg="3"
        xl="3"
      >
        <v-card class="pa-3">
          <!-- カルテ -->
          <v-card-actions
            class="d-block pointer"
            @click="showKarte = item"
            v-if="item.activity_time"
          >
            <v-img
              max-height="300"
              class="mx-auto my-2 rounded-xl"
              contain
              eager
              :src="item.path + item.image"
              @load="$redrawVueMasonry('timeline')"
              v-if="item.image"
            ></v-img>
            <v-sheet
              height="150"
              class="mx-auto my-2 rounded-xl"
              color="grey lighten-2"
              v-else
            ></v-sheet>

            <!-- タグ -->
            <v-chip class="ma-1" v-for="tag in item.tags" :key="tag.id" :value="tag.id">
              {{ tag.name }}
            </v-chip>

            <!-- 投稿日時 -->
            <p class="mt-6 mb-0 text-right small">
              {{ $moment(item.created_at).format('MM/DD HH:mm') }}
            </p>

            <!-- 活動時間 -->
            <p class="text-body-2 font-weight-bold">{{ item.activity_time.slice(0, 5) }}</p>

            <!-- 活動内容 -->
            <v-tooltip max-width="300" top>
              <template v-slot:activator="{ on, attrs }">
                <div v-bind="attrs" v-on="on">
                  <p class="mb-0 text-body-2 text-truncate">{{ item.body }}</p>
                </div>
              </template>
              <span>{{ item.body }}</span>
            </v-tooltip>
          </v-card-actions>

          <!-- 投稿 -->
          <v-card-actions class="d-block" v-else>
            <v-row no-gutters justify="end" v-if="item.user.id === authUser.id">
              <v-btn icon x-small @click="deletePost(item)">
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-row>

            <!-- 内容 -->
            <pre class="mb-0 text-body-2" v-html="$formatStr(item.body)"></pre>

            <!-- 投稿日時 -->
            <p class="mt-6 mb-0 text-right small">
              {{ $moment(item.created_at).format('MM/DD HH:mm') }}
            </p>
          </v-card-actions>

          <v-divider></v-divider>

          <v-row
            no-gutters
            align="end"
            class="mt-3 pointer"
            @click="showProfile(item.user.username)"
          >
            <!-- ユーザーアイコン -->
            <v-avatar
              size="50"
              :style="{ 'box-shadow': '0 0 0 5px ' + getColor(item.user.status) }"
            >
              <img :src="$storage('icon') + item.user.icon" />
            </v-avatar>

            <!-- ユーザー名 -->
            <div class="ml-5">
              <p class="mb-0 text-body-1">{{ item.user.handlename }}</p>
              <p class="mb-0 text-body-2">@{{ item.user.username }}</p>
            </div>
          </v-row>
        </v-card>
      </v-col>
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
            color="error"
            :loading="deletePostForm.loading"
            @click="deletePostForm.dialog = false"
          >
            キャンセル
          </v-btn>
          <v-btn color="success" :loading="deletePostForm.loading" @click="deleteSubmit()">
            削除
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <KarteDialog :karte="showKarte" @close="showKarte = null" />
    <ProfileDialog
      :username="profile.username"
      @close="profile.dialog = $event"
      v-if="profile.dialog"
    />
  </v-container>
</template>

<script>
import KarteDialog from '@/components/user/KarteDialog';
import ProfileDialog from '@/components/user/ProfileDialog';
import { OK } from '@/consts/status';

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
      data: [], // 表示データ
      kartes: [], // カルテ一覧
      posts: [], // 投稿一覧
      showKarte: null, // 詳細を表示するカルテ
      profile: {
        dialog: false, // プロフィールのダイアログ制御
        username: null, // プロフィールを表示するユーザー名
      },
      postForm: {
        body: '', // 内容
        max: 200, // 最大長
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
    ProfileDialog,
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },

  methods: {
    /**
     * データの更新
     */
    update: async function () {
      await this.getKartes();
      await this.getPosts();

      // 表示データの作成
      this.data = this.kartes.concat(this.posts);
      this.data.sort(function (a, b) {
        if (a.created_at < b.created_at) {
          return 1;
        } else {
          return -1;
        }
      });
    },

    /**
     * カルテデータの取得
     */
    getKartes: async function () {
      let response = await axios.get('/api/kartes');
      this.kartes = response.data;
    },

    /**
     * 投稿データの取得
     */
    getPosts: async function () {
      let response = await axios.get('/api/posts');
      this.posts = response.data;
    },

    /**
     * ステータス色の取得
     *
     * @param {String} status - ステータス
     * @return {String} 色
     */
    getColor: function (status) {
      let color;
      switch (status) {
        case 'free':
          color = 'green';
          break;

        case 'busy':
          color = 'red';
          break;

        case 'away':
          color = 'grey';
          break;
      }

      return color;
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
        await this.update();
        this.deletePostForm.dialog = false;
        this.deletePostForm.loading = false;
      } else {
        this.deletePostForm.loading = false;
      }
    },
  },

  async created() {
    await this.update();

    /**
     * データの同期開始
     */
    Echo.channel('timeline').listen('TimelineUpdated', (event) => {
      this.data.unshift(event);
    });
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
.v-card {
  .pointer {
    cursor: pointer;
  }

  pre {
    white-space: pre-wrap;
  }
}
</style>
