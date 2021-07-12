/**
 * ルーティングの取得方法
 * <router-link :to="{ name: 'user', params: { userId: 123 }}">User</router-link>
 * this.$router.push({ name: 'user', params: { userId: 123 }});
 * let path = this.$router.resolve({ name: 'user', params: { userId: 123 }}).href;
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import store from './store';

import home from '@/admin/views/Home';
import inquiry from '@/admin/views/Inquiry';
import admin from '@/admin/views/setting/Admin';
import mail from '@/admin/views/user/Mail';
import user from '@/admin/views/user/User';
import karte from '@/admin/views/user/Karte';
import room from '@/admin/views/room/Room';
import seat from '@/admin/views/room/Seat';
import media from '@/admin/views/room/Media';
import tag from '@/admin/views/Tag';
import notFound from '@/admin/views/errors/NotFound';

const router = new VueRouter({
  mode: 'history',
  base: '/admin',
  routes: [
    {
      path: '/',
      name: 'home',
      component: home,
    },
    {
      path: '/inquiry',
      name: 'inquiry',
      component: inquiry,
    },
    {
      path: '/setting/account',
      name: 'admin',
      component: admin,
    },
    {
      path: '/user/mail',
      name: 'mail',
      component: mail,
    },
    {
      path: '/user/account',
      name: 'user',
      component: user,
    },
    {
      path: '/user/karte',
      name: 'karte',
      component: karte,
    },
    {
      path: '/room',
      name: 'room',
      component: room,
    },
    {
      path: '/room/seat',
      name: 'seat',
      component: seat,
    },
    {
      path: '/room/media',
      name: 'media',
      component: media,
    },
    {
      path: '/tag',
      name: 'tag',
      component: tag,
    },
    {
      path: '*',
      name: notFound,
      component: notFound,
    },
  ],
});

router.beforeEach(async (to, from, next) => {
  // ログイン状態の更新
  await store.dispatch('auth/syncAuthUser');

  if (!store.getters['auth/check']) {
    // 未ログイン時のリダイレクト（Laravel側でもリダイレクトしているが念の為）
    window.location.pathname = '/admin/login';
  }

  next();
});

export default router;
