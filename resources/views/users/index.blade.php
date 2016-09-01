@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div style="margin-bottom: 50px">
				<a href="{{ route('user_create')}}" class="pull-right btn btn-md btn-success">Create User</a>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				Users
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>email</th>
							<th>Roles</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>
									<ul style="padding-left: 0px">
										@foreach ($user->roles as $role)
											<li>
												{{ $role->name}}
											</li>
										@endforeach
									</ul>
								</td>
								<td>
									@permission('edit_users')
										<a href="{{route('user_edit', $user)}}" class=""><i class="glyphicon glyphicon-pencil"></i></a>
									@endpermission
									@permission('delete_users')
										@if(Auth::user()->email != $user->email)
											<a href="{{route('user_delete', $user)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?"><i class="glyphicon glyphicon-trash"></i></a>
										@endif
									@endpermission
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@stop
@section('scripts')
	@include('partials.alert-success')
@endsection
