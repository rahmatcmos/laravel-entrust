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
							<th>Description</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($roles as $role)
							<tr>
								<th>{{ $role->id }}</th>
								<th>{{ $role->name }}</th>
								<th>{{ $role->description }}</th>
								<th>
									<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target=".permissions-modal">Permissions</button>								
								</th>
								<th>
									<a class=""><i class="glyphicon glyphicon-pencil"></i></a>
									<a class=""><i class="glyphicon glyphicon-trash"></i></a>
								</th>
							</tr>
						@endforeach
					</tbody>	
				</table>
			</div>
		</div>
	</div>
	@include('roles.permissions.modal')
@stop
