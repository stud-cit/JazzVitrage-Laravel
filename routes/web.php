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

    Route::get('/removed-statements', ['as' => 'admin.orgСommittee.removedStatements', function () {
        return view('admin.orgСommittee.removedStatements');
    }]);

    Route::get('/list-participants', ['as' => 'admin.orgСommittee.listParticipants', function () {
        return view('admin.orgСommittee.listParticipants');
    }]);

    Route::get('/evaluation-results', ['as' => 'admin.orgСommittee.evaluationResults', function () {
        return view('admin.orgСommittee.evaluationResults');
    }]);
    // Route::get('get-members', ['as' => 'admin.orgСommittee.evaluationResults', function () {
    //     return view('admin.orgСommittee.evaluationResults');
    // }]);

// });
// Auth::routes();