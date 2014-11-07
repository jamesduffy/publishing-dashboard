@extends('layouts.authenticated')

@section('page-header')
	<h1>Update {{ $user->first_name }} {{ $user->last_name }}'s Password</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'users/password-update')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $user->id) }}

		{{ $errors->first('password') }}

		<div class="form-group">
			<label for="password">New Password</label>
			{{ Form::text('password', null, array('class'=>'form-control')) }}
		</div>

	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('UsersController@getEdit', 'Cancel', $user->id, array('class'=>'btn btn-default btn-lg btn-block')) }}
	</div>

	{{ Form::close() }}
</div>
@stop