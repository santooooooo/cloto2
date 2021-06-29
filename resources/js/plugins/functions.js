/**
 * 文字列の整形（エスケープ処理+URLのセット）
 *
 * @param {String} str - 整形する文字列
 * @return {String} 整形後の文字列
 */
export function formatStr(str) {
  const url = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;

  return String(str)
    .replace(/"/g, '&quot;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(url, '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>');
}

/**
 * ステータスの色の取得
 *
 * @param {String} status - ステータス
 * @return {String} 色
 */
export function statusColor(status) {
  let color;
  switch (status) {
    case 'free':
      color = 'green';
      break;

    case 'busy':
      color = 'red';
      break;

    case 'away':
      color = 'grey';
      break;
  }

  return color;
}

/**
 * 期の取得
 *
 * @param {Number} classNumber - クラス番号
 * @param {Boolean} show - 画面表示用か
 * @return {String} 期
 */
export function periodName(classNumber, show = false) {
  let name;
  if (classNumber === 0) {
    name = show ? '入門期' : 'introduction';
  } else if (1 <= classNumber && classNumber <= 3) {
    name = show ? '素人期' : 'beginner';
  } else if (4 <= classNumber && classNumber <= 6) {
    name = show ? '苦労人前期' : 'intermediate';
  } else if (7 <= classNumber && classNumber <= 10) {
    name = show ? '苦労人後期' : 'advanced';
  } else if (11 <= classNumber) {
    name = show ? '玄人期' : 'expert';
  }

  return name;
}

/**
 * 期の色の取得
 *
 * @param {String} period - 期
 * @return {String} 色
 */
export function periodColor(period) {
  let color;
  switch (period) {
    case 'introduction':
      color = '#42a5f5';
      break;

    case 'beginner':
      color = '#0d47a1';
      break;

    case 'intermediate':
      color = '#4caf50';
      break;

    case 'advanced':
      color = '#ff9800';
      break;

    case 'expert':
      color = '#f44336';
      break;

    default:
      color = '#9e9e9e';
      break;
  }

  return color;
}

/**
 * クラスの色の取得
 *
 * @param {Number} classNumber - クラス番号
 * @return {String} 色
 */
export function classColor(classNumber) {
  let color;
  switch (classNumber) {
    case 0:
      color = '#42a5f5';
      break;

    case 1:
      color = '#5c93e6';
      break;

    case 2:
      color = '#2e77e6';
      break;

    case 3:
      color = '#0d47a1';
      break;

    case 4:
      color = '#00b050';
      break;

    case 5:
      color = '#70ad47';
      break;

    case 6:
      color = '#92d050';
      break;

    case 7:
      color = '#ccc900';
      break;

    case 8:
      color = '#e6bd45';
      break;

    case 9:
      color = '#ffcc33';
      break;

    case 10:
      color = '#ffc000';
      break;

    case 11:
      color = '#f44336';
      break;

    default:
      color = '#9e9e9e';
      break;
  }

  return color;
}

/**
 * Slack通知
 *
 * @param {String} username - 投稿するユーザー名
 * @param {String} icon - 投稿時のアイコン
 * @param {String} message - 通知の内容
 */
export function slackPost(username, icon, message) {
  // 本番環境でのみ通知
  if (process.env.MIX_APP_DEBUG === 'false') {
    let data = {
      channel: process.env.MIX_SLACK_CHANNEL,
      username: username,
      icon_emoji: icon,
      text: message,
    };

    // AxiosではCORSエラーが発生する
    const xml = new XMLHttpRequest();
    xml.open('POST', process.env.MIX_SLACK_URL);
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xml.send(JSON.stringify(data));
  }
}
