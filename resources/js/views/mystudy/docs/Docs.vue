<template>
  <v-container id="docs">
    <div v-if="$route.params.roadName === 'javascript'">
      <JavaScript0 @karte-post="kartePost()" @next="next()" v-if="currentClass === 0" />
      <JavaScript1 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 1" />
      <JavaScript2 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 2" />
      <JavaScript3 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 3" />
      <JavaScript4 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 4" />
      <JavaScript5 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 5" />
      <JavaScript6 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 6" />
      <JavaScript7 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 7" />
      <JavaScript8 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 8" />
      <JavaScript9 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 9" />
      <JavaScript10 @karte-post="kartePost()" @next="next()" v-else-if="currentClass === 10" />
      <JavaScriptClear v-else-if="currentClass > 10" />
    </div>

    <KartePostDialog
      :roadmapId="karte.roadmapId"
      @close="karte.dialog = $event"
      @next-class="nextClass()"
      v-if="karte.dialog"
    />

    <!-- クリア祝いダイアログ -->
    <v-dialog persistent v-model="congratulationDialog" width="80%">
      <v-card>
        <div class="text-center">
          <v-img contain :src="$storage('system') + 'card.png'"></v-img>
        </div>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="next()">次のコースへ</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
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
import JavaScriptClear from '@/views/mystudy/docs/javascript/Clear';
import { OK } from '@/consts/status';

export default {
  data() {
    return {
      karte: {
        dialog: false, // カルテ投稿ダイアログの制御
        roadmapId: null, // カルテを紐付けるロードマップID
      },
      congratulationDialog: false, // クリア祝いダイアログの制御
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
    JavaScriptClear,
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },
    currentClass() {
      return Number(this.$route.params.class);
    },
  },
  methods: {
    /**
     * カルテの投稿
     *
     * @param {Number} roadmapId - カルテを紐付けるロードマップID
     */
    kartePost: function (roadmapId = null) {
      this.karte.roadmapId = roadmapId;
      this.karte.dialog = true;
    },
    /**
     * 次へ進むボタン押下時の処理
     */
    next: function () {
      if (this.currentClass < this.authUser.roadmaps[0].in_progress) {
        // カルテ記入後もしくはクリア済みのクラスから進む場合
        this.$router.push({
          name: 'docs',
          params: { roadName: 'javascript', class: this.currentClass + 1 },
        });
        // 最上部へスクロール
        this.$scrollTo('#main');
        this.congratulationDialog = false;
      } else if (this.currentClass === this.authUser.roadmaps[0].in_progress) {
        // 進行中のクラスから進む場合はカルテを記入
        this.kartePost(this.authUser.roadmaps[0].id);
      }
    },
    /**
     * 次のクラスへ進む（カルテ記入後）
     */
    nextClass: async function () {
      let response = await axios.post('/api/roadmaps/' + this.authUser.roadmaps[0].id, {
        _method: 'patch',
      });

      if (response.status === OK) {
        this.authUser.roadmaps[0].in_progress += 1;
        this.congratulationDialog = true;
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
    #content {
      font-size: 1.2em;

      h2 {
        border-left: 6px solid $dark-blue;
      }

      p,
      ul,
      ol {
        margin-bottom: 32px;
      }
    }
  }
}
</style>
