/**
 * Vueコンポーネントの定義
 */

/**
 * 定義サンプル
 *
 * ID保持のElementが存在する場合のみ定義(Warning回避)
 * if (document.getElementById("id")) {
 *      new Vue({
 *          el: "#id",
 *          components: {
 *              "name": require("./components/file.vue").default
 *          }
 *      });
 * }
 *
 * Class保持のElementが存在する場合のみ定義(Warning回避)
 * ページ内に複数組み込み可能
 * if (document.getElementsByClassName("class").length) {
 *      const elementList = document.querySelectorAll(".class");
 *
 *      elementList.forEach((el, i) => {
 *          new Vue({
 *              el: el, // 取得したElementに割り当て
 *              components: {
 *                  "name": require("./components/file.vue").default
 *              }
 *          });
 *      });
 * }
 */

import router from "./router";

// 新規登録，ログイン画面
if (document.getElementById("welcome-form")) {
    new Vue({
        el: "#welcome-form",
        router: router
    });
}