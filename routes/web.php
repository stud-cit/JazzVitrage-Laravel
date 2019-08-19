<?php

//Головна
Route::get('/', 'HomeController@index');


Route::get('/application', 'ApplicationController@index');
Route::post('/application', 'ApplicationController@store');

//Конкурс
Route::get('/list-participants', 'СompetitionController@listParticipants');
Route::get('/hymn', 'СompetitionController@hymn');

//Галерея
Route::get('/video-gallery', 'GalleryController@videoGallery');
Route::get('/festival', 'GalleryController@festival');
Route::get('/jazz-workshop', 'GalleryController@jazzWorkshop');

//Положення
Route::get('/position', 'PositionController@position');

//Контакти
Route::get('/jury', 'ContactsController@jury');
Route::get('/organizing-committee', 'ContactsController@organizingCommittee');


//Админка
// Route::group(['middleware' => 'auth'], function () {

    Route::get('/admin', ['as' => 'admin.orgСommittee.newStatements', function () {
        return view('admin.orgСommittee.newStatements');
    }]);

    Route::get('/admin/removed-statements', ['as' => 'admin.orgСommittee.removedStatements', function () {
        return view('admin.orgСommittee.removedStatements');
    }]);

    Route::get('/admin/list-participants', ['as' => 'admin.orgСommittee.listParticipants', function () {
        return view('admin.orgСommittee.listParticipants');
    }]);

    Route::get('/admin/evaluation-results', ['as' => 'admin.orgСommittee.evaluationResults', function () {
        return view('admin.orgСommittee.evaluationResults');
    }]);


    Route::get('/admin/evaluation', ['as' => 'admin.jury.evaluation', function () {
        return view('admin.jury.evaluation');
    }]);

    Route::get('/admin/all-statements', ['as' => 'admin.jury.allStatements', function () {
        return view('admin.jury.allStatements');
    }]);

    Route::get('/admin/information', ['as' => 'admin.jury.information', function () {
        return view('admin.jury.information');
    }]);

    Route::get('/admin/video-gallery', ['as' => 'admin.admin.videoGallery', function () {
        return view('admin.admin.videoGallery');
    }]);
// VUE запросы
 Route::get('get-members',  'ApplicationController@getMembers');
 Route::get('get-all-members',  'ApplicationController@getAllMembers');
 Route::post('archive-members/{id}/',  'ApplicationController@archiveMembers');
// });
// Auth::routes();