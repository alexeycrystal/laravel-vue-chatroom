import Vue from 'vue';
import VueRouter from 'vue-router';

import ChatLog from '../components/ChatLog';

Vue.use(VueRouter);

const router =  new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/chat',
            name: 'home',
            component: ChatLog,
        }
    ]
});

export default router;