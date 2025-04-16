import { createRouter, createWebHistory } from "vue-router";

import kintai from "@/views/kintai.vue";
import profile from "@/views/profile.vue";

const routes = [
    {
        path: '/profile',
        name: 'profile',
        component: profile,
    },
    {
        path: '/kintai',
        name: 'kintai',
        component: kintai,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router