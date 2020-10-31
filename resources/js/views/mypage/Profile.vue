<template>
  <div class="card">
    <!-- アイコン表示 -->
    <div>
      <img
        :src="$storage('icon') + authUser.icon"
        class="rounded-circle"
        width="100"
        height="100"
      />
    </div>

    <!-- アイコン -->
    <div class="form-group">
      <image-drop-upload
        :no-change-crop-ratio="true"
        ratio-x="1"
        ratio-y="1"
        @input="profileUpdateForm.icon = $event"
      ></image-drop-upload>
    </div>

    <!-- ユーザー名 -->
    <div class="form-group">
      <label for="username">ユーザー名</label>
      <input
        type="text"
        class="form-control"
        name="username"
        id="username"
        v-model="profileUpdateForm.username"
      />
    </div>

    <!-- メールアドレス -->
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input
        type="text"
        class="form-control"
        name="email"
        id="email"
        v-model="profileUpdateForm.email"
      />
    </div>

    <!-- ハンドルネーム -->
    <div class="form-group">
      <label for="handlename">アカウント名</label>
      <input
        type="text"
        class="form-control"
        name="handlename"
        id="handlename"
        v-model="profileUpdateForm.handlename"
      />
    </div>

    <!-- Twitter -->
    <label class="sr-only" for="twitter">Twitter</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fab fa-twitter"></i>
        </div>
      </div>
      <input
        type="text"
        class="form-control"
        name="twitter"
        id="twitter"
        placeholder="Twitter 例：CLOTO_JP"
        v-model="profileUpdateForm.twitter"
      />
    </div>

    <!-- GitHub -->
    <label class="sr-only" for="github">GitHub</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fab fa-github"></i>
        </div>
      </div>
      <input
        type="text"
        class="form-control"
        name="github"
        id="github"
        placeholder="GitHub 例：CLOTO_JP"
        v-model="profileUpdateForm.github"
      />
    </div>

    <!-- Qiita -->
    <label class="sr-only" for="qiita">Qiita</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fa fa-search"></i>
        </div>
      </div>
      <input
        type="text"
        class="form-control"
        name="qiita"
        id="qiita"
        placeholder="Qiita 例：CLOTO_JP"
        v-model="profileUpdateForm.qiita"
      />
    </div>

    <!-- ホームページ -->
    <label class="sr-only" for="web">Webサイト</label>
    <div class="input-group mb-2 mr-sm-2">
      <div class="input-group-prepend">
        <div class="input-group-text">
          <i class="fas fa-blog"></i>
        </div>
      </div>
      <input
        type="text"
        class="form-control"
        name="web"
        id="web"
        placeholder="Webサイト 例：https://cloto.jp"
        v-model="profileUpdateForm.web"
      />
    </div>

    <!-- 自己紹介 -->
    <div class="form-group">
      <label for="introduction">自己紹介</label>
      <textarea
        class="form-control"
        name="introduction"
        id="introduction"
        rows="4"
        cols="40"
        v-model="profileUpdateForm.introduction"
      ></textarea>
    </div>

    <!-- ボタン -->
    <div class="profile-edit__button row">
      <div class="buttonSet mx-auto">
        <button type="button" class="btn btn-primary btn-sm" @click="submit()">更新</button>
        <router-link class="btn btn-secondary btn-sm btn-danger" :to="{ name: 'mypage' }"
          >戻る</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>
import { OK } from '@/consts/status';

export default {
  head: {
    title() {
      return {
        inner: this.$route.params.username + ' - ' + '編集',
      };
    },
  },
  data() {
    return {
      profileUpdateForm: {
        username: '',
        email: '',
        handlename: '',
        icon: '',
        twitter: '',
        github: '',
        qiita: '',
        web: '',
        introduction: '',
        loading: false,
        validation: {
          valid: false,
          bodyRules: [(v) => !!v || '活動内容は必須項目です。'],
        },
      },
    };
  },

  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },

  methods: {
    submit: async function () {
      // if (this.$refs.karteForm.validate()) {
      //   this.karteForm.loading = true;

      var input = new FormData();
      input.append('username', this.profileUpdateForm.username);
      input.append('email', this.profileUpdateForm.email);
      input.append('handlename', this.profileUpdateForm.handlename);
      input.append('icon', this.profileUpdateForm.icon);
      input.append('twitter', this.profileUpdateForm.twitter);
      input.append('github', this.profileUpdateForm.github);
      input.append('qiita', this.profileUpdateForm.qiita);
      input.append('web', this.profileUpdateForm.web);
      input.append('introduction', this.profileUpdateForm.introduction);

      // カルテ保存処理
      var response = await this.$http.post(this.$endpoint('profileUpdate'), input);

      if (response.status === OK) {
        // ユーザーデータの同期
        await this.$store.dispatch('auth/syncAuthUser');

        this.$router.push({
          name: 'userPage',
          params: { username: this.authUser.username },
        });

        // フォームの初期化
        // this.$refs.karteForm.reset();
        // this.karteForm.loading = false;

        // this.dialog = false;
        // this.continueDialog = true;
      }

      // // 結果表示
      // // this.karteForm.loading = false;
      // // this.karteForm.message = response.data;
      // // this.karteForm.snackbar = true;
      // }
    },
  },

  mounted() {
    this.profileUpdateForm = this.authUser;
  },
};
</script>
