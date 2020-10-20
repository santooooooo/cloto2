<template>
  <v-container ma-0 pa-0>
    <!-- プロジェクト選択ダイアログ -->
    <v-dialog persistent v-model="dialog" width="600">
      <v-card class="headline grey darken-2">
        <v-list class="rounded-lg">
          <v-list-item-group color="success" v-model="projectIndex">
            <v-list-item v-for="project in projects" :key="project.id">
              <v-list-item-content @click="detailDialog = true">
                <v-list-item-title v-text="project.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="addDialog = true" x-small fab color="white">
            <v-icon> mdi-plus </v-icon>
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="yellow darken-1" @click="close()" right absolute>
            <span class="white--text">close</span>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- プロジェクト詳細ダイアログ -->
    <v-dialog persistent v-model="detailDialog" v-if="projectIndex !== ''" width="600">
      <v-card class="headline grey darken-2">
        <v-card-title class="text-center">{{ projects[projectIndex].title }} </v-card-title>
        <v-card-actions>
          <div class="ma-6">
            <v-btn color="yellow darken-1" @click="detailDialog = false">
              <span class="white--text">Let's study</span>
            </v-btn>
          </div>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- プロジェクト追加ダイアログ -->
    <v-dialog persistent v-model="addDialog" width="600">
      <v-card class="headline grey darken-2 text-center">
        <v-card-text class="pa-2 white--text font-weight-bold"> プロジェクト </v-card-text>

        <v-textarea
          solo
          rounded
          name="input-7-4"
          rows="10"
          v-model="newProject"
          label="目標を入力しよう!"
          auto-grow
          class="pa-2"
        ></v-textarea>

        <v-card-actions class="align-center">
          <v-spacer></v-spacer>
          <v-btn color="yellow darken-1" @click="addDialog = false">
            <span class="white--text"> 追加 </span>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      dialog: true,
      projects: [
        {
          id: 1,
          title: 'shuto',
        },
        {
          id: 10,
          title: 'shingai',
        },
        {
          id: 25,
          title: 'bana',
        },
        {
          id: 104,
          title: 'mamesu',
        },
      ],
      projectIndex: '',
      detailDialog: false, // プロジェクト詳細モーダルの制御
      addDialog: false, // プロジェクト追加モーダルの制御
      newProject: '', // 追加するプロジェクト
    };
  },
  methods: {
    close: function () {
      this.dialog = false;
      this.$emit('close', false);
    },
  },
};
</script>
