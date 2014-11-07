@extends('layouts.authenticated')

@section('page-header')
	<h1>Create Staff Member</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'users/create')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ $errors->first('username') }}

		<div class="form-group">
			<label for="title">Username</label>
			{{ Form::text('username', null, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('email') }}

		<div class="form-group">
			<label for="title">Email</label>
			{{ Form::text('email', null, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('first_name') }}

		<div class="form-group">
			<label for="first_name">First Name</label>
			{{ Form::text('first_name', null, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('last_name') }}

		<div class="form-group">
			<label for="last_name">Last Name</label>
			{{ Form::text('last_name', null, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('password') }}

		<div class="form-group">
			<label for="slug">Password</label>
			{{ Form::text('password', null, array('class'=>'form-control')) }}
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('UsersController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	
		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="role">Role</label>
					{{ Form::select('role', array('writer' => 'Writer', 'editor' => 'Editor', 'admin' => 'Admin'), 'writer', array('class'=>'form-control')) }}
				</div>
			</div>
		</div>
	</div>

	{{ Form::close() }}
</div>
@stop