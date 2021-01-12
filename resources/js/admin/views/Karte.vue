<template>
  <v-container>
    <v-data-table :headers="headers" :items="users" sort-by="username" class="elevation-1">
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>ユーザー一覧</v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <span>カルテボタンからカルテを確認できます。</span>

          <!-- カルテ確認ダイアログ -->
          <v-dialog
            v-model="kartes.dialog"
            fullscreen
            persistent
            no-click-animation
            transition="dialog-bottom-transition"
          >
            <v-toolbar dark height="64px">
              <v-toolbar-title>{{ kartes.user.handlename }} のカルテ</v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn
                fab
                x-small
                depressed
                color="error"
                class="mr-4"
                @click="kartes.dialog = false"
              >
                <v-icon>mdi-close</v-icon>
              </v-btn>
            </v-toolbar>

            <v-container>
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

                          <v-chip
                            class="ma-2"
                            filter
                            v-for="tag in karte.tags"
                            :key="tag.id"
                            :value="tag.id"
                          >
                            {{ tag.name }}
                          </v-chip>
                        </v-tooltip>
                      </tr>
                    </tbody>
                  </template>
                </v-simple-table>

                <v-card-text class="text-center" v-if="!kartes.data.length">未投稿</v-card-text>
              </v-card>
            </v-container>
          </v-dialog>
        </v-toolbar>
      </template>

      <template v-slot:[`item.actions`]="{ item }">
        <v-icon @click="showKartes(item)">mdi-folder-account</v-icon>
      </template>

      <template v-slot:no-data>
        <v-btn color="primary" @click="getUsers()">再読み込み</v-btn>
      </template>
    </v-data-table>
  </v-container>
</template>

<script>
import { OK } from '@/consts/status';

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
      users: [],
      search: '',
      headers: [
        { text: 'ユーザー名', value: 'username' },
        { text: '表示名', value: 'handlename' },
        { text: 'メールアドレス', value: 'email' },
        { text: 'カルテ', value: 'actions', sortable: false, align: 'center' },
      ],
      kartes: {
        dialog: false,
        user: {},
        data: {},
      },
    };
  },
  methods: {
    /**
     * ユーザーデータの取得
     */
    getUsers: async function () {
      var response = await axios.get('/api/admin/users');
      this.users = response.data;
    },

    /**
     * カルテ一覧の表示
     *
     * @param Object  user  表示するユーザー
     */
    showKartes: async function (user) {
      this.kartes.user = user;
      var response = await axios.get('/api/admin/kartes/' + this.kartes.user.id);
      this.kartes.data = response.data;
      this.kartes.dialog = true;
    },
  },
  created() {
    this.getUsers();
  },
};
</script>

<style lang="scss">
.v-dialog {
  background-color: #ffffff;
}
</style>
