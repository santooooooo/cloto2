/**
 * ルーティングの取得方法
 * <router-link :to="{ name: 'user', params: { userId: 123 }}">User</router-link>
 * this.$router.push({ name: 'user', params: { userId: 123 }});
 * let path = this.$router.resolve({ name: 'user', params: { userId: 123 }}).href;
 */


import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

import home from "@/components/front/layout.vue";
import welcome from "@/components/front/welcome.vue";
import register from "@/components/front/register.vue";
import login from "@/components/front/login.vue";
import userPage from "@/components/user/userPage.vue";
import profileEdit from "@/components/user/profileEdit.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            component: home,
            children: [
                {
                    path: "",
                    name: "home",
                    component: welcome
                },
                {
                    path: "register",
                    name: "register",
                    component: register
                },
                {
                    path: "login",
                    name: "login",
                    component: login
                }
            ]
        },
        {
            path: "/user/:username",
            name: "userPage",
            component: userPage
        },
        {
            path: "/user/:username/edit",
            name: "profileEdit",
            component: profileEdit
        },
    ]
});

export default router;
