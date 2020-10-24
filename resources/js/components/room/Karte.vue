<template>
  <!-- カルテ記入ダイアログ -->
  <v-dialog persistent scrollable v-model="dialog" width="600">
    <v-card class="headline pa-3 grey darken-1 text-center">
      <v-card-text class="pa-2 white--text title whitefont-weight-bold">
        {{ task }}
      </v-card-text>

      <!-- <v-card height="200" class="m-2 rounded-xl">
        <v-btn class="mt-15" color="yellow darken-1">
          <span class="white--text">画像を選択</span>　
        </v-btn>
      </v-card> -->

     
      <!-- <div class="m-3 p-1"> -->
   

         <h6 >達成した/つまずいたこと</h6>
        <v-textarea
          v-model="detail"
          rounded
          filled
          rows="3"
          color="black"
          background-color="white"
          :rules="[required]"
        ></v-textarea>
        <!-- <v-textarea
              auto-grow
              rounded
              filled
              rows="1"
              color="black"
            background-color="white"
            label="#html #css"
            ></v-textarea> -->

       <v-row class="text-center m-1" justify="center">
        
        <v-col cols="12" sm="6" margin-bottom="30px">
          <h6 >活動時間</h6>
          <v-textarea
            solo
            rounded
            name="input-7-4"
            rows="1"
            label="13:30～14:45"
            auto-grow
          ></v-textarea>
          
        </v-col>
          <v-col cols="12" sm="6" margin-bottom="30px">
        <h6 >参考文献</h6>

        <v-textarea
          v-model="tag"
          solo
          rounded
          name="input-7-4"
          rows="1"
          label="#html #css"
          auto-grow
        ></v-textarea>
           </v-col>
      </v-row>
      <v-row justify="center">
    <v-dialog
      v-model="continueDialog"
      max-width="140"
     persistent
    >
      <v-card center >
          <v-btn
            color="green darken-1"
            text
            @click="continueDialog = false,$emit('open-project-dialog', true)"
          >
            続行
          </v-btn>
          <v-btn
            color="green darken-1"
            text
            @click="continueDialog = false"
            :to="{ name: 'home' }"
          >
            終了
          </v-btn>
      </v-card>
    </v-dialog>
  </v-row>
      <v-card-actions class="align-center">
        <v-spacer></v-spacer>
        <!-- <v-btn color="white" text> IMG </v-btn> -->
        <v-btn color="yellow darken-1"  @click="dialog = false, continueDialog=true">
          <span class="white--text">記録</span>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    task: String,
  },
  data() {
    return {
      dialog: true,
      continueDialog: false,
      title: '', // カルテのタイトル
      tag: '', // カルテのタグ
      detail: '', // カルテの詳細
      required: value => !!value || "必ず入力してください",
    };
  },
};
</script>

<style></style>
