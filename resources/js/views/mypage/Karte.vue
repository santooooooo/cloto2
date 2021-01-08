<template>
  <v-container>
    <!-- ローディング画面 -->
    <v-overlay v-if="!kartes.data">
      <v-progress-circular indeterminate size="64" v-if="!kartes.data"></v-progress-circular>
    </v-overlay>

    <v-card max-width="1080" tile class="ma-5">
      <v-simple-table headers-length:5>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">画像</th>
              <th class="text-left">活動内容</th>
              <th class="text-left">活動時間</th>
              <th class="text-left">達成したこと</th>
              <th class="text-left">できなかったこと</th>
              <th class="text-left">参考文献</th>
              <th class="text-left">タグ</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="karte in kartes.data" :key="karte.id">
              <!-- 画像 -->
              <td>
                <v-img
                  style="cursor: pointer"
                  @click="expandImage(karte.image)"
                  max-width="120"
                  class="my-2"
                  contain
                  :src="$storage('karte') + karte.image"
                  v-if="karte.image"
                />

                <v-sheet
                  color="grey lighten-2"
                  width="120"
                  height="120"
                  class="my-2"
                  v-else
                ></v-sheet>
              </td>

              <!-- 活動内容 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on">
                    <p class="karte-content">{{ karte.body }}</p>
                  </td>
                </template>
                <span>{{ karte.body }}</span>
              </v-tooltip>

              <!-- 活動時間 -->
              <td>
                <p class="karte-content">{{ karte.activity_time.slice(0, 5) }}</p>
              </td>

              <!-- 達成したこと -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.achieve">
                    <p class="karte-content">{{ karte.achieve }}</p>
                  </td>

                  <td v-else>
                    <p class="karte-content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.achieve }}</span>
              </v-tooltip>

              <!-- できなかったこと -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.challenge">
                    <p class="karte-content">{{ karte.challenge }}</p>
                  </td>

                  <td v-else>
                    <p class="karte-content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.challenge }}</span>
              </v-tooltip>

              <!-- 参考文献 -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.reference">
                    <p class="karte-content">{{ karte.reference }}</p>
                  </td>

                  <td v-else>
                    <p class="karte-content">未入力</p>
                  </td>
                </template>
                <span>{{ karte.reference }}</span>
              </v-tooltip>

              <!-- タグ -->
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.tags.length">
                    <p class="karte-content">タグ{{ karte.tags.length }}個</p>
                  </td>

                  <td v-else>
                    <p class="karte-content">タグなし</p>
                  </td>
                </template>

                <v-chip class="ma-2" filter v-for="tag in karte.tags" :key="tag.id" :value="tag.id">
                  {{ tag.name }}
                </v-chip>
              </v-tooltip>
            </tr>
          </tbody>
        </template>
      </v-simple-table>

      <v-card-text class="text-center" v-if="!kartes.data.length">未投稿</v-card-text>
    </v-card>

    <v-dialog v-model="dialog" width="700">
      <v-card>
        <v-img contain :src="$storage('karte') + image" />
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  head: {
    title() {
      return {
        inner: 'カルテ',
      };
    },
  },
  data() {
    return {
      dialog: false,
      image: null,
      projects: {
        data: '',
        loading: false,
      },
      tasks: {
        data: '',
        loading: false,
      },
      kartes: {
        data: '',
        loading: false,
      },
    };
  },

  methods: {
    /**
     * プロジェクトの取得
     */
    getProjects: async function () {
      this.projects.loading = true;

      var response = await this.$http.get('/api/projects');
      this.projects.data = response.data;

      this.projects.loading = false;
    },

    /**
     * タスクの取得
     *
     * @param Number  projectId 取得するタスクのプロジェクトID
     */
    getTasks: async function (projectId) {
      this.tasks.loading = true;
      this.kartes.data = '';

      var response = await this.$http.get('/api/tasks/' + projectId);
      this.tasks.data = response.data;

      this.tasks.loading = false;
    },

    /**
     * カルテの取得
     *
     * @param Number  taskId 取得するカルテのタスクID
     */
    getKartes: async function (taskId) {
      this.kartes.loading = true;

      var response = await this.$http.get('/api/kartes/index_by_auth_user');
      this.kartes.data = response.data;

      this.kartes.loading = false;
    },

    /**
     * 画像の拡大
     *
     * @param String  image 拡大する画像
     */
    expandImage: function (image) {
      this.dialog = true;
      this.image = image;
    },
  },

  mounted() {
    this.getProjects();
    this.getKartes();
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.karte-content {
  width: 100px;
  margin: 0;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}
</style>
