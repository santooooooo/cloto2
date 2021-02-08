const axios = require('axios');

export async function post(username, icon, message) {
  var data = `payload={
    'channel': '${process.env.MIX_SLACK_CHANNEL}',
    'username':'${username}',
    'icon_emoji':'${icon}',
    'text': '${message}'
    }`;

  var param = {
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    },
  };

  try {
    if (window.location.hostname === 'cloto.jp') {
      await axios.post(process.env.MIX_SLACK_URL, data, param);
    }
  } catch (error) {
    // 通知に失敗しても続行（Slackの障害時など）
  }
}
