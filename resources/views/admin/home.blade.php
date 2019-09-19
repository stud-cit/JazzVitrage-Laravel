@extends('layouts.admin.index')

@section('content')



    <div class="row category-menu">
        
        {{-- Орг.комітет --}}

        @if (Auth::user()->role == 'orgComittee' || Auth::user()->role == 'superAdmin')
       
        <a href="/admin/new-statements" class="col-8 col-sm-5 col-md-3 category-items" >
            <div class="category-icon"><i class="fa fa-fw fa-users fa-3x"></i></div>
            Нові заяви
        </a>

         <a href="/admin/removed-statements" class="col-8 col-sm-5 col-md-3 category-items" >
            <div class="category-icon"><i class="fa fa-trash fa-3x"></i></div>
            Видалені заяви
        </a>

        <a href="/admin/list-participants" class="col-8 col-sm-5 col-md-3 category-items" >
            <div class="category-icon"><i class="fa fa-list fa-3x"></i></div>
            Список учасників
        </a>

         <a href="/admin/evaluation-results" class="col-8 col-sm-5 col-md-3 category-items" >
            <div class="category-icon"><i class="fa fa-list-ol fa-3x"></i></div>
            Результати оцінювання
        </a>

        @endif

        {{-- Журі --}}

        @if (Auth::user()->role == 'jury' || Auth::user()->role == 'superAdmin')

            <a href="/admin/information" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-info-circle fa-3x"></i></div>
                Інформація
            </a>
            
            <a href="/admin/all-statements" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-address-card fa-3x"></i></div>
                Всі заяви
            </a>

        @endif

        {{-- Супер адмін --}}

        @if (Auth::user()->role == 'superAdmin')

            <a href="/admin/add-jury" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-gavel fa-3x"></i></div>
                Додати журі
            </a>

            <a href="/admin/add-to-org-committee" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-users fa-3x"></i></div>
                Додати в орг. комітет
            </a>
           
            <a href="/admin/add-admin-org-committee" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-users fa-3x"></i></div>
                Додати адміністратора
            </a>

        @endif

        {{-- Адмін --}}

        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superAdmin')

            <a href="/admin/video-gallery" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-video-camera fa-3x"></i></div>
                Відеогалерея
            </a>

            <a href="/admin/foto-gallery" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-file-image-o fa-3x"></i></div>
                Фотогалерея
            </a>

            <a href="/admin/main-information" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-info-circle fa-3x"></i></div>
                Загальна інформація
            </a>

            <a href="/admin/question" class="col-8 col-sm-5 col-md-3  category-items">
                <div class="category-icon"><i class="fa fa-question-circle fa-3x"></i></div>
                Питання користувачів
            </a>

        @endif

    </div>


@endsection