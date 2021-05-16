<template>
  <v-container id="docs">
    <div v-if="$route.params.roadName === 'javascript'">
      <JavaScript0 @next="next()" v-if="$route.params.class == 0" />
      <JavaScript1 @next="next()" v-else-if="$route.params.class == 1" />
      <JavaScript2 @next="next()" v-else-if="$route.params.class == 2" />
      <JavaScript3 @next="next()" v-else-if="$route.params.class == 3" />
      <JavaScript4 @next="next()" v-else-if="$route.params.class == 4" />
      <JavaScript5 @next="next()" v-else-if="$route.params.class == 5" />
      <JavaScript6 @next="next()" v-else-if="$route.params.class == 6" />
      <JavaScript7 @next="next()" v-else-if="$route.params.class == 7" />
      <JavaScript8 @next="next()" v-else-if="$route.params.class == 8" />
      <JavaScript9 @next="next()" v-else-if="$route.params.class == 9" />
      <JavaScript10 @next="next()" v-else-if="$route.params.class == 10" />
    </div>

    <KartePostDialog @close="dialog = $event" v-if="dialog" />
  </v-container>
</template>

<script>
import KartePostDialog from '@/components/commons/KartePostDialog';
import JavaScript0 from '@/views/mystudy/docs/javascript/Class0';
import JavaScript1 from '@/views/mystudy/docs/javascript/Class1';
import JavaScript2 from '@/views/mystudy/docs/javascript/Class2';
import JavaScript3 from '@/views/mystudy/docs/javascript/Class3';
import JavaScript4 from '@/views/mystudy/docs/javascript/Class4';
import JavaScript5 from '@/views/mystudy/docs/javascript/Class5';
import JavaScript6 from '@/views/mystudy/docs/javascript/Class6';
import JavaScript7 from '@/views/mystudy/docs/javascript/Class7';
import JavaScript8 from '@/views/mystudy/docs/javascript/Class8';
import JavaScript9 from '@/views/mystudy/docs/javascript/Class9';
import JavaScript10 from '@/views/mystudy/docs/javascript/Class10';

export default {
  data() {
    return {
      dialog: false, // カルテ投稿のダイアログ制御
    };
  },
  components: {
    KartePostDialog,
    JavaScript0,
    JavaScript1,
    JavaScript2,
    JavaScript3,
    JavaScript4,
    JavaScript5,
    JavaScript6,
    JavaScript7,
    JavaScript8,
    JavaScript9,
    JavaScript10,
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
  },
  methods: {
    /**
     * 次へ進むボタン押下時の処理
     */
    next: function () {
      if (this.$route.params.class < this.authUser.roadmaps[0].in_progress) {
        // クリア済みのクラスから進む場合
        this.$router.push({
          name: 'docs',
          params: { roadName: 'javascript', class: this.$route.params.class + 1 },
        });
      } else if (this.$route.params.class == this.authUser.roadmaps[0].in_progress) {
        // 進行中のクラスから進む場合
        this.dialog = true;
      }
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

#docs {
  background-color: $white;

  // router-view内の要素のCSS
  &::v-deep {
    .index {
      position: fixed;
      margin-left: 3%;

      li {
        cursor: pointer;
      }
    }

    .text-left-border {
      border-left: 6px solid $dark-blue;
    }
  }
}
</style>
