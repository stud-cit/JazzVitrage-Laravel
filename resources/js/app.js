require('./bootstrap');
require('./admin');
// require('swal')
window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import NewStatementComponent from './components/NewStatementComponent';
import RemovedStatementComponent from './components/RemovedStatementComponent';

import ListParticipantsComponent from './components/ListParticipantsComponent';
import EvaluationResultsComponent from './components/EvaluationResultsComponent';
import EvaluationComponent from './components/EvaluationComponent';
import AllStatementsComponent from './components/AllStatementsComponent';

import VideoGalleryComponent from './components/admin/VideoGalleryComponent';

const app = new Vue({
    el: '#app',
    components: {
    	NewStatementComponent,
        RemovedStatementComponent,
        ListParticipantsComponent,
        EvaluationResultsComponent,
        EvaluationComponent,
        AllStatementsComponent,
        VideoGalleryComponent
    }
});





