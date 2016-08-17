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
								<td>{{ $role->id }}</td>
								<td>{{ $role->name }}</td>
								<td>{{ $role->description }}</td>
								<td>
									<button type="button" class="btn btn-info btn-xs get-perms" role_id="{{ $role->id }}" data-toggle="modal" data-target=".permissions-modal">Permissions</button>								
								</td>
								<td>
									<a class=""><i class="glyphicon glyphicon-pencil"></i></a>
									<a class=""><i class="glyphicon glyphicon-trash"></i></a>
								</td>
							</tr>
						@endforeach
					</tbody>	
				</table>
			</div>
		</div>
	</div>
	@include('roles.permissions.modal')
@stop
@section('scripts')
<script>
	$(document).on('ready', function(){
		$('#select-perms').multiSelect({
			selectableHeader: "<div class='custom-header'>Selectable items</div>",
			selectionHeader: "<div class='custom-header'>Selection items</div>", 
		});	

		$('.get-perms').on('click', function(){
            role_id = $(this).attr('role_id');
	       	$.ajax({
                url : '{{ URL::to("/perms/assigned") }}',
                type : 'GET',
                dataType: 'json',
                data : {role_id: role_id}
            }).done(function(data){
            	console.log('Role id: ' + role_id);
            	$.each(data.assign, function (index, value) {
                	console.log(value.id, value.display_name);
                	// $('#select-perms').append($('<option>', {
                	// 	value: value.id,
                	// 	text: value.display_name
                	// }));
                	$('#select-perms option[value="'+value.id+'"]').attr('selected', true);
                }); 
                $('#select-perms').multiSelect('refresh');
            });            
        });
		
	});
</script>
@stop