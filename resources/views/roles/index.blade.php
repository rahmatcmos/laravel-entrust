@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div style="margin-bottom: 50px">
                <a href="{{ route('role_create')}}" class="pull-right btn btn-md btn-success">Create Role</a>
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
                            <th>Permissions</th>
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
                                    @if(Auth::user()->hasRole('admin'))
                                        <button type="button" class="btn btn-info btn-xs get-perms" role_id="{{ $role->id }}" data-toggle="modal" data-target=".permissions-modal">Permissions</button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('role_edit', $role) }}" class=""><i class="glyphicon glyphicon-pencil"></i></a>
                                    @permission('delete_roles')
                                        <a href="{{route('role_delete', $role)}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Are you sure?"><i class="glyphicon glyphicon-trash"></i></a>
                                    @endpermission
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
        $.ajaxSetup(
        {
            headers:
            {
                'X-CSRF-Token': '{{ csrf_token() }}'
            }
        });

        $('#select-perms').multiSelect({
            selectableHeader: "<div class='custom-header'>Selectable items</div>",
            selectionHeader: "<div class='custom-header'>Selection items</div>",
            afterSelect: function (value){
                $.ajax({
                    url: '{{ URL::to("/perms/assign") }}',
                    type: 'POST',
                    dataType: 'json',
                    data : {
                        permission_id: value[0],
                        role_id: role_id
                    }
                }).done(function (data) {

                });
            },

            afterDeselect: function (value){
                $.ajax({
                    url: '{{ URL::to("/perms/remove") }}',
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        permission_id: value[0],
                        role_id: role_id
                    }
                }).done(function (data) {
                    
                });
            }

        });

        $('.get-perms').on('click', function(){
            role_id = $(this).attr('role_id');
            $('#select-perms').multiSelect('refresh');
            $('#select-perms option').attr('selected', false);
               $.ajax({
                url : '{{ URL::to("/perms/assigned") }}',
                type : 'GET',
                dataType: 'json',
                data : {role_id: role_id}
            }).done(function(data){
                $.each(data.assigned, function (index, value) {
                    $('#select-perms option[value="'+value.id+'"]').attr('selected', true);
                });
                $('#select-perms').multiSelect('refresh');
            });
        });
    }); //ready
</script>
@include('partials.alert-success')
@stop
