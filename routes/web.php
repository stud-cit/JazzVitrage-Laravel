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
//Положення
Route::get('/position', 'PositionController@position');
//Контакти
Route::get('/jury', 'ContactsController@jury');
Route::get('/organizing-committee', 'ContactsController@organizingCommittee');


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
    // VUE запросы
    Route::post('post-foto', 'GalleryController@postFoto');
    Route::post('delete-foto/{id}/', 'GalleryController@deleteFoto');

    Route::post('post-video', 'GalleryController@postVideo');
    Route::post('delete-video/{id}/', 'GalleryController@deleteVideo');

    Route::post('post-info', 'InfoController@postInfo');
    Route::post('post-info-file', 'InfoController@postInfoFile');
    Route::post('post-contact', 'InfoController@postContact');
    Route::post('delete-contact/{id}/', 'InfoController@deleteContact');
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
    Route::get('get-video', 'GalleryController@getVideo');

    Route::get('get-members',  'ApplicationController@getMembers');

    Route::get('get-all-members',  'ApplicationController@getAllMembers');

    Route::get('get-member/{id}/',  'ApplicationController@getMember');

    Route::post('archive-members/{id}/',  'ApplicationController@archiveMembers');

    Route::post('unarchive-members/{id}/',  'ApplicationController@unarchiveMembers');

    Route::post('delete-members/{id}/',  'ApplicationController@deleteMembers');


    Route::get('/{any}', ['as' => 'site', function () {
        return view('layouts.site.index');
    }])->where('any', '.*');

