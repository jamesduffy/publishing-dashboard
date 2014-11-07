@extends('layouts.authenticated')

@section('page-header')
	<h1>Permissions for {{ $user->first_name }} {{ $user->last_name }}</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'users/permissions')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $user->id) }}

		@foreach($roles as $role)
		<div class="checkbox">
			<label>
				{{ Form::checkbox($role->id, 'value', $user->can($role->name)) }} {{ $role->description }}
			</label>
		</div>
		@endforeach

	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('UsersController@getEdit', 'Cancel', $user->id, array('class'=>'btn btn-default btn-lg btn-block')) }}
	</div>

	{{ Form::close() }}
</div>
@stop