/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/tools/validate.js":
/*!****************************************!*\
  !*** ./resources/js/tools/validate.js ***!
  \****************************************/
/*! exports provided: Valid, InValid, Empty, TooShort, TooLong, getFormClass, validErrors, validUserName, validEmail, validPassword, validPasswordConfirmation, validHandleName, isExternal, validURL, validLowerCase, validUpperCase, validAlphabets, validKana, validText, validNumber, validPostal, validTel */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Valid", function() { return Valid; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "InValid", function() { return InValid; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Empty", function() { return Empty; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TooShort", function() { return TooShort; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "TooLong", function() { return TooLong; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "getFormClass", function() { return getFormClass; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validErrors", function() { return validErrors; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validUserName", function() { return validUserName; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validEmail", function() { return validEmail; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validPassword", function() { return validPassword; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validPasswordConfirmation", function() { return validPasswordConfirmation; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validHandleName", function() { return validHandleName; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "isExternal", function() { return isExternal; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validURL", function() { return validURL; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validLowerCase", function() { return validLowerCase; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validUpperCase", function() { return validUpperCase; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validAlphabets", function() { return validAlphabets; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validKana", function() { return validKana; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validText", function() { return validText; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validNumber", function() { return validNumber; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validPostal", function() { return validPostal; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "validTel", function() { return validTel; });
/**
 * いろんな定数
 *
 * @constructor
 */
var Valid = 0;
var InValid = 1;
var Empty = -1;
var TooShort = -2;
var TooLong = -3;
/**
 * フォームのクラスの取得
 *
 * @param {Number} status
 * @return {String} 適用するクラス
 */

function getFormClass(status) {
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

function validErrors(statuses) {
  if (statuses.every(function (status) {
    return status === Valid;
  })) {
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

function validUserName(username) {
  var MIN = 4;
  var MAX = 16; // 英字を最低1文字含める(ユーザーIDとの区別がつかなくなるため)

  var reg = /^(?=.*?[A-Za-z])[A-Za-z\d_]+$/;

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

function validEmail(email) {
  if (email === null || email === undefined) return null;
  var reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

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

function validPassword(password) {
  var MIN = 8;
  var MAX = 64;
  var reg = /^[a-zA-Z0-9!-/:-@¥[-`{-~]+$/;

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

function validPasswordConfirmation(password, passwordConfirmation) {
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

function validHandleName(handlename) {
  var MIN = 1;
  var MAX = 20;
  var reg = /^[!,-\.0-9\?-Z_a-z~\u3001\u3002\u3041-\u3093\u30A1-\u30F6\u30FC\u4E00-\u9FA0\uFF01\uFF0C\uFF0E\uFF10-\uFF19\uFF1F-\uFF3A\uFF41-\uFF5A\uFF5E]+$/;

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

function isExternal(path) {
  return /^(https?:|mailto:|tel:)/.test(path);
}
/**
 * URLチェック
 *
 * @param {String} url 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validURL(url) {
  var reg = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
  return reg.test(url);
}
/**
 * 小文字チェック
 *
 * @param {String} str 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validLowerCase(str) {
  var reg = /^[a-z]+$/;
  return reg.test(str);
}
/**
 * 大文字チェック
 *
 * @param {String} str 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validUpperCase(str) {
  var reg = /^[A-Z]+$/;
  return reg.test(str);
}
/**
 * 英字チェック
 *
 * @param {String} str 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validAlphabets(str) {
  var reg = /^[A-Za-z]+$/;
  return reg.test(str);
}
/**
 * かな文字チェック
 *
 * @param {String} text 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validKana(text) {
  if (text === null || text === undefined) return null;
  var reg = /^[\ｦ-ﾟ\u30a0-\u30ff]+$/;
  return reg.test(text);
}
/**
 * 文字のみチェック
 *
 * @param {String} text 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validText(text) {
  if (text === null || text === undefined) return null;
  var reg = /^[\A-Za-z\Ａ-Ｚａ-ｚ\ｦ-ﾟ\u30a0-\u30ff\u3040-\u309f\u3005-\u3006\u30e0-\u9fcf]+$/;
  return reg.test(text);
}
/**
 * 数字チェック
 *
 * @param {String} data 入力値
 * @param {Number} length 長さ
 * @return {Boolean} 正規表現にマッチかつ長さが正しければtrue
 */

function validNumber(data, length) {
  if (data === null || data === undefined) return null;
  var reg = /^[0-9]+$/;
  return reg.test(data) && data.length === length;
}
/**
 * 郵便番号チェック
 *
 * @param {String} postal 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validPostal(postal) {
  if (postal === null || postal === undefined) return null;
  var reg = /^[0-9]{3}-?[0-9]{4}$/;
  return reg.test(postal);
}
/**
 * 電話番号チェック
 *
 * @param {String} tel 入力値
 * @return {Boolean} 正規表現にマッチすればtrue
 */

function validTel(tel) {
  if (tel === null || tel === undefined) return null;
  var reg = /^[0-9]{3}-?[0-9]{3,4}-?[0-9]{3,4}$/;
  return reg.test(tel);
}

/***/ }),

/***/ 1:
/*!**********************************************!*\
  !*** multi ./resources/js/tools/validate.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/atsuhiro/GitHub/CLOTO/resources/js/tools/validate.js */"./resources/js/tools/validate.js");


/***/ })

/******/ });