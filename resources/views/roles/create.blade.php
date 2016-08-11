@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="panel panel-info">
			<div class="panel-heading">
				Create Role
			</div>
			<div class="panel-body">
				<form action="{{ route('role_store') }}" method="post" class="form-horizontal">
					{{ csrf_field() }}
					<div class="form-group">
						<label for="name" class="col-sm-2 control-label">Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name">
						</div>
					</div>
					<div class="form-group">
						<label for="display_name" class="col-sm-2 control-label">Display Name:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="display_name">
						</div>
					</div>
					<div class="form-group">
						<label for="description" class="col-sm-2 control-label">Description:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="description">
						</div>
					</div>		
					<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-success">Create</button>
					    </div>
				  	</div>				
				</form>
			</div>
		</div>
	</div>
@stop