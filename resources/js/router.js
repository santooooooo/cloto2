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

import index from '@/views/front/Index.vue';
import preRegister from '@/views/front/PreRegister.vue';
import register from '@/views/front/Register.vue';
import login from '@/views/front/Login.vue';
import systemError from '@/views/errors/System.vue';
import home from '@/views/front/Home.vue';
import userPage from '@/views/user/UserPage.vue';
import profileEdit from '@/views/user/ProfileEdit.vue';
import room from '@/views/front/Room.vue';

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
          meta: { isPublic: !Number(process.env.MIX_APP_RELEASE) },
        },
        {
          path: 'register',
          name: 'register',
          component: register,
          meta: { isPublic: Number(process.env.MIX_APP_RELEASE) },
        },
        {
          path: 'login',
          name: 'login',
          component: login,
          meta: { isPublic: Number(process.env.MIX_APP_RELEASE) },
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
      path: '/room/:id',
      name: 'room',
      component: room,
    },
    {
      path: '/user/:username',
      name: 'userPage',
      component: userPage,
    },
    {
      path: '/user/:username/edit',
      name: 'profileEdit',
      component: profileEdit,
    },
  ],
});

router.beforeEach((to, from, next) => {
  // 未ログイン時のリダイレクト
  if (!store.getters['auth/check'] && to.matched.some((record) => !record.meta.isPublic)) {
    if (Number(process.env.MIX_APP_RELEASE)) {
      next({ name: 'login' });
    } else {
      next({ name: 'preRegister' });
    }
  } else {
    next();
  }
});

export default router;
