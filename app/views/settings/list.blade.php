@extends('layouts.authenticated')

@section('page-header')
	<h1>
		Settings
		@if(Auth::user()->can('create_setting'))
			<small>{{ link_to_action('SettingsController@getCreate', 'New Setting') }}</small>
		@endif
	</h1>
@stop

@section('body')
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Key</th>
					<th>Value</th>
					<th>Created At</th>
					<th>Updated At</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($settings as $setting)
				<tr>
					<td>{{ $setting->key }}</td>
					<td>{{ $setting->value }}</td>
					<td>{{ $setting->created_at }}</td>
					<td>{{ $setting->updated_at }}</td>
					<td>
						@if(Auth::user()->can('edit_settings'))
							{{ link_to_action('SettingsController@getEdit', 'Edit', array($setting->id)) }}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@stop