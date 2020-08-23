import Vue from "vue";
import VueRouter from "vue-router";
Vue.use(VueRouter);

import index from "@/components/front/index.vue";
import register from "@/components/front/register.vue";
import login from "@/components/front/login.vue";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "index",
            component: index
        },
        {
            path: "/register",
            name: "register",
            component: register
        },
        {
            path: "/login",
            name: "login",
            component: login
        },
        {
            path: "/course/all",
            name: "course_all",
            component: index
        }
    ]
});

export default router;
