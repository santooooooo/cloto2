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
import user from '@/admin/views/User';
import room from '@/admin/views/Room';
import seat from '@/admin/views/Seat';
import tag from '@/admin/views/Tag';
import notFound from '@/admin/views/errors/NotFound';

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/admin',
      name: 'home',
      component: home,
    },
    {
      path: '/admin/inquiry',
      name: 'inquiry',
      component: inquiry,
    },
    {
      path: '/admin/user',
      name: 'user',
      component: user,
    },
    {
      path: '/admin/room',
      name: 'room',
      component: room,
    },
    {
      path: '/admin/seat',
      name: 'seat',
      component: seat,
    },
    {
      path: '/admin/tag',
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
    // 未ログイン時のリダイレクト（Laravel側でもリダイレクトしているため不要？）
    window.location.pathname = '/admin/login';
  } else {
    next();
  }
});

export default router;
