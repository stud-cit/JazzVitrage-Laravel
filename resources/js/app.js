require('./bootstrap');
require('./admin');
// require('swal')
window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import VueRouter from 'vue-router'

Vue.use(VueRouter);

import NewStatementComponent from './components/NewStatementComponent';
import RemovedStatementComponent from './components/RemovedStatementComponent';

import ListParticipantsComponent from './components/ListParticipantsComponent';
import EvaluationResultsComponent from './components/EvaluationResultsComponent';

import VideoGalleryComponent from './components/admin/VideoGalleryComponent';
import AllStatementComponent from './components/jury/AllStatementComponent';
import EvaluationComponent from './components/jury/EvaluationComponent';

const router = new VueRouter({
    mode: 'history',
    routes: [
        // {
        //     path: '/admin',
        //     name: 'home',
        //     component: NewStatementComponent
        // },
        {
            path: '/admin/all-statements',
            name: 'jury-all-statements',
            component: AllStatementComponent,
        },
        {
            path: '/admin/all-statements/evaluation/:id',
            name: 'jury-evaluation',
            component: EvaluationComponent,
        },
    ],
});


const app = new Vue({
    el: '#app',
    components: {
        NewStatementComponent,
        RemovedStatementComponent,
        ListParticipantsComponent,
        EvaluationResultsComponent,
        EvaluationComponent,
        VideoGalleryComponent,
        AllStatementComponent
    },
    router,
});





