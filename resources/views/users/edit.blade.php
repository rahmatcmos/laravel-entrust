@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="panel panel-info">
			<div class="panel-heading">
				Edit User
			</div>
			<div class="panel-body">
				<form action="{{route('user_update', $user)}}" class="form-horizontal" method="POST">
					{{ csrf_field() }}
					{{ method_field('PATCH')}}
					<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

					<div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                        <label for="role" class="col-md-4 control-label">Role</label>

                        <div class="col-md-6">

							<select id="user-roles" name="roles[]" multiple="multiple">
								@foreach ($roles as $id => $role)
									<option value="{{ $id }}" {{ $user->hasRole($role)? 'selected' : ''  }} >{{ $role }}</option>
								@endforeach
							</select>

                            @if ($errors->has('roles'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('roles') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>


					<div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Edit
                            </button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
@stop
@section('scripts')
<!-- Initialize the plugin: -->
<script type="text/javascript">
    $(document).ready(function() {
		$('#user-roles').multiselect({

        });
    });
</script>
@endsection
