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

    Route::get('/admin', ['as' => 'admin.newStatements', function () {
        return view('admin.newStatements');
    }]);

    Route::get('/removed-statements', ['as' => 'admin.removedStatements', function () {
        return view('admin.removedStatements');
    }]);

    Route::get('/list-participants', ['as' => 'admin.listParticipants', function () {
        return view('admin.listParticipants');
    }]);

    Route::get('/evaluation-results', ['as' => 'admin.evaluationResults', function () {
        return view('admin.evaluationResults');
    }]);

// });
// Auth::routes();