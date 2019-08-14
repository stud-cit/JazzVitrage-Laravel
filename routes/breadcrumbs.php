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