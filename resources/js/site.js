require('./bootstrap');


import Vue from 'vue';


import HeaderComponent from './components/site/HeaderComponent';
import FooterComponent from './components/site/FooterComponent';
import Index from './components/site/IndexComponent';
import MembersList from './components/site/MembersListComponent';
import Application from './components/site/ApplicationComponent';
import Gallery from './components/site/GalleryComponent';
import GalleryYear from './components/site/GalleryYearComponent';
import Gymn from './components/site/GymnComponent';
import Jury from './components/site/JuryComponent';
import JuryMember from './components/site/JuryMemberComponent';
import OrganizationCommittee from './components/site/OrganizationCommitteeComponent';

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
        {
            path: '/gallery',
            name: 'gallery',
            component: Gallery,
        },
        {
            path: '/gallery/:id',
            name: 'gallery-year',
            component: GalleryYear,
        },
        {

            path: '/gymn',
            name: 'gymn',
            component: Gymn,
        },
        {
            path: '/applications',
            name: 'applications',
            component: Application,
        },
        {
            path: '/juries',
            name: 'juries',
            component: Jury,

        },
        {
            path: '/juries/:id/',
            name: 'jury-member',
            component: JuryMember,
        },
        {
            path: '/organization-committee',
            name: 'organization-committee',
            component: OrganizationCommittee,
        }
    ],
});

const app = new Vue({
    el: '#site-app',
    components: {
        Index,
        MembersList,
        Application,
        Gallery,
        GalleryYear,
        Gymn,
        Jury,
        JuryMember,
        OrganizationCommittee,
        HeaderComponent,
        FooterComponent,
    },
    router
});


