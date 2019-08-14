<?php

// Нові заяви
Breadcrumbs::register('admin.newStatements', function($breadcrumbs) {
    $breadcrumbs->push('Нові заяви', route('admin.newStatements'));
});

// Видалені заяви
Breadcrumbs::register('admin.removedStatements', function($breadcrumbs) {
    $breadcrumbs->push('Видалені заяви', route('admin.removedStatements'));
});

// Список учасників
Breadcrumbs::register('admin.listParticipants', function($breadcrumbs) {
    $breadcrumbs->push('Список учасників', route('admin.listParticipants'));
});

// Результати оцінювання
Breadcrumbs::register('admin.evaluationResults', function($breadcrumbs) {
    $breadcrumbs->push('Результати оцінювання', route('admin.evaluationResults'));
});