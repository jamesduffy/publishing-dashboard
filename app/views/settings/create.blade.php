@extends('layouts.authenticated')

@section('page-header')
	<h1>Create Setting</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'settings/create')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ $errors->first('key') }}

		<div class="form-group">
			<label for="key">Key</label>
			{{ Form::text('key', null, array('class'=>'form-control')) }}
		</div>

		{{ $errors->first('value') }}

		<div class="form-group">
			<label for="value">Value</label>
			{{ Form::textarea('value', null, array('class'=>'form-control monospace-field')) }}
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('SettingsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	</div>

	{{ Form::close() }}
</div>
@stop