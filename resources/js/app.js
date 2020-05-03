/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import App from './App.vue';

import axios from 'axios';
import VueAxios from 'vue-axios';

Vue.use(VueAxios, axios);
axios.defaults.baseURL = 'https://rss.diggital.co.ke/api/v1';

// VueRouter
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// sweetalert
import swal from 'sweetalert2';

window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;
window.Fire = new Vue();

let routes = [
    {
        path: '/', component: require('./components/Home.vue').default, meta: {
            plainLayout: 1,
        },
    },
    {
        path: '/register', component: require('./components/Auth/Register.vue').default, meta: {
            plainLayout: 1,
            auth: false
        }
    },
    {
        path: '/login', component: require('./components/Auth/Login.vue').default, meta: {
            plainLayout: 1,
            auth: false
        }
    },
    {
        path: '/dashboard/vacancies', component: require('./components/Admin/Vacancy.vue').default, meta: {
            plainLayout: 2,
            auth: {
                roles: 'admin'
            }
        }
    },
    {
        path: '/dashboard/vacancies/:vacancyId', component: require('./components/Admin/VacancyDetails.vue').default, meta: {
            plainLayout: 2,
            auth: {
                roles: 'admin'
            }
        }
    },
    {
        path: '/dashboard', component: require('./components/Admin/Index.vue').default, meta: {
            plainLayout: 2,
            auth: {
                roles: 'admin'
            }
        }
    },
    {
        path: '/vacancies', component: require('./components/User/Vacancy.vue').default, meta: {
            plainLayout: 1,
            auth: true
        }
    },
    {
        path: '/vacancies/:vacancyId', component: require('./components/Admin/VacancyDetails.vue').default, meta: {
            plainLayout: 1,
            auth: true
        }
    },
];

const router = new VueRouter({
    mode: 'history',
    routes,
    hashbang: false,
    linkActiveClass: "active",
    scrollBehavior (to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return { x: 0, y: 0 }
        }
    }
})
router.mode = "html5";

//vue-good-table
import VueGoodTablePlugin from 'vue-good-table/src';
import 'vue-good-table/dist/vue-good-table.css'
Vue.use(VueGoodTablePlugin);


// websanova
Vue.router = router;

Vue.use(require('@websanova/vue-auth'), {
    auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
    http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
    router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
    rolesVar: "role",
    tokenStore: ["localStorage", "cookie"]
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    render: app => app(App)
});
