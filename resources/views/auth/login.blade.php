@extends('layouts.app')

@section('content')
<div class="container">
    <form class="form-signin text-center" method="POST" action="{{ route('login') }}">
        @csrf
        <img class="mb-4" src="img/logo.svg">
        <h1 class="h3 mb-3 font-weight-normal">Будь ласка, увійдіть</h1>

        <label for="email" class="sr-only">{{ __('Email адреса') }}</label>
        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email адреса" required autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <label for="password" class="sr-only">{{ __('Пароль') }}</label>
        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Пароль" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <div class="checkbox mb-3 text-left">
            <label>
                <input type="checkbox" name="remember" value="remember-me" {{ old('remember') ? 'checked' : '' }}> Запам'ятати
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Вхід</button>
        @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Забули свій пароль?') }}
            </a>
        @endif
    </form>
</div>
@endsection
