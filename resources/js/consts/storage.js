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
const DOCS = '/storage/system/docs/';

/**
 * パスの取得
 *
 * @param {String} name - 取得するディレクトリ
 * @return {String} ディレクトリのパス
 */
export function getStoragePath(name) {
  let path;
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
 * コンテンツデータのパスの取得
 *
 * @param {String} content - 取得するコンテンツ
 * @param {String} page - 取得するページ
 * @return {String} ディレクトリのパス
 */
export function getDocsPath(content, page) {
  return DOCS + content + '/' + page + '/';
}
