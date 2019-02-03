import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";


const ApiService = {
    init() {
        Vue.use(VueAxios, axios);
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        let token = document.head.querySelector('meta[name="csrf-token"]');
        if (token) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        } else {
            console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
        }
    },
    get(resource, slug = "") {
        return Vue.axios.get(`${resource}/${slug}`).catch(error => {
            throw new Error(`[RWV] ApiService ${error}`);
        });
    },
    post(resource, params) {
        return Vue.axios.post(`${resource}`, params).catch(error => {
            throw new Error(`[RWV] ApiService ${error}`);
        });
    },
};

export default ApiService;