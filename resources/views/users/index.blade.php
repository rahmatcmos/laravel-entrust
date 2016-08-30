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
										<a href="{{route('user_delete', $user)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?"><i class="glyphicon glyphicon-trash"></i></a>
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
	<script>
	//Delete some resource with sweetalert
        (function(window, $, undefined) {

            var Laravel = {
                initialize: function() {
                    this.methodLinks = $('a[data-method]');
                    this.token = $('a[data-token]');
                    this.registerEvents();
                },

                registerEvents: function() {
                    this.methodLinks.on('click', this.handleMethod);
                },

                handleMethod: function(e) {
                    e.preventDefault();

                    var link = $(this);
                    var httpMethod = link.data('method').toUpperCase();
                    var form;

                    // If the data-method attribute is not PUT or DELETE,
                    // then we don't know what to do. Just ignore.
                    if ($.inArray(httpMethod, ['PUT', 'DELETE']) === -1) {
                        return false;
                    }

                    Laravel
                            .verifyConfirm(link)
                            .done(function () {
                                form = Laravel.createForm(link);
                                form.submit();
                            })
                },

                verifyConfirm: function(link) {
                    var confirm = new $.Deferred();

                    swal({
                                title: "Are you sure?",
                                text: "You will not be able to recover this user!",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes, delete it!",
                                cancelButtonText: "No, cancel plx!",
                                closeOnConfirm: false,
                                closeOnCancel: false
                            },
                            function(isConfirm, method) {
                                if (isConfirm) {
                                    confirm.resolve(link);
                                    swal(
                                            "Deleted!",
                                            "Your post has been deleted.",
                                            "success");
                                } else {
                                    confirm.reject(link);
                                    swal(
                                            "Cancelled",
                                            "Your post is safe :)",
                                            "error");
                                } });

                    return confirm.promise()
                },

                createForm: function(link) {
                    var form =
                            $('<form>', {
                                'method': 'POST',
                                'action': link.attr('href')
                            });

                    var token =
                            $('<input>', {
                                'type': 'hidden',
                                'name': '_token',
                                'value': link.data('token')
                            });

                    var hiddenInput =
                            $('<input>', {
                                'name': '_method',
                                'type': 'hidden',
                                'value': link.data('method')
                            });

                    return form.append(token, hiddenInput)
                            .appendTo('body');
                }
            };

            Laravel.initialize();

        })(window, jQuery);
    </script>
@endsection
