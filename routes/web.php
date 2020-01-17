<?php
use App\Models\Period;
//Головна
Route::get('/', 'SiteController@index')->name('site');
Route::get('/application', 'ApplicationController@index');
Route::post('/application', 'ApplicationController@store');
//Конкурс
// Route::get('/list-participants', 'СompetitionController@listParticipants');
// Route::get('/hymn', 'СompetitionController@hymn');
//Галерея
Route::get('/video-gallery', 'GalleryController@videoGallery');
Route::get('/festival', 'GalleryController@festival');
Route::get('/jazz-workshop', 'GalleryController@jazzWorkshop');
//Контакти
Route::get('get-jurys-view', 'ContactsController@getJurys');
Route::get('get-jury-view/{id}/', 'ContactsController@jury');
Route::get('get-org-view', 'ContactsController@organizingCommittee');
//Положення
// Route::get('/position', 'PositionController@position');
//Контакти
// Route::get('/jury', 'ContactsController@jury');
// Route::get('/organizing-committee', 'ContactsController@organizingCommittee');



// Админка

Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', function () {
        return view('admin.home');
    })->name('admin');

    // Юзеры

    Route::get('/admin/profile/{id}', 'UserController@pageProfile');
    Route::get('/user/{id}', 'UserController@getUserId');
    Route::post('/user/{id}', 'UserController@updateUser');
    Route::post('/check-passwrod-user/{id}', 'UserController@checkPasswordUser');

    Route::get('/member-files/{id}/{file}', 'ApplicationController@download');

    Route::get('/admin/vidomist-chleniv-zhuri', 'ApplicationController@vidomistChlenivZhuriPDF');
    Route::get('/admin/vidomist-dzhaz-vitrazh', 'ApplicationController@vidomistDzhazVitrazhPDF');
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
    Route::get('/admin/master-class', function () {
        return view('admin.admin.masterClass');
    });
    Route::get('/admin/users-messages', function () {
        return view('admin.admin.usersMessages');
    });

    // VUE запросы
    Route::post('post-foto', 'GalleryController@postFoto');
    Route::post('put-foto', 'GalleryController@putFotoYear');
    Route::post('delete-foto', 'GalleryController@deleteFoto');

    Route::post('post-video', 'GalleryController@postVideo');
    Route::post('put-video', 'GalleryController@putVideoYear');
    Route::post('delete-video', 'GalleryController@deleteVideo');

    Route::get('get-question', 'QuestionController@getQuestion');
    Route::post('delete-question/{id}/', 'QuestionController@deleteQuestion');

    Route::post('post-contact', 'InfoController@postContact');
    Route::post('post-social', 'InfoController@postSocial');
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
    Route::get('get-rating', 'ApplicationController@getRating')->name('rating');
});

// Роль Журі
Route::group(['middleware' => ['auth', 'role:jury']], function () {

    Route::get('/admin/all-statements', function () {
        return view('admin.jury.allStatements');
    });
    Route::post('to-rate', 'EvaluationController@toRate')->name('to-rate');
    Route::get('has-record/{application_id}', 'EvaluationController@hasRecord')->name('has-record');
    Route::post('to-rate-update/{evaluation_id}', 'EvaluationController@toRateUpdate')->name('to-rate-update');

    Route::get('/admin/all-statements/{any}', function () {
         return view('admin.jury.allStatements');
     });
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
    Route::get('/admin/period', function () {
        return view('admin.superAdmin.period');
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
Auth::routes(['register' => false]);

// VUE запросы
    Route::get('is-opened-registration', 'PeriodController@isOpenedRegistration');
    Route::get('get-all-info', 'InfoController@getAllInfo');
    Route::get('get-personal-doc', 'InfoController@getPersonalDoc');

    Route::get('get-foto', 'GalleryController@getFoto');
    Route::get('get-foto/{year}/', 'GalleryController@getFotoYear');
    Route::get('get-video', 'GalleryController@getVideo');
    Route::get('get-video/{year}/', 'GalleryController@getVideoYear');
    Route::get('get-quotes', 'InfoController@getQuotes');

    Route::get('get-members',  'ApplicationController@getMembers');
    Route::get('get-approved-members', 'ApplicationController@getApprovedMembers');
    Route::get('get-nominations',  'ApplicationController@getNominations');
    Route::get('get-apptype', 'ApplicationController@getAppType');

    Route::get('get-all-members',  'ApplicationController@getAllMembers');
    Route::get('get-archive-members', 'ApplicationController@getArciveMembers');

    Route::get('get-member/{id}/',  'ApplicationController@getMember');

    Route::post('archive-members/{id}/',  'ApplicationController@archiveMembers');

    Route::post('send-app',  'ApplicationController@postApp');
    Route::post('unarchive-members/{id}/',  'ApplicationController@unarchiveMembers');
    Route::post('add-approved/{id}/', 'ApplicationController@addApproved');

    Route::post('delete-members/{id}/',  'ApplicationController@deleteMembers');
    Route::post('post-question', 'QuestionController@postQuestion');

    Route::get('/{any}', ['as' => 'site', function () {
        return view('layouts.site.index');
    }])->where('any', '.*');

