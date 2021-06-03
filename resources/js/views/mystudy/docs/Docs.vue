<template>
  <!-- 画像が必要な時 -->
  <!-- <v-row>
    <v-col cols="6">
      <p>ダミー</p>
    </v-col>
    <v-col cols="6">
      <v-img max-width="90%" max-height="60vh" :src="filePath + '1.png'" class="mb-10"></v-img>
    </v-col>
  </v-row> -->
  <v-container fluid id="docs">
    <!-- 目次（要初期化） -->
    <VueSideCatalog class="catalog" v-bind="catalogProps" :key="currentClass">
      <template #default="{ isActive }">
        <i :class="['line-style', isActive ? 'line-style--active' : '']"></i>
      </template>
    </VueSideCatalog>

    <!-- コンテンツ -->
    <div v-if="currentRoad === 'javascript'">
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

    <!-- カルテ投稿ダイアログ -->
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
          <v-img
            max-width="100%"
            max-height="80vh"
            :src="$docs(currentRoad, 'class' + currentClass) + 'clear.png'"
          ></v-img>
        </div>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text color="primary" @click="next()">次のコースへ</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import VueSideCatalog from 'vue-side-catalog';
import 'vue-side-catalog/lib/vue-side-catalog.css';
import { OK } from '@/consts/status';
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

export default {
  components: {
    VueSideCatalog,
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
  data() {
    return {
      catalogProps: {
        container: '#content',
        height: 'calc(90vh - 150px)',
        iconLeft: true,
        lineLeft: 0,
      }, // 目次の設定
      karte: {
        dialog: false, // カルテ投稿ダイアログの制御
        roadmapId: null, // カルテを紐付けるロードマップID
      },
      congratulationDialog: false, // クリア祝いダイアログの制御
    };
  },
  computed: {
    authUser() {
      return this.$store.getters['auth/user'];
    },

    currentRoad() {
      // 現在閲覧中のロード
      return this.$route.params.roadName;
    },

    currentClass() {
      // 現在閲覧中のクラス
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
        // クリア済みのクラスから進む場合（もしくはカルテ記入後）
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

  .catalog {
    position: fixed;
    top: 100px;
    left: 270px;
    width: 230px;

    .line-style {
      display: inline-block;
      width: 3px;
      height: 20px;
      background: transparent;
    }

    .line-style--active {
      background: currentColor;
    }
  }

  // router-view内の要素のCSS
  &::v-deep {
    #content {
      padding-left: 320px;
      font-size: 1.1em;

      h1 {
        line-height: 20vh;
        background-color: $primary;
      }

      h2 {
        margin-top: 30px;
        padding-top: 50px;

        span {
          padding-left: 12px;
          border-left: 6px solid $dark-blue;
          background-color: #eeeeee;
        }
      }

      .agenda {
        list-style: none;
      }

      p {
        line-height: 2.2em;
        margin-bottom: 32px;
      }

      ul,
      ol {
        margin-bottom: 32px;
      }
    }
  }
}
</style>

<style lang="scss">
// vue-side-catalogのCSS
.side-catalog__list {
  overflow-y: auto;

  // スクロールバーを非表示
  -ms-overflow-style: none;
  scrollbar-width: none;
  &::-webkit-scrollbar {
    display: none;
  }
}
</style>
