import { createRouter, createWebHistory } from "vue-router";

import pageA from "@/test/pageA.vue";
import pageB from "@/test/pageB.vue";

const routes = [
    {
        path: '/pageA',
        name: 'pageA',
        component: pageA,
    },
    {
        path: '/pageB',
        name: 'pageB',
        component: pageB,
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router