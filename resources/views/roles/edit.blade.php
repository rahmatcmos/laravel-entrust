@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="panel panel-info">
			<div class="panel-heading">
				Create Role
			</div>
			<div class="panel-body">
				<form action="{{ route('role_update', $role) }}" method="post" class="form-horizontal">
					{{ csrf_field() }}
                    {{ method_field('PATCH') }}
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" value="{{ $role->name }}" disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="display_name" class="col-sm-2 control-label">Display Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="display_name" value="{{ $role->display_name}}" disabled>
						</div>
					</div>
					<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
						<label for="description" class="col-sm-2 control-label">Description:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="description" value="{{old('description', $role->description)}}">
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary">Edit</button>
					    </div>
				  	</div>
				</form>
			</div>
		</div>
	</div>
@stop
