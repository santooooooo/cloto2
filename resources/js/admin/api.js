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
const logout = '/api/admin/logout';
const authUser = '/api/admin/auth';
const users = '/api/admin/users';
const userUpdate = '/api/admin/user/update/' + replaceChar[0];
const rooms = '/api/admin/rooms';
const roomUpdate = '/api/admin/room/update/' + replaceChar[0];
const seatUpdate = '/api/admin/seat/update/' + replaceChar[0];
const inquiries = '/api/admin/inquiries';
const inquiryShow = '/api/admin/inquiry/' + replaceChar[0];
const inquiryPost = '/api/admin/inquiry/post';

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
    case 'logout':
      endpoint = logout;
      break;

    case 'authUser':
      endpoint = authUser;
      break;

    case 'users':
      endpoint = users;
      break;

    case 'userUpdate':
      endpoint = setParams(userUpdate, params);
      break;

    case 'rooms':
      endpoint = rooms;
      break;

    case 'roomUpdate':
      endpoint = setParams(roomUpdate, params);
      break;

    case 'seatUpdate':
      endpoint = setParams(seatUpdate, params);
      break;

    case 'inquiries':
      endpoint = inquiries;
      break;

    case 'inquiryShow':
      endpoint = setParams(inquiryShow, params);
      break;

    case 'inquiryPost':
      endpoint = inquiryPost;
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
      endpoint = url
        .replace(replaceChar[0], params[0])
        .replace(replaceChar[2], params[2])
        .replace(replaceChar[2], params[2]);
      break;
  }

  return endpoint;
}
