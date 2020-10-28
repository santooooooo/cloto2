/**
 * ディレクトリパスの取得：this.$storage('ディレクトリ名');
 */

/**
 * ディレクトリ一覧
 */
const system = '/storage/system/';
const icon = '/storage/user/icon/';
const karte = '/storage/user/karte/';

/**
 * パスの取得
 *
 * @param {String} name 取得するディレクトリ
 * @return {String} ディレクトリのパス
 */
export function getStoragePath(name) {
  var path = '';
  switch (name) {
    case 'system':
      path = system;
      break;

    case 'icon':
      path = icon;
      break;

    case 'karte':
      path = karte;
      break;
  }

  return path;
}
