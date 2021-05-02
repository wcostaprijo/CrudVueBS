require('./bootstrap');

window.Vue = require('vue');

import App from './components/layouts/App.vue';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';
import axios from 'axios';
import { routes } from './routes';
import { VueMaskDirective } from 'v-mask';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);

Vue.directive('mask', VueMaskDirective);

const router = new VueRouter({
    mode: 'history',
    routes: routes
});
 
const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
});
