@extends('layouts.authenticated')

@section('page-header')
	<h1>Edit Campaign</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'campaigns/edit')) }}

	<div class="col-md-9">
		{{ Form::token() }}

		{{ Form::hidden('post_id', $post->id) }}

		@if (isset($article))
		{{ Form::hidden('article_id', $article->id) }}

		<div class="form-group">
			<label for="title">Article</label>
			<p class="form-control-static">{{ $article->title }}</p>
		</div>
		@endif

		{{ $errors->first('text') }}

		<div class="form-group">
			<label for="text">Post Body</label>
			{{ Form::textarea('text', $post->text, array('class'=>'form-control monospace-field')) }}
		</div>
	</div>

	<div class="col-md-3">
		{{ Form::submit('Save', array('class'=>'btn btn-primary btn-lg btn-block'))}}
		{{ link_to_action('CampaignsController@getIndex', 'Cancel', null, array('class'=>'btn btn-default btn-lg btn-block')) }}
	
		<div class="panel panel-default">
			<div class="panel-heading">Advanced</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="network">Network</label>
					{{ Form::select('network', array('twitter' => 'Twitter'), $post->network, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="status">Status</label>
					{{ Form::select('status', $statuses, $post->status, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

		@if(Auth::user()->can('schedule_campaign'))
		<div class="panel panel-default">
			<div class="panel-heading">Scheduled At</div>
			
			<div class="panel-body">
				<div class="form-group">
					<label for="month">Month</label>
					{{ Form::selectMonth('month', $post->month, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="day">Day</label>
					{{ Form::selectRange('day', 1, 31, $post->day, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="hour">Hour</label>
					{{ Form::selectRange('hour', 0, 24, $post->hour, array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="minute">Minute</label>
					{{ Form::selectRange('minute', 0, 60, $post->minute, array('class'=>'form-control')) }}
				</div>
			</div>
		</div>
		@endif

		@if(Auth::user()->can('delete_campaign'))
		<p class="text-center">
			{{ link_to_action('CampaignsController@getDelete', 'Delete', $post->id, array('class' => 'text-danger')) }}
		</p>
		@endif
	</div>

	{{ Form::close() }}
</div>
@stop