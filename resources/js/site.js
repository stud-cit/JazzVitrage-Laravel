require('./bootstrap');


import Vue from 'vue';



import Index from './components/site/IndexComponent';

import VueRouter from 'vue-router';

Vue.use(VueRouter);


Vue.config.delimiters = ['${', '}'];

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },
        // {
        //     path: '/admin/all-statements',
        //     name: 'jury-all-statements',
        //     component: AllStatementComponent,
        // },
        // {
        //     path: '/admin/all-statements/:id',
        //     name: 'jury-evaluation',
        //     component: EvaluationComponent,
        // },
    ],
});

const app = new Vue({
    el: '#site-app',
    components: {
        Index,
    },
    router
});


