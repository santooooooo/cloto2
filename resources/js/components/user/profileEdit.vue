<template>
  <div class="profile-edit__container card">
    <!-- アイコン表示 -->
    <div class="profile-edit__icon-show">
      <img
        :src="$storage('icon') + $root.AuthUser.icon"
        class="rounded-circle"
        width="100"
        height="100"
      />
    </div>

    <!-- ユーザーID -->
    <input type="hidden" name="user_id" :value="$root.AuthUser.user_id" />

    <!-- アイコン -->
    <div class="profile-edit__form-content--icon form-group">
      <image-upload-area :no-change-crop-ratio="true" ratio-x="1" ratio-y="1"></image-upload-area>
    </div>

    <!-- ユーザー名 -->
    <div class="form-group">
      <label for="username">ユーザー名</label>
      <input
        type="text"
        class="form-control"
        name="username"
        id="username"
        :value="$root.AuthUser.username"
      />
    </div>

    <!-- メールアドレス -->
    <div class="form-group">
      <label for="email">メールアドレス</label>
      <input type="text" class="form-control" name="email" id="email" :value="$root.AuthUser.email" />
    </div>

    <!-- ハンドルネーム -->
    <div class="form-group">
      <label for="handlename">表示名</label>
      <input
        type="text"
        class="form-control"
        name="handlename"
        id="handlename"
        :value="$root.AuthUser.handlename"
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
        value
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
        value
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
        value
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
        :value="$root.AuthUser.web"
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
        v-model="$root.AuthUser.introduction"
      ></textarea>
    </div>

    <!-- 通知設定 -->
    <div class="form-group">
      メール通知設定
      <div class="input-group-prepend">
        <div class="input-group-text">
          <input type="radio" name="setting_notification" value="All" />受け取る&nbsp;
          <input type="radio" name="setting_notification" value="Database" />受け取らない
        </div>
      </div>
    </div>

    <!-- ボタン -->
    <div class="profile-edit__button row">
      <div class="buttonSet mx-auto">
        <input type="submit" name="send" value="更新" class="btn btn-primary btn-sm" />
        <router-link
          class="btn btn-secondary btn-sm btn-danger"
          :to="{ name: 'userPage', params: { username: this.$route.params.username } }"
        >戻る</router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>