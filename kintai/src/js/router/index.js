import { createRouter, createWebHistory } from "vue-router";

import kintai_calendar from "@/views/kintai_calendar.vue";
import Kintai_register from "@/views/kintai_register.vue";
import profile from "@/views/profile.vue";

const routes = [
    {
        path: '/profile',
        name: 'profile',
        component: profile,
    },
    {
        path: '/kintai_calendar',
        name: 'kintai_calendar',
        component: kintai_calendar,
    },
    {
        path: '/kintai_register',
        name: 'kintai_register',
        component: Kintai_register
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router