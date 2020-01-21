require('./bootstrap');
require('./admin');
// require('swal')
window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import VueRouter from 'vue-router'
import VueSilentbox from 'vue-silentbox';
import VeeValidate, { Validator } from 'vee-validate';
import uk from 'vee-validate/dist/locale/uk';
import Vuelidate from 'vuelidate';

Vue.config.productionTip = false;

Validator.localize('uk', uk);


Vue.use(VueRouter);
Vue.use(Vuelidate);
Vue.use(VueSilentbox);
Vue.use(VeeValidate, {
    locale: 'uk',
});

import NewStatementComponent from './components/NewStatementComponent';
import RemovedStatementComponent from './components/RemovedStatementComponent';

import ListParticipantsComponent from './components/ListParticipantsComponent';
import EvaluationResultsComponent from './components/EvaluationResultsComponent';

import ProfileComponent from './components/ProfileComponent';

import MasterClassComponent from './components/admin/MasterClassComponent';
import UsersMessagesComponent from './components/admin/UsersMessagesComponent';

// Адмін
import VideoGalleryComponent from './components/admin/VideoGalleryComponent';
import FotoGalleryComponent from './components/admin/FotoGalleryComponent';
import MainInformationComponent from './components/admin/MainInformationComponent';
import QuestionComponent from './components/admin/QuestionComponent';

//Журі
import AllStatementComponent from './components/jury/AllStatementComponent';
import EvaluationComponent from './components/jury/EvaluationComponent';
import JuryEvaluationComponent from './components/jury/JuryEvaluationComponent';

//Супер адмін
import AddJuryComponent from './components/superAdmin/AddJuryComponent';
import AddToOrgCommitteeComponent from './components/superAdmin/AddToOrgCommitteeComponent';
import AddAdminOrgCommitteeComponent from './components/superAdmin/AddAdminOrgCommitteeComponent';
import PeriodComponent from './components/superAdmin/PeriodComponent';

const router = new VueRouter({
    mode: 'history',
    routes: [
        // {
        //     path: '/admin',
        //     name: 'home',
        //     component: NewStatementComponent
        // },
        {
            path: '/admin/profile/:id',
            name: 'profile',
            component: ProfileComponent,
        },
        {
            path: '/admin/all-statements',
            name: 'jury-all-statements',
            component: AllStatementComponent,
        },
        {
            path: '/admin/all-statements/:id',
            name: 'jury-evaluation',
            component: EvaluationComponent,
        },
        {
            path: '/admin/jury-evaluation',
            name: 'jury-evaluation-available',
            component: JuryEvaluationComponent,
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
        JuryEvaluationComponent,
        VideoGalleryComponent,
        FotoGalleryComponent,
        MainInformationComponent,
        AllStatementComponent,
        AddJuryComponent,
        AddToOrgCommitteeComponent,
        AddAdminOrgCommitteeComponent,
        QuestionComponent,
        PeriodComponent,
        ProfileComponent,
        MasterClassComponent,
        UsersMessagesComponent
    },
    router
});





