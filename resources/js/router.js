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
import terms from '@/views/service/Terms';
import login from '@/views/Login';
import home from '@/views/home/Home';
import timeline from '@/views/home/Timeline';
import floor from '@/views/home/Floor';
import room from '@/views/room/Room';
import mypage from '@/views/mypage/Mypage';
import profile from '@/views/mypage/Profile';
import follower from '@/views/mypage/Follower';
import post from '@/views/mypage/Post';
import mystudy from '@/views/mystudy/Mystudy';
import progress from '@/views/mystudy/Progress';
import karte from '@/views/mystudy/Karte';
import docs from '@/views/mystudy/docs/Docs';
import sample from '@/views/mystudy/docs/Sample';
import javascript0 from '@/views/mystudy/docs/javascript/Class0';
import javascript1 from '@/views/mystudy/docs/javascript/Class1';
import javascript2 from '@/views/mystudy/docs/javascript/Class2';
import javascript3 from '@/views/mystudy/docs/javascript/Class3';
import javascript4 from '@/views/mystudy/docs/javascript/Class4';
import javascript5 from '@/views/mystudy/docs/javascript/Class5';
import javascript6 from '@/views/mystudy/docs/javascript/Class6';
import javascript7 from '@/views/mystudy/docs/javascript/Class7';
import javascript8 from '@/views/mystudy/docs/javascript/Class8';
import javascript9 from '@/views/mystudy/docs/javascript/Class9';
import javascript10 from '@/views/mystudy/docs/javascript/Class10';
import notFound from '@/views/errors/NotFound';

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'index',
      component: index,
      meta: { isPublic: true },
    },
    {
      path: '/terms',
      name: 'terms',
      component: terms,
      meta: { isPublic: true },
    },
    {
      path: '/login',
      name: 'login',
      component: login,
      meta: { isPublic: true },
    },
    {
      path: '/home',
      component: home,
      children: [
        {
          path: 'timeline',
          name: 'home',
          component: timeline,
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
          path: 'followers',
          name: 'followers',
          component: follower,
        },
        {
          path: 'post',
          name: 'post',
          component: post,
        },
      ],
    },
    {
      path: '/mystudy',
      component: mystudy,
      children: [
        {
          path: 'progress',
          name: 'mystudy',
          component: progress,
        },
        {
          path: 'karte',
          name: 'karte',
          component: karte,
        },
        {
          path: 'docs',
          component: docs,
          children: [
            {
              path: 'sample',
              name: 'sample',
              component: sample,
            },
            {
              path: 'javascript/class-0',
              name: 'javascript-0',
              component: javascript0,
            },
            {
              path: 'javascript/class-1',
              name: 'javascript-1',
              component: javascript1,
            },
            {
              path: 'javascript/class-2',
              name: 'javascript-2',
              component: javascript2,
            },
            {
              path: 'javascript/class-3',
              name: 'javascript-3',
              component: javascript3,
            },
            {
              path: 'javascript/class-4',
              name: 'javascript-4',
              component: javascript4,
            },
            {
              path: 'javascript/class-5',
              name: 'javascript-5',
              component: javascript5,
            },
            {
              path: 'javascript/class-6',
              name: 'javascript-6',
              component: javascript6,
            },
            {
              path: 'javascript/class-7',
              name: 'javascript-7',
              component: javascript7,
            },
            {
              path: 'javascript/class-8',
              name: 'javascript-8',
              component: javascript8,
            },
            {
              path: 'javascript/class-9',
              name: 'javascript-9',
              component: javascript9,
            },
            {
              path: 'javascript/class-10',
              name: 'javascript-10',
              component: javascript10,
            },
          ],
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
  // ログイン状態の更新
  await store.dispatch('auth/syncAuthUser');

  if (!store.getters['auth/check'] && to.matched.some((record) => !record.meta.isPublic)) {
    // 未ログイン時のリダイレクト
    next({ name: 'login' });
  }

  if (store.getters['auth/check'] && store.getters['auth/user'].email_verified_at === null) {
    // 未認証時のリダイレクト
    window.location.pathname = '/email/verify';
  }

  if (store.getters['auth/check'] && to.name === 'login') {
    // ログイン時のリダイレクト
    next({ name: 'home' });
  }

  next();
});

export default router;
