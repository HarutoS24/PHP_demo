import { createRouter, createWebHistory } from "vue-router";

import kintai from "@/components/kintai.vue";
import profile from "@/components/profile.vue";

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