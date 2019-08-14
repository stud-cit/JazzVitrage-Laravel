@extends('layouts.admin.index')

@section('content')
	
	<div class="card">
		<div class="card-body">
		<div class="error-message">Виникла помилка!</div>
		@if (Session::has('message'))
			<div class="alert alert-info">{{ Session::get('message') }}</div>
		@endif
	
		<a href="/dashboard" class="btn btn-primary mt-4">Повернутися на головну</a>
	</div>
</div>

@endsection