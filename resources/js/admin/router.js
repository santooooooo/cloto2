/**
 * ルーティングの取得方法
 * <router-link :to="{ name: 'user', params: { userId: 123 }}">User</router-link>
 * this.$router.push({ name: 'user', params: { userId: 123 }});
 * let path = this.$router.resolve({ name: 'user', params: { userId: 123 }}).href;
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import home from '@/admin/views/Home';
import notFound from '@/admin/views/errors/NotFound';

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/admin',
      name: 'home',
      component: home,
    },
  ],
});

export default router;
