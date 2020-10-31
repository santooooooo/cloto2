<template>
      <!-- ローディングバー -->
    <v-progress-linear indeterminate color="blue" class="mb-0" v-if="!user"></v-progress-linear>
    <!-- プロフィール欄 -->
    <div class="profile__content card" v-else>
  
        <!-- アイコンとユーザー名 -->
        <div class="profile__user">
          <img
            :src="$storage('icon') + user.icon"
            class="rounded-circle"
            width="100"
            height="100"
          />
          <!-- <p class="profile__user--handlename">{{ user.handlename }}</p>
          <p class="profile__user--username">{{ '@' + user.username }}</p> -->
        </div>

      <!-- アカウント名 -->
        <div class="form-group">
          <label for="handlename">アカウント名</label>
          <input
            type="text"
            class="form-control"
            name="handlename"
            id="handlename"
            placeholder=  user.handlename
            readonly
          />{{ user.handlename }}
        </div>

        <!-- ユーザー名 -->
        <div class="form-group">
          <label for="username">ユーザー名</label>
          <input type="text" class="form-control" name="username" id="username"  placeholder="aaa" readonly/>
        </div>


 
        <!-- メールアドレス -->
        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="text" class="form-control" name="email" id="email" placeholder="aaa@gmail.com" readonly />
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
            placeholder="CLOTO_JP"
            readonly
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
            placeholder="CLOTO_JP"
            readonly
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
            placeholder="CLOTO_JP"
            readonly
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
            placeholder="https://cloto.jp"
            readonly
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
            readonly
          >{{ user.introduction }}</textarea>
        </div>



        
          <div class="profile__introduction" v-if="user.introduction">
          <!-- <p>{{ user.introduction }}</p> -->

              <div class="profile__button">
                <!-- マイページの場合 -->
                <router-link
                  class="btn btn-cloto-primary"
                  :to="{
                    name: 'profileEdit',
                    params: { username: $store.getters['auth/user'].username },
                  }"
                  v-if="user.id == $store.getters['auth/user'].id"
                  >編集する</router-link
                >
              </div>
          </div>
    
          <!-- ボタン類 -->
          <!-- <div class="profile__sns-container" v-if="sns || user.web">
            <a
              class="profile__sns--twitter"
              :href="'https://twitter.com/' + sns.twitter"
              target="_blank"
              v-if="sns.twitter"
            >
              <i class="fab fa-twitter fa-2x"></i>
            </a>
            <a
              class="profile__sns--github"
              :href="'https://github.com/' + sns.github"
              target="_blank"
              v-if="sns.github"
            >
              <i class="fab fa-github fa-2x"></i>
            </a>
            <a
              class="profile__sns--qiita"
              :href="'https://qiita.com/' + sns.qiita"
              target="_blank"
              v-if="sns.qiita"
            >
              <i class="fa fa-search fa-2x"></i>
            </a>
            <a class="profile__sns--web" :href="user.web" target="_blank" v-if="user.web">
              <i class="fas fa-link fa-2x"></i>
            </a>
          </div> -->
   </div>
</template>

<script>
export default {
  data() {
    return {
      user: null,
      sns: null,
    };
  },

 
  async mounted() {
    /**
     * ユーザーデータの取得
     */
    var response = await this.$http.get(this.$endpoint('authUser'));
    this.user = response.data;

    if (this.user.sns) {
      this.sns = JSON.parse(this.user.sns);
    }
  },


 methods: {


   profileDetail:function(){

   },
   KarteDetail:function(){

   },

 }
};
</script>

<style lang="scss" scoped>
@import '~/_variables';



.profile {

  &__content {
    width: 60%;
    margin: 2em auto;
    padding: 1em 10em;
    border: none;
  }

  &__user {
   margin: 1em auto;
    &--handlename {
      text-align: center;
      margin-top: 1em;
      margin-bottom: 0;
    }

    &--username {
      text-align: center;
    }
  }

  &__button {
    height: 60px;
    margin-top: 2em;
    text-align: center;
  }

  // &__sns-container {
  //   height: 30px;
  //   margin-bottom: 2em;
  //   text-align: center;

  //   div {
  //     margin: 0 auto;
  //   }
  // }

  // %__sns {
  //   margin: 0 1em;
  // }

  // &__sns {
  //   @extend %__sns;

  //   &--twitter {
  //     @extend %__sns;

  //     color: $twitter-color;

  //     &:hover {
  //       color: $twitter-color;
  //     }
  //   }

  //   &--github {
  //     @extend %__sns;

  //     color: $github-color;

  //     &:hover {
  //       color: $github-color;
  //     }
  //   }

  //   &--qiita {
  //     @extend %__sns;

  //     color: $qiita-color;

  //     &:hover {
  //       color: $qiita-color;
  //     }
  //   }

  //   &--web {
  //     @extend %__sns;

  //     color: $black;

  //     &:hover {
  //       color: $black;
  //     }
  //   }
  // }

}
</style>
