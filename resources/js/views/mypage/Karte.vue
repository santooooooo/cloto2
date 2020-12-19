<template>
  <v-container py-0>
    <!-- ローディング画面 -->
    <v-overlay v-if="!kartes.data">
      <v-progress-circular indeterminate size="64" v-if="!kartes.data"></v-progress-circular>
    </v-overlay>

    <!-- <v-menu open-on-hover top offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on"> Dropdown </v-btn>
      </template>

      <v-list>
        <v-list-item v-for="(item, index) in kartes.data" :key="index">
          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu> -->

    <v-card max-width="1080" tile class="ml-10">
      <v-simple-table headers-length:5>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">画像</th>
              <th class="text-left">内容</th>
              <th class="text-left">投稿時間</th>
              <th class="text-left">達成</th>
              <th class="text-left">未達成</th>
              <th class="text-left">参考文献</th>
              <th class="text-left">技術タグ</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="karte in kartes.data" :key="karte.id">
              <td v-if="karte.image != null">
                <p class="karteContent">
                  <v-img
                    style="cursor: pointer"
                    @click="openKarte(karte)"
                    max-width="120"
                    class="mt-2"
                    contain
                    :src="$storage('karte') + karte.image"
                  />
                </p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td>

              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.body != null">
                    <p class="karteContent">{{ karte.body }}</p>
                  </td>

                  <td v-else>
                    <p class="karteContent">None</p>
                  </td>
                </template>
                <span>{{ karte.body }}</span>
              </v-tooltip>

              <td>
                <p class="karteContent">00:00</p>
              </td>
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.archive != null">
                    <p class="karteContent">{{ karte.archive }}</p>
                  </td>

                  <td v-else>
                    <p class="karteContent">None</p>
                  </td>
                </template>
                <span>{{ karte.archive }}</span>
              </v-tooltip>
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.trouble != null">
                    <p class="karteContent">{{ karte.trouble }}</p>
                  </td>

                  <td v-else>
                    <p class="karteContent">None</p>
                  </td>
                </template>
                <span>{{ karte.trouble }}</span>
              </v-tooltip>
              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.reference != null">
                    <p class="karteContent">{{ karte.reference }}</p>
                  </td>

                  <td v-else>
                    <p class="karteContent">None</p>
                  </td>
                </template>
                <span>{{ karte.reference }}</span>
              </v-tooltip>

              <v-tooltip max-width="300" top>
                <template v-slot:activator="{ on, attrs }">
                  <td v-bind="attrs" v-on="on" v-if="karte.technologies.length != 0">
                    <p class="karteContent">技術タグ{{ karte.technologies.length }}個</p>
                  </td>

                  <td v-else>
                    <p class="karteContent">None</p>
                  </td>
                </template>

                <v-chip
                  class="ma-2"
                  filter
                  v-for="technology in karte.technologies"
                  :key="technology.id"
                  :value="technology.id"
                >
                  {{ technology.name }}
                </v-chip>
              </v-tooltip>

              <!-- <td v-if="karte.technologies.length != 0">
                <p class="karteContent">技術タグ{{ karte.technologies.length }}個</p>
              </td>
              <td v-else>
                <p class="karteContent">None</p>
              </td> -->
            </tr>
          </tbody>
        </template>
      </v-simple-table>

      <v-dialog v-model="dialog" width="700">
        <v-card>
          <v-img contain :src="$storage('karte') + chosenKarte.image" />
        </v-card>
      </v-dialog>
    </v-card>
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
      showMenu: false,
      chosenKarte: '',
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
      karteDialog: {
        dialog: false,
        data: '',
      },
      //カルテダイアログ
      dialog: false,
      selectedItem: null,
    };
  },

  methods: {
    /**
     * プロジェクトの取得
     */
    getProjects: async function () {
      this.projects.loading = true;

      var response = await this.$http.get(this.$endpoint('projectIndex'));
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

      var response = await this.$http.get(this.$endpoint('taskIndex', [projectId]));
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

      var response = await this.$http.get(this.$endpoint('karteIndexByAuthUser'));
      this.kartes.data = response.data;

      this.kartes.loading = false;
    },

    openKarte: function (content) {
      this.dialog = true;
      this.chosenKarte = content;
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

.karteContent {
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  width: 100px;
}
</style>
