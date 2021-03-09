let e, flowChat;

flowChat = (function () {
  function flowChat(params) {
    this.timer = null;
    this.interval = null;
    this.fps = 1000 / 30;
    this.step = 2 * 1000;
    this.comments = [];
    this.app = params.app;
    this.fontSize = params.fontSize || 50;
    this.color = params.color || '#fff';
    this.width = params.width || 500;
    this.height = params.height || 300;

    // 描画
    this.render();
  }

  /**
   * 描画
   */
  flowChat.prototype.render = function () {
    this.app.style.whiteSpace = 'nowrap';
    this.app.style.overflow = 'hidden';
    this.app.style.position = 'relative';
    this.app.style.width = this.width + 'px';
    this.app.style.height = this.height + 'px';
  };

  /**
   * サイズ変更
   *
   * @param {Number} width - 幅
   * @param {Number} height - 高さ
   */
  flowChat.prototype.resize = function (width, height) {
    this.width = width;
    this.height = height;
    this.app.style.width = this.width + 'px';
    return (this.app.style.height = this.height + 'px');
  };

  /**
   * コメントを送信
   *
   * @param {String} text - コメント
   * @param {String} color - 色[option]
   * @param {String} fontSize - フォントサイズ[option]
   */
  flowChat.prototype.send = function (text, color, fontSize) {
    let ele, x, y;
    fontSize = fontSize || this.fontSize;
    color = color || this.color;
    text = text || '';
    x = this.width;
    y = Math.random() * (this.height - this.fontSize);
    ele = document.createElement('div');
    ele.innerHTML = text;
    ele.style.position = 'absolute';
    ele.style.left = x + 'px';
    ele.style.top = y + 'px';
    ele.style.fontSize = fontSize + 'px';
    ele.style.textShadow = '0 0 5px #111';
    ele.style.color = color;
    this.app.appendChild(ele);
    return this.comments.push({
      ele: ele,
      x: x,
      y: y,
    });
  };

  /**
   * コメントを流す
   */
  flowChat.prototype.flow = function () {
    let end, i, j, len, ref, results;
    len = this.comments.length;
    results = [];
    for (i = j = 0, ref = len; 0 <= ref ? j < ref : j > ref; i = 0 <= ref ? ++j : --j) {
      end = this.comments[i].ele.getBoundingClientRect().width * -1;
      if (this.comments[i].x > end) {
        this.comments[i].x -= 4;
        results.push((this.comments[i].ele.style.left = this.comments[i].x + 'px'));
      } else {
        results.push(void 0);
      }
    }
    return results;
  };

  /**
   * コメントを待機
   */
  flowChat.prototype.listen = function () {
    this.stop();
    return (this.timer = setInterval(
      (function (_this) {
        return function () {
          return _this.flow();
        };
      })(this),
      this.fps
    ));
  };

  /**
   * 特定のコメントを流し続ける
   *
   * @param {Array} comments - コメントが入った配列
   */
  flowChat.prototype.loop = function (comments) {
    let i, len;
    i = 0;
    len = comments.length;
    this.listen();
    this.send(comments[i++]);
    return (this.interval = setInterval(
      (function (_this) {
        return function () {
          if (len < i) {
            i = 0;
          }
          return _this.send(comments[i++]);
        };
      })(this),
      this.step
    ));
  };

  /**
   * アニメーション停止
   */
  flowChat.prototype.stop = function () {
    clearInterval(this.timer);
    return clearInterval(this.interval);
  };

  return flowChat;
})();

try {
  module.exports = flowChat;
} catch (_error) {
  e = _error;
}
