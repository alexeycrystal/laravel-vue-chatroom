window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

import Vue from 'vue';
import App from './App';

import router from './router';
import store from './store';

import broadcast from './broadcast'

import ApiService from './api/api.service';

broadcast.initEcho();

ApiService.init();

const app = new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#globalChat');
