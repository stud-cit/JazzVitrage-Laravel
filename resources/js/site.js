require('./bootstrap');


import Vue from 'vue';
// import BootstrapVue from "bootstrap-vue";
// import "bootstrap/dist/css/bootstrap.css";
// import "bootstrap-vue/dist/bootstrap-vue.css";


import HeaderComponent from './components/site/HeaderComponent';
import FooterComponent from './components/site/FooterComponent';
import Index from './components/site/IndexComponent';
import MembersList from './components/site/MembersListComponent';
import Application from './components/site/ApplicationComponent';
import Gallery from './components/site/GalleryComponent';
import GalleryYear from './components/site/GalleryYearComponent';
import VideoGallery from './components/site/VideoGalleryComponent';
import VideoGalleryYear from './components/site/VideoGalleryYearComponent';
import Gymn from './components/site/GymnComponent';
import Jury from './components/site/JuryComponent';
import JuryMember from './components/site/JuryMemberComponent';
import OrganizationCommittee from './components/site/OrganizationCommitteeComponent';
import PositionComponent from './components/site/PositionComponent';
import NewHead from './components/site/NewHead';
import MasterMainComponent from './components/site/MasterMainComponent';

import Error404 from './components/site/Error404';

import VueRouter from 'vue-router';

Vue.use(VueRouter);
// Vue.use(BootstrapVue);

import VueSilentbox from 'vue-silentbox';
Vue.use(VueSilentbox);

import VeeValidate, { Validator } from 'vee-validate';
import uk from 'vee-validate/dist/locale/uk';

Validator.localize('uk', uk);
Vue.use(VeeValidate, {
    locale: 'uk',
});

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
            path: '/gallery/:id/',
            name: 'gallery-year',
            component: GalleryYear,
        },
        {
            path: '/gallery-video',
            name: 'gallery-video',
            component: VideoGallery,
        },
        {
            path: '/gallery-video/:id/',
            name: 'gallery-video-year',
            component: VideoGalleryYear,
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
        },
        {
            path: '/position',
            name: 'position',
            component: PositionComponent,
        },
        {
            path: '/nhead',
            name: 'nhead',
            component: NewHead,
        },
        {
            path: '/master',
            name: 'master',
            component: MasterMainComponent,
        },
        {
            path: '*',
            name: 'error',
            component: Error404,
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
        VideoGallery,
        VideoGalleryYear,
        Gymn,
        Jury,
        JuryMember,
        OrganizationCommittee,
        PositionComponent,
        HeaderComponent,
        FooterComponent,
        NewHead
    },
    router
});


