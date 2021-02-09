export function post(username, icon, message) {
  // 本番サーバのみ通知
  if (window.location.hostname === 'cloto.jp') {
    var data = {
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
