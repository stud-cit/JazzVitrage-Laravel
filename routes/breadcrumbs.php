<?php

// Home
Breadcrumbs::register('admin.home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('admin.home'));
});