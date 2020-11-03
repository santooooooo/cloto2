<template>
  <!--
    使用方法
    <input-image
      :no-change-crop-ratio="true"
      ratio-x="1"
      ratio-y="1"
      @input="image = $event">
    </input-image>
    no-change-crop-ratio: トリミング時の比率保持
    ratio-x: 横の比率
    ratio-y: 縦の比率
    imageにトリミング後の画像データが入ります．
  -->

  <v-container>
    <!-- 画像アップロードエリア -->
    <v-card
      height="290"
      rounded="xl"
      :color="areaColor"
      @dragover.prevent="areaColor = '#d9ffda'"
      @dragleave.prevent="areaColor = '#ffffff'"
      @drop.prevent="inputImage()"
    >
      <v-layout style="height: 290px" align-center class="pa-1">
        <!-- 画像プレビュー -->
        <v-img contain :src="preview" max-height="280px" class="align-center white--text">
          <v-btn depressed class="mb-1 white--text" color="success" @click="$refs.input.click()">
            画像を選択
          </v-btn>

          <input
            ref="input"
            type="file"
            @change="inputImage()"
            style="display: none"
            accept="image/png, image/jpeg"
          />

          <p class="mt-1 text-body-2 text--secondary">画像ファイルをドラッグ＆ドロップ</p>
        </v-img>
      </v-layout>
    </v-card>

    <!-- トリミングモーダル -->
    <v-dialog persistent width="600" v-model="cropperDialog">
      <v-card class="headline grey darken-2 text-center">
        <v-container>
          <v-row justify="end">
            <v-btn fab x-small depressed color="error" class="mr-3" @click="cropperDialog = false">
              <v-icon>mdi-close</v-icon>
            </v-btn>
          </v-row>

          <vueCropper
            ref="cropper"
            :img="image"
            :outputSize="option.size"
            :outputType="option.outputType"
            :autoCrop="option.autoCrop"
            :autoCropWidth="option.autoCropWidth"
            :autoCropHeight="option.autoCropHeight"
            :centerBox="option.centerBox"
            :fixed="option.fixed"
            :fixedNumber="option.fixedNumber"
            :fixedBox="option.fixedBox"
            :canMove="option.canMove"
          ></vueCropper>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn depressed color="#f6bf00" class="white--text" @click="cropImage()">決定</v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import { VueCropper } from 'vue-cropper';

export default {
  components: {
    VueCropper,
  },
  props: {
    noChangeCropRatio: Boolean, // アスペクト比の変更許可
    ratioX: String, // 横の比
    ratioY: String, // 縦の比
  },
  data: function () {
    return {
      areaColor: '#ffffff', // ドロップエリアの背景色
      preview: '', // プレビュー用の画像データ
      cropperDialog: false, // トリミングダイアログの制御
      image: '', // トリミング前の画像データ（入力ファイル）
      option: {
        // vue-cropperの設定
        size: 1,
        outputType: 'jpeg',
        autoCrop: true,
        autoCropWidth: 1024,
        autoCropHeight: 1024,
        centerBox: true,
        fixed: this.noChangeCropRatio,
        fixedNumber: [this.ratioX, this.ratioY],
        fixedBox: false,
        canMove: true,
      },
    };
  },
  methods: {
    /**
     * 画像の入力
     */
    inputImage: function () {
      this.areaColor = '#ffffff';
      this.cropperDialog = true;

      const files = event.target.files ? event.target.files : event.dataTransfer.files;
      const file = files[0];

      // TODO: バリデーション作成の必要あり
      //   if (!/\.(gif|jpg|jpeg|png|bmp|GIF|JPG|PNG)$/.test(event.target.value)) {
      //     alert("画像の形式ではありません！");
      //     return false;
      //   }

      var reader = new FileReader();
      reader.onload = (event) => {
        this.image = window.URL.createObjectURL(new Blob([event.target.result]));
      };

      reader.readAsArrayBuffer(file);
    },

    /**
     * 画像のトリミング
     */
    cropImage: function () {
      this.cropperDialog = false;

      // プレビューデータの用意
      this.$refs.cropper.getCropData((data) => {
        this.preview = data;
      });

      // 投稿データの用意
      this.$refs.cropper.getCropBlob((data) => {
        this.$emit('input', data);
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import '~/_variables';

.vue-cropper {
  width: 500px;
  height: 500px;
  margin: 10px auto;
}
</style>
