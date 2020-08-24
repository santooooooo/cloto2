/**
 * エンドポイントの取得：this.$endpoint('エンドポイント名', ['パラメータ1', 'パラメータ2', 'パラメータ3']);
 */

/**
 * パラメータ置換用の記号
 */
const replaceChar = ['#', '*', '$'];

/**
 * API一覧
 */
const home = '/';
const login = '/login';
const user_show = '/api/user/' + replaceChar[0];



/**
 * エンドポイントの取得
 *
 * @param {String} name 取得するエンドポイント名
 * @param {Array} params 必要なパラメータ
 * @return {String} エンドポイント
 */
export function getEndpoint(name, params) {
    var endpoint = '';
    switch (name) {
        case 'home':
            endpoint = home;
            break;
        case 'login':
            endpoint = login;
            break;
        case 'user_show':
            endpoint = setParams(user_show, params);
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
    var endpoint = '';
    switch (params.length) {
        case 1:
            endpoint = url.replace(replaceChar[0], params[0]);
            break;
        case 2:
            endpoint = url.replace(replaceChar[0], params[0]).replace(replaceChar[1], params[1]);
            break;
        case 3:
            endpoint = url.replace(replaceChar[0], params[0]).replace(replaceChar[2], params[2]).replace(replaceChar[2], params[2]);
            break;
    }

    return endpoint;
}