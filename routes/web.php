<?php
//Головна
Route::get('/', 'SiteController@index')->name('site');
Route::get('/application', 'ApplicationController@index');
Route::post('/application', 'ApplicationController@store');
//Конкурс
Route::get('/list-participants', 'СompetitionController@listParticipants');
Route::get('/hymn', 'СompetitionController@hymn');
//Галерея
Route::get('/video-gallery', 'GalleryController@videoGallery');
Route::get('/festival', 'GalleryController@festival');
Route::get('/jazz-workshop', 'GalleryController@jazzWorkshop');
//Контакти
Route::get('get-jurys-view', 'ContactsController@getJurys');
Route::get('get-jury-view/{id}/', 'ContactsController@jury');
Route::get('get-org-view', 'ContactsController@organizingCommittee');


// Админка

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', function () {
        return view('admin.home');
    });
});
// Роль Адмін
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/video-gallery', function () {
        return view('admin.admin.videoGallery');
    });
    Route::get('/admin/foto-gallery', function () {
        return view('admin.admin.fotoGallery');
    });
    Route::get('/admin/main-information', function () {
        return view('admin.admin.mainInformation');
    });
    Route::get('/admin/question', function () {
        return view('admin.admin.question');
    });
    // VUE запросы
    Route::post('post-foto', 'GalleryController@postFoto');
    Route::post('delete-foto/{id}/', 'GalleryController@deleteFoto');

    Route::post('post-video', 'GalleryController@postVideo');
    Route::post('delete-video/{id}/', 'GalleryController@deleteVideo');

    Route::get('get-question', 'QuestionController@getQuestion');
    Route::post('delete-question/{id}/', 'QuestionController@deleteQuestion');

    Route::post('post-contact', 'InfoController@postContact');
    Route::post('delete-contact/{id}/', 'InfoController@deleteContact');

    Route::post('post-info', 'InfoController@postInfo');
    Route::post('post-info-file', 'InfoController@postInfoFile');

    Route::post('post-quote', 'InfoController@postQuote');
    Route::post('put-quote', 'InfoController@putQuote');
    Route::post('delete-quote/{id}/', 'InfoController@deleteQuote');
});

// Роль Орг.Комітет
Route::group(['middleware' => ['auth', 'role:orgComittee']], function () {
    Route::get('/admin/new-statements', function () {
        return view('admin.orgСommittee.newStatements');
    });
    Route::get('/admin/removed-statements', function () {
        return view('admin.orgСommittee.removedStatements');
    });
    Route::get('/admin/list-participants', function () {
        return view('admin.orgСommittee.listParticipants');
    });
    Route::get('/admin/evaluation-results', function () {
        return view('admin.orgСommittee.evaluationResults');
    });
});

// Роль Журі
Route::group(['middleware' => ['auth', 'role:jury']], function () {
    Route::get('/admin/information', function () {
        return view('admin.jury.information');
    });
    Route::get('/admin/all-statements', function () {
        return view('admin.jury.allStatements');
    });
     Route::get('/admin/all-statements/{any}', function () {
         return view('admin.jury.allStatements');
     })->where('any', '[0-9]');
});

// Роль Супер Адмін
Route::group(['middleware' => ['auth', 'role:superAdmin']], function () {
    Route::get('/admin/add-jury', function () {
        return view('admin.superAdmin.addJury');
    });
    Route::get('/admin/add-to-org-committee', function () {
        return view('admin.superAdmin.addToOrgCommittee');
    });
    Route::get('/admin/add-admin-org-committee', function () {
        return view('admin.superAdmin.addAdminOrgCommittee');
    });
    // VUE запросы
    Route::get('get-all-jury', 'UserController@getAllJury');
    Route::get('get-all-org', 'UserController@getAllOrg');
    Route::get('get-all-admin-org', 'UserController@getAllAdmin');
    Route::post('post-all-jury', 'UserController@postJury');
    Route::post('post-all-org', 'UserController@postOrg');
    Route::post('post-all-admin', 'UserController@postAdmin');
    Route::post('update-jury/{id}/', 'UserController@updateJury');
    Route::post('update-org/{id}/', 'UserController@updateOrg');
    Route::post('update-admin/{id}/', 'UserController@updateAdmin');
    Route::post('delete-user/{id}/', 'UserController@deleteUser');
});
// Загальна інформація
Route::post('post-all-info', 'InfoController@postAllInfo');
Auth::routes();

// VUE запросы

    Route::get('get-all-info', 'InfoController@getAllInfo');

    Route::get('get-foto', 'GalleryController@getFoto');
    Route::get('get-foto/{year}/', 'GalleryController@getFotoYear');
    Route::get('get-video', 'GalleryController@getVideo');
    Route::get('get-video/{year}/', 'GalleryController@getVideoYear');
    Route::get('get-quotes', 'InfoController@getQuotes');

    Route::get('get-members',  'ApplicationController@getMembers');
    Route::get('get-nominations',  'ApplicationController@getNominations');

    Route::get('get-all-members',  'ApplicationController@getAllMembers');

    Route::get('get-member/{id}/',  'ApplicationController@getMember');

    Route::post('archive-members/{id}/',  'ApplicationController@archiveMembers');

    Route::post('send-app',  'ApplicationController@postApp');
    Route::post('unarchive-members/{id}/',  'ApplicationController@unarchiveMembers');

    Route::post('delete-members/{id}/',  'ApplicationController@deleteMembers');
    Route::post('post-question', 'QuestionController@postQuestion');

    Route::get('/{any}', ['as' => 'site', function () {
        return view('layouts.site.index');
    }])->where('any', '.*');

