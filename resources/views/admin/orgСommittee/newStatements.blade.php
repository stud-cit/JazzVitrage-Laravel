@extends('layouts.admin.index')

@section('content')

    <div class="card">
        <!-- <div class="card-header">
        	<h3>Нові заяви</h3>
        </div> -->
        <div id="app">
        	 <new-statement-component></new-statement-component>
        </div>
       
        <div class="card-body">

			<!-- <div class="mb-5">
				<a class="btn btn-primary" href="users/create">Додати</a>
			</div> -->

			@if (Session::has('message'))
				  <div class="alert alert-info">{{ Session::get('message') }}</div>
			@endif

				<table class="table table-striped" id="uTable">
					<thead class="thead-dark">
						<tr>
							<th>№</th>
							
							
						</tr>
					</thead>	
					<tbody>
						
					</tbody>

				</table>

		</div>

    </div>

@endsection
