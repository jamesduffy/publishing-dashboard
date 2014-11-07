@extends('layouts.authenticated')

@section('page-header')
	<h1>Edit Staff Member</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'users/edit')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $user->id) }}

		<div class="form-group">
			<label for="username">Username</label>
			<p class="form-control-static">{{ $user->username }}</p>
		</div>

		{{ $errors->first('email') }}

		<div class="form-group">
			<label for="email">Email</label>
			{{ Form::text('email', $user->email, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('first_name') }}

		<div class="form-group">
			<label for="first_name">First Name</label>
			{{ Form::text('first_name', $user->first_name, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('last_name') }}

		<div class="form-group">
			<label for="last_name">Last Name</label>
			{{ Form::text('last_name', $user->last_name, array('class'=>'form-control')) }}
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('UsersController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	
		@if(Auth::user()->can('edit_other_staff'))
		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="role">Role</label>
					{{ Form::select('role', array('Writer' => 'Writer', 'editor' => 'Editor', 'admin' => 'Admin'), $user->role, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>
		@endif

		@if(Auth::user()->can('edit_other_staff') OR Auth::id() == $user->id)
		<p class="text-center">
			{{ link_to_action('UsersController@getPasswordUpdate', 'Update Password', $user->id) }}
		</p>
		@endif

		@if(Auth::user()->can('edit_other_staff'))
		<p class="text-center">
			{{ link_to_action('UsersController@getPermissions', 'Update Permissions', $user->id) }}
		</p>
		@endif

		@if(Auth::user()->can('edit_other_staff'))		
		<p class="text-center">
			{{ link_to_action('UsersController@getDelete', 'Delete', $user->id, array('class'=>'text-danger')) }}
		</p>
		@endif
	</div>

	{{ Form::close() }}
</div>
@stop