require('./bootstrap');


import Vue from 'vue';


import HeaderComponent from './components/site/HeaderComponent';
import FooterComponent from './components/site/FooterComponent';
import Index from './components/site/IndexComponent';
import MembersList from './components/site/MembersListComponent';

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
        {
            path: '/members',
            name: 'members',
            component: MembersList,
        },
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
        MembersList,
        HeaderComponent,
        FooterComponent
    },
    router
});


