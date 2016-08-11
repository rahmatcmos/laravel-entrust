@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div style="margin-bottom: 50px">
				<a class="pull-right btn btn-md btn-success">Create Role</a>				
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Roles
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Display Name</th>
							<th>Description</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($roles as $role)
							<tr>
								<th>{{ $role->id }}</th>
								<th>{{ $role->name }}</th>
								<th>{{ $role->display_name }}</th>
								<th>{{ $role->description }}</th>
								<th>
									<a href="">Edit</a>
									<a href="">Delete</a>
								</th>
							</tr>
						@endforeach
					</tbody>	
				</table>
			</div>
		</div>
	</div>
@stop