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

import index from '@/views/Index';
import concept from '@/views/service/Concept';
import product from '@/views/service/Product';
import news from '@/views/service/News';
import company from '@/views/service/Company';
import contact from '@/views/service/Contact';
import terms from '@/views/service/Terms';
import preRegister from '@/views/auth/PreRegister';
import register from '@/views/auth/Register';
import login from '@/views/auth/Login';
import home from '@/views/Home';
import mypage from '@/views/mypage/Mypage';
import profile from '@/views/mypage/Profile';
import karte from '@/views/mypage/Karte';
import entrance from '@/views/entrance/Entrance';
import information from '@/views/entrance/Information';
import floor from '@/views/entrance/Floor';
import room from '@/views/room/Room';
import notFound from '@/views/errors/NotFound';

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'index',
      component: index,
      meta: { isPublic: true },
      children: [
        {
          path: 'preregister',
          name: 'preRegister',
          component: preRegister,
          meta: { isPublic: true },
        },
        {
          path: 'register',
          name: 'register',
          component: register,
          meta: { isPublic: true },
        },
        {
          path: 'login',
          name: 'login',
          component: login,
          meta: { isPublic: true },
        },
      ],
    },
    {
      path: '/concept',
      name: 'concept',
      component: concept,
      meta: { isPublic: true },
    },
    {
      path: '/product',
      name: 'product',
      component: product,
      meta: { isPublic: true },
    },
    {
      path: '/news',
      name: 'news',
      component: news,
      meta: { isPublic: true },
    },
    {
      path: '/company',
      name: 'company',
      component: company,
      meta: { isPublic: true },
    },
    {
      path: '/contact',
      name: 'contact',
      component: contact,
      meta: { isPublic: true },
    },
    {
      path: '/terms',
      name: 'terms',
      component: terms,
      meta: { isPublic: true },
    },
    {
      path: '/home',
      name: 'home',
      component: home,
    },
    {
      path: '/entrance',
      component: entrance,
      children: [
        {
          path: 'information',
          name: 'entrance',
          component: information,
        },
        {
          path: 'floor/:roomId',
          name: 'floor',
          component: floor,
        },
      ],
    },
    {
      path: '/room/:roomId',
      name: 'room',
      component: room,
    },
    {
      path: '/mypage',
      component: mypage,
      children: [
        {
          path: 'profile',
          name: 'mypage',
          component: profile,
        },
        {
          path: 'karte',
          name: 'karte',
          component: karte,
        },
      ],
    },
    {
      path: '*',
      name: notFound,
      component: notFound,
      meta: { isPublic: true },
    },
  ],
});

router.beforeEach(async (to, from, next) => {
  // 公開停止時のリダイレクト
  if (
    process.env.MIX_APP_RELEASE === 'false' &&
    to.matched.some((record) => !record.meta.isPublic)
  ) {
    next({ name: 'index' });
  }

  // ログイン状態の更新
  await store.dispatch('auth/syncAuthUser');

  if (!store.getters['auth/check'] && to.matched.some((record) => !record.meta.isPublic)) {
    // 未ログイン時のリダイレクト
    next({ name: 'login' });
  } else if (store.getters['auth/check'] && (to.name === 'register' || to.name === 'login')) {
    // ログイン時のリダイレクト
    next({ name: 'entrance' });
  } else {
    next();
  }
});

export default router;
