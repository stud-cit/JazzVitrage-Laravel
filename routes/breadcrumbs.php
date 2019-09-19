<?php
// Нові заяви
Breadcrumbs::register('admin.orgСommittee.newStatements', function($breadcrumbs) {
    $breadcrumbs->push('Нові заяви', route('admin.orgСommittee.newStatements'));
});
// Видалені заяви
Breadcrumbs::register('admin.orgСommittee.removedStatements', function($breadcrumbs) {
    $breadcrumbs->push('Видалені заяви', route('admin.orgСommittee.removedStatements'));
});
// Список учасників
Breadcrumbs::register('admin.orgСommittee.listParticipants', function($breadcrumbs) {
    $breadcrumbs->push('Список учасників', route('admin.orgСommittee.listParticipants'));
});
// Результати оцінювання
Breadcrumbs::register('admin.orgСommittee.evaluationResults', function($breadcrumbs) {
    $breadcrumbs->push('Результати оцінювання', route('admin.orgСommittee.evaluationResults'));
});
// Додати журі
Breadcrumbs::register('admin.superAdmin.addJury', function($breadcrumbs) {
    $breadcrumbs->push('Додати журі', route('admin.superAdmin.addJury'));
});
// Додати в орг. комітет
Breadcrumbs::register('admin.superAdmin.addToOrgCommittee', function($breadcrumbs) {
    $breadcrumbs->push('Додати в орг. комітет', route('admin.superAdmin.addToOrgCommittee'));
});
// Додати адміністратора
Breadcrumbs::register('admin.superAdmin.addAdminOrgCommittee', function($breadcrumbs) {
    $breadcrumbs->push('Додати адміністратора', route('admin.superAdmin.addAdminOrgCommittee'));
});
// Всі заяви
Breadcrumbs::register('admin.jury.allStatements', function($breadcrumbs) {
    $breadcrumbs->push('Всі заяви', route('admin.jury.allStatements'));
});
// Інформація
Breadcrumbs::register('admin.jury.information', function($breadcrumbs) {
    $breadcrumbs->push('Інформація', route('admin.jury.information'));
});
// Відеогалерея
Breadcrumbs::register('admin.admin.videoGallery', function($breadcrumbs) {
    $breadcrumbs->push('Відеогалерея', route('admin.admin.videoGallery'));
});
// Фотогалерея
Breadcrumbs::register('admin.admin.fotoGallery', function($breadcrumbs) {
    $breadcrumbs->push('Фотогалерея', route('admin.admin.fotoGallery'));
});
// Загальна інформація
Breadcrumbs::register('admin.admin.mainInformation', function($breadcrumbs) {
    $breadcrumbs->push('Загальна інформація', route('admin.admin.mainInformation'));
});
// Питання користувачів
Breadcrumbs::register('admin.admin.question', function($breadcrumbs) {
    $breadcrumbs->push('Питання користувачів', route('admin.admin.question'));
});

// home
Breadcrumbs::register('admin.home', function($breadcrumbs) {
    $breadcrumbs->push('home', route('admin.home'));
});