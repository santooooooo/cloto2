/**
 * いろんな定数
 *
 * @constructor
 */
export const Valid = 0;
export const InValid = 1;
export const Empty = -1;
export const TooShort = -2;
export const TooLong = -3;



/**
 * フォームのクラスの取得
 *
 * @param {Number} status
 * @return {String} 適用するクラス
 */
export function getFormClass(status) {
    switch (status) {
        case Empty:
            return '';
        case Valid:
            return 'is-valid';
        default:
            return 'is-invalid';
    }
}


/**
 * フォーム全体のエラーチェック
 *
 * @param {Array} statuses ステータス配列
 * @return {Number} エラーが存在しなければ 0
 */
export function validErrors(statuses) {
    if (statuses.every(status => status === Valid)) {
        return Valid;
    } else {
        return InValid;
    }
}


/**
 * ユーザー名チェック
 *
 * @param {String} username 入力値
 * @return {Number} 正規表現にマッチかつ長さが正しければ 0
 */
export function validUserName(username) {
    const MIN = 4;
    const MAX = 16;

    // 英字を最低1文字含める(ユーザーIDとの区別がつかなくなるため)
    const reg = /^(?=.*?[A-Za-z])[A-Za-z\d_]+$/;
    if (reg.test(username)) {
        if (username.length < MIN) {
            return TooShort;
        } else if (MAX < username.length) {
            return TooLong;
        } else {
            return Valid;
        }
    } else {
        return InValid;
    }
}


/**
 * Eメールチェック
 *
 * @param {String} email 入力値
 * @return {Number} 正規表現にマッチすれば 0
 */
export function validEmail(email) {
    if (email === null || email === undefined) return null;
    const reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (reg.test(email)) {
        return Valid;
    } else {
        return InValid;
    }
}


/**
 * パスワードチェック
 *
 * @param {String} password 入力値
 * @return {Number} 正規表現にマッチかつ長さが正しければ 0
 */
export function validPassword(password) {
    const MIN = 8;
    const MAX = 64;

    const reg = /^[a-zA-Z0-9!-/:-@¥[-`{-~]+$/;
    if (reg.test(password)) {
        if (password.length < MIN) {
            return TooShort;
        } else if (MAX < password.length) {
            return TooLong;
        } else {
            return Valid;
        }
    } else {
        return InValid;
    }
}


/**
 * パスワード再確認チェック
 *
 * @param {String} password 初回入力値
 * @param {String} passwordConfirmation 再確認入力値
 * @return {Number} 一致すれば 0
 */
export function validPasswordConfirmation(password, passwordConfirmation) {
    if (validPassword(password) === Valid) {
        // 有効なパスワードが入力されている場合

        if (password === passwordConfirmation) {
            // 一致すれば 0
            return Valid;
        } else {
            return InValid;
        }
    } else {
        // パスワードが無効な場合
        return Empty;
    }
}


/**
 * 表示名チェック
 *
 * @param {String} handlename 入力値
 * @return {Number} 正規表現にマッチかつ長さが正しければ 0
 */
export function validHandleName(handlename) {
    const MIN = 1;
    const MAX = 20;

    const reg = /^[a-zａ-ｚA-ZＡ-Ｚ0-9０-９ぁ-んァ-ヶ一-龠!?！？,，、.．。@＠~～ー_-]+$/u;
    if (reg.test(handlename)) {
        if (handlename.length < MIN) {
            return TooShort;
        } else if (MAX < handlename.length) {
            return TooLong;
        } else {
            return Valid;
        }
    } else {
        return InValid;
    }
}


/**
 * アプリケーション起動系チェック
 *
 * @param {String} path 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function isExternal(path) {
    return /^(https?:|mailto:|tel:)/.test(path);
}


/**
 * URLチェック
 *
 * @param {String} url 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validURL(url) {
    const reg = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
    return reg.test(url);
}


/**
 * 小文字チェック
 *
 * @param {String} str 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validLowerCase(str) {
    const reg = /^[a-z]+$/;
    return reg.test(str);
}


/**
 * 大文字チェック
 *
 * @param {String} str 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validUpperCase(str) {
    const reg = /^[A-Z]+$/;
    return reg.test(str);
}


/**
 * 英字チェック
 *
 * @param {String} str 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validAlphabets(str) {
    const reg = /^[A-Za-z]+$/;
    return reg.test(str);
}


/**
 * かな文字チェック
 *
 * @param {String} text 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validKana(text) {
    if (text === null || text === undefined) return null;
    const reg = /^[\ｦ-ﾟ\u30a0-\u30ff]+$/;
    return reg.test(text);
}


/**
 * 文字のみチェック
 *
 * @param {String} text 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validText(text) {
    if (text === null || text === undefined) return null;
    const reg = /^[\A-Za-z\Ａ-Ｚａ-ｚ\ｦ-ﾟ\u30a0-\u30ff\u3040-\u309f\u3005-\u3006\u30e0-\u9fcf]+$/;
    return reg.test(text);
}


/**
 * 数字チェック
 *
 * @param {String} data 入力値
 * @param {Number} length 長さ
 * @return {Boolean} 正規表現にマッチかつ長さが正しければtrue
 */
export function validNumber(data, length) {
    if (data === null || data === undefined) return null;
    const reg = /^[0-9]+$/;
    return reg.test(data) && data.length === length;
}


/**
 * 郵便番号チェック
 *
 * @param {String} postal 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validPostal(postal) {
    if (postal === null || postal === undefined) return null;
    const reg = /^[0-9]{3}-?[0-9]{4}$/;
    return reg.test(postal);
}


/**
 * 電話番号チェック
 *
 * @param {String} tel 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */
export function validTel(tel) {
    if (tel === null || tel === undefined) return null;
    const reg = /^[0-9]{3}-?[0-9]{3,4}-?[0-9]{3,4}$/;
    return reg.test(tel);
}
