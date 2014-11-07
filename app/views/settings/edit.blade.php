@extends('layouts.authenticated')

@section('page-header')
	<h1>Edit Setting</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'settings/edit')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('id', $setting->id) }}

		<div class="form-group">
			<label for="key">Key</label>
			<p class="form-control-static">{{ $setting->key }}</p>
		</div>

		{{ $errors->first('value') }}

		<div class="form-group">
			<label for="value">Value</label>
			{{ Form::textarea('value', $setting->value, array('class'=>'form-control monospace-field')) }}
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('SettingsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
		
		{{ link_to_action('SettingsController@getDelete', 'Delete', $setting->id) }}
	</div>

	{{ Form::close() }}
</div>
@stop