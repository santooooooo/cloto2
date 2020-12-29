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
const contact = '/api/contact';
const preRegister = '/api/preregister';
const register = '/api/register';
const login = '/api/login';
const logout = '/api/logout';
const setOnline = '/api/online';
const authUser = '/api/auth/user';
const authPeerId = '/api/auth/peer_id';
const userShow = '/api/user/' + replaceChar[0];
const profileUpdate = '/api/user/update';
const getUserByPeerId = '/api/user/get_user_by_peer_id/' + replaceChar[0];
const roomIndex = '/api/room';
const roomShow = '/api/room/' + replaceChar[0];
const seatSit = '/api/seat/sit/' + replaceChar[0];
const seatLeave = '/api/seat/leave';
const enterLounge = '/api/seat/enterlounge/' + replaceChar[0];
const leaveLounge = '/api/seat/leavelounge/' + replaceChar[0];
const projectIndex = '/api/project';
const projectPost = '/api/project/post';
const taskIndex = '/api/task/index/' + replaceChar[0];
const taskPost = '/api/task/post';
const taskStart = '/api/task/start';
const karteIndexByAuthUser = '/api/karte/index_by_auth_user';
const karteIndexByTaskId = '/api/karte/index_by_task_id/' + replaceChar[0];
const kartePost = '/api/karte/post';
const technologyIndex = '/api/technology';
const inquiryShow = '/api/inquiry';
const inquiryPost = '/api/inquiry/post';

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
    case 'contact':
      endpoint = contact;
      break;

    case 'preRegister':
      endpoint = preRegister;
      break;

    case 'register':
      endpoint = register;
      break;

    case 'login':
      endpoint = login;
      break;

    case 'logout':
      endpoint = logout;
      break;

    case 'setOnline':
      endpoint = setOnline;
      break;

    case 'authUser':
      endpoint = authUser;
      break;

    case 'authPeerId':
      endpoint = authPeerId;
      break;

    case 'userShow':
      endpoint = setParams(userShow, params);
      break;

    case 'profileUpdate':
      endpoint = profileUpdate;
      break;

    case 'getUserByPeerId':
      endpoint = setParams(getUserByPeerId, params);
      break;

    case 'roomIndex':
      endpoint = roomIndex;
      break;

    case 'roomShow':
      endpoint = setParams(roomShow, params);
      break;

    case 'seatSit':
      endpoint = setParams(seatSit, params);
      break;

    case 'seatLeave':
      endpoint = seatLeave;
      break;

    case 'enterLounge':
      endpoint = setParams(enterLounge, params);
      break;

    case 'leaveLounge':
      endpoint = setParams(leaveLounge, params);
      break;

    case 'projectIndex':
      endpoint = projectIndex;
      break;

    case 'projectPost':
      endpoint = projectPost;
      break;

    case 'taskIndex':
      endpoint = setParams(taskIndex, params);
      break;

    case 'taskPost':
      endpoint = taskPost;
      break;

    case 'taskStart':
      endpoint = taskStart;
      break;

    case 'karteIndexByAuthUser':
      endpoint = karteIndexByAuthUser;
      break;

    case 'karteIndexByTaskId':
      endpoint = setParams(karteIndexByTaskId, params);
      break;

    case 'kartePost':
      endpoint = kartePost;
      break;

    case 'technologyIndex':
      endpoint = technologyIndex;
      break;

    case 'inquiryShow':
      endpoint = inquiryShow;
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
