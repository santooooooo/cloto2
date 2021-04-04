const Storage = require('@/consts/storage').getStoragePath;

// 通知音オン
const onSound = new Audio(Storage('system') + 'sound_on.mp3');
onSound.volume = 0.6;
// 通知音オフ
const offSound = new Audio(Storage('system') + 'sound_off.mp3');
offSound.volume = 0.6;
// アナウンス
const announceSound = new Audio(Storage('system') + 'announce.mp3');
announceSound.volume = 0.6;
// 問い合わせの受信
const receiveInquirySound = new Audio(Storage('system') + 'receive_inquiry.mp3');
receiveInquirySound.volume = 1.0;
// ログイン
const loginSound = new Audio(Storage('system') + 'login.mp3');
loginSound.volume = 0.6;
// 通話の参加
const joinCallSound = new Audio(Storage('system') + 'join_call.mp3');
joinCallSound.volume = 0.6;
// 通話の退出
const leaveCallSound = new Audio(Storage('system') + 'leave_call.mp3');
leaveCallSound.volume = 0.6;
// メッセージの受信
const receiveMessageSound = new Audio(Storage('system') + 'receive_message.mp3');
receiveMessageSound.volume = 0.6;

export const ON_SOUND = onSound;
export const OFF_SOUND = offSound;
export const ANNOUNCE_SOUND = announceSound;
export const RECEIVE_INQUIRY_SOUND = receiveInquirySound;
export const LOGIN_SOUND = loginSound;
export const JOIN_CALL_SOUND = joinCallSound;
export const LEAVE_CALL_SOUND = leaveCallSound;
export const RECEIVE_MESSAGE_SOUND = receiveMessageSound;
