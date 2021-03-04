/**
 * ディレクトリパスの取得：this.$storage('ディレクトリ名');
 */

/**
 * ディレクトリ一覧
 */
const SYSTEM = '/storage/system/';
const ROOM = '/storage/system/room/';
const SEAT = '/storage/system/room/seat/';
const MEDIA = '/storage/system/room/media/';
const ICON = '/storage/user/icon/';
const KARTE = '/storage/user/karte/';

/**
 * パスの取得
 *
 * @param {String} name - 取得するディレクトリ
 * @return {String} ディレクトリのパス
 */
export function getStoragePath(name) {
  var path = '';
  switch (name) {
    case 'system':
      path = SYSTEM;
      break;

    case 'room':
      path = ROOM;
      break;

    case 'seat':
      path = SEAT;
      break;

    case 'media':
      path = MEDIA;
      break;

    case 'icon':
      path = ICON;
      break;
  }

  return path;
}

/**
 * カルテデータパスの取得
 *
 * @param {Object} karte - 取得するカルテ
 * @param {String} username - ユーザー名
 * @return {String} ディレクトリのパス
 */
export function getKartePath(karte, username) {
  // 日時を取得
  var dateTime = new Date(karte.created_at);

  // 年を取得
  var year = String(dateTime.getFullYear());

  // 2桁で月を取得
  var month = String(dateTime.getMonth() + 1);
  if (month.length === 1) {
    month = '0' + month;
  }

  // 2桁で日にちを取得
  var day = String(dateTime.getDate());
  if (day.length === 1) {
    day = '0' + day;
  }

  // 2桁で時間を取得
  var hour = String(dateTime.getHours());
  if (hour.length === 1) {
    hour = '0' + hour;
  }

  // 2桁で分数を取得
  var minute = String(dateTime.getMinutes());
  if (minute.length === 1) {
    minute = '0' + minute;
  }

  var date = year + '_' + month + day;
  var time = hour + minute;

  return KARTE + username + '/' + date + '_' + time + '/';
}
