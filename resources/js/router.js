/**
 * ルーティングの取得方法
 * <router-link :to="{ name: 'user', params: { userId: 123 }}">User</router-link>
 * this.$router.push({ name: 'user', params: { userId: 123 }});
 * let path = this.$router.resolve({ name: 'user', params: { userId: 123 }}).href;
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

function isRelease() {
  return process.env.MIX_APP_RELEASE === 'true' ? true : false;
}

import store from './store';

import index from '@/views/Index';
import preRegister from '@/views/auth/PreRegister';
import register from '@/views/auth/Register';
import login from '@/views/auth/Login';
import systemError from '@/views/errors/System';
import home from '@/views/Home';
import mypage from '@/views/mypage/Mypage';
import profile from '@/views/mypage/Profile';
import karte from '@/views/mypage/Karte';
import entrance from '@/views/entrance/Entrance';
import information from '@/views/entrance/Information';
import floor from '@/views/entrance/Floor';
import room from '@/views/room/Room';
import notFound from "@/views/errors/NotFound";

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
          meta: { isPublic: !isRelease() },
        },
        {
          path: 'register',
          name: 'register',
          component: register,
          meta: { isPublic: isRelease() },
        },
        {
          path: 'login',
          name: 'login',
          component: login,
          meta: { isPublic: isRelease() },
        },
      ],
    },
    {
      path: '/500',
      name: 'INTERNAL_SERVER_ERROR',
      component: systemError,
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
      path: "*",
      name: notFound,
      component: notFound
    }
  ],
});

// router.beforeEach((to, from, next) => {
//   // 未ログイン時のリダイレクト
//   if (!store.getters['auth/check'] && to.matched.some((record) => !record.meta.isPublic)) {
//     if (isRelease()) {
//       next({ name: 'login' });
//     } else {
//       next({ name: 'preRegister' });
//     }
//   } else {
//     next();
//   }
// });

export default router;
