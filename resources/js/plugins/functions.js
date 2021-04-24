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
 * ステータス色の取得
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
 * Slack通知
 *
 * @param {String} username - 投稿するユーザー名
 * @param {String} icon - 投稿時のアイコン
 * @param {String} message - 通知の内容
 */
export function slackPost(username, icon, message) {
  // 本番サーバでのみ通知
  if (window.location.hostname === 'cloto.jp') {
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
