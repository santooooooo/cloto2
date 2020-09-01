/**
 * エンドポイントの取得：this.$endpoint('エンドポイント名', ['パラメータ1', 'パラメータ2', 'パラメータ3']);
 */

/**
 * パラメータ置換用の記号
 */
const replaceChar = ["#", "*", "$"];

/**
 * API一覧
 */
const home = "/";
const POST_login = "/api/login";
const POST_logout = "/api/logout";
const GET_AuthUser = "/api/auth";
const GET_userShow = "/api/user/" + replaceChar[0];
const POST_profileUpdate = "/api/user/update";

/**
 * エンドポイントの取得
 *
 * @param {String} name 取得するエンドポイント名
 * @param {Array} params 必要なパラメータ
 * @return {String} エンドポイント
 */
export function getEndpoint(name, params) {
    var endpoint = "";
    switch (name) {
        case "home":
            endpoint = home;
            break;

        case "POST:login":
            endpoint = POST_login;
            break;

        case "POST:logout":
            endpoint = POST_logout;
            break;

        case "GET:AuthUser":
            endpoint = GET_AuthUser;
            break;

        case "GET:userShow":
            endpoint = setParams(GET_userShow, params);
            break;

        case "POST:profileUpdate":
            endpoint = POST_profileUpdate;
            break;
    }

    return endpoint;
}

/**
 * パラメータの置換
 *
 * @param {String} url 置換前のURL
 * @param {Array} params 置換するパラメータ
 * @return {String} 置換したURL
 */
export function setParams(url, params) {
    var endpoint = "";
    switch (params.length) {
        case 1:
            endpoint = url.replace(replaceChar[0], params[0]);
            break;
        case 2:
            endpoint = url
                .replace(replaceChar[0], params[0])
                .replace(replaceChar[1], params[1]);
            break;
        case 3:
            endpoint = url
                .replace(replaceChar[0], params[0])
                .replace(replaceChar[2], params[2])
                .replace(replaceChar[2], params[2]);
            break;
    }

    return endpoint;
}
