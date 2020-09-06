/**
 * ルーティングの取得方法
 * <router-link :to="{ name: 'user', params: { userId: 123 }}">User</router-link>
 * this.$router.push({ name: 'user', params: { userId: 123 }});
 * let path = this.$router.resolve({ name: 'user', params: { userId: 123 }}).href;
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import home from '@/views/front/Layout.vue';
import welcome from '@/views/front/Welcome.vue';
import register from '@/views/front/Register.vue';
import login from '@/views/front/Login.vue';
import SystemError from '@/views/errors/System.vue';
import userPage from '@/views/user/UserPage.vue';
import profileEdit from '@/views/user/ProfileEdit.vue';

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      component: home,
      children: [
        {
          path: '',
          name: 'home',
          component: welcome,
        },
        {
          path: 'register',
          name: 'register',
          component: register,
        },
        {
          path: 'login',
          name: 'login',
          component: login,
        },
      ],
    },
    {
      path: '/500',
      component: SystemError,
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

export default router;
