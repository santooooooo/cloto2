import VueRouter from "vue-router";

import index from "@/components/views/front/index.vue";
import register from "@/components/views/front/register.vue";
import login from "@/components/views/front/login.vue";

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
