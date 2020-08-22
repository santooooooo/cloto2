<template>
  <div class="welcome-top__welcome row">
    <div>
      <h1>{{ word }}</h1>

      <div v-if="user">
        <div class="button">
          <a class="btn btn-cloto-primary" v-bind:href="'/'+user">マイページ</a>
        </div>
        <div class="button">
          <a class="btn btn-cloto-primary" href="/course/all">コース一覧</a>
        </div>
      </div>

      <div v-else>
        <div class="button">
          <router-link class="btn btn-cloto-primary" to="/register">さあ飛び込もう！</router-link>
        </div>
        <div class="button">
          <router-link class="btn btn-cloto-primary" to="/login">もう会員ですか？</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: String
    }
  },
  data() {
    return {
      mode: 1,
      loop: 0,
      word: "　"
    };
  },
  created: function() {
    setInterval(() => {
      if (this.mode) {
        this.loop++;
      } else {
        this.loop = 0;
      }
    }, 500);
  },
  watch: {
    loop: function(i) {
      switch (i) {
        case 0:
          this.mode = 1;
          this.word = "　";
          break;

        case 1:
          this.word = "　";
          break;

        case 2:
          this.word = "競";
          break;

        case 3:
          this.word = "競争";
          break;

        case 4:
          this.word = "競争よ";
          break;

        case 5:
          this.word = "競争より";
          break;

        case 6:
          this.word = "競争よ";
          break;

        case 7:
          this.word = "競争";
          break;

        case 8:
          this.word = "競";
          break;

        case 9:
          this.word = "　";
          break;

        case 10:
          this.word = "共";
          break;

        case 11:
          this.word = "共創";
          break;

        case 12:
          this.word = "共創";
          break;

        case 13:
          this.mode = 0;
          this.word = "共";
          break;
      }
    }
  }
};
</script>
