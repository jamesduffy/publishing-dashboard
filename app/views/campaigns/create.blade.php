@extends('layouts.authenticated')

@section('page-header')
	<h1>Create Campaign</h1>
@stop

@section('body')
<div class="row">
	{{ Form::open(array('url' => 'campaigns/create')) }}

	<div class="col-md-9">
		{{ Form::token() }}

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
			{{ Form::textarea('text', null, array('class'=>'form-control monospace-field')) }}
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
					{{ Form::select('network', array('twitter' => 'Twitter'), 'twitter', array('class'=>'form-control')) }}
				</div>

				<div class="form-group">
					<label for="status">Status</label>
					{{ Form::select('status', $statuses, 'draft', array('class'=>'form-control')) }}
				</div>
			</div>
		</div>

		@if(Auth::user()->can('schedule_campaign'))
			<div class="panel panel-default">
				<div class="panel-heading">Scheduled At</div>
				
				<div class="panel-body">
					<div class="form-group">
						<label for="month">Month</label>
						{{ Form::selectMonth('month', date('m'), array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="day">Day</label>
						{{ Form::selectRange('day', 1, 31, date('j'), array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="hour">Hour</label>
						{{ Form::selectRange('hour', 0, 24, date('G'), array('class'=>'form-control')) }}
					</div>

					<div class="form-group">
						<label for="minute">Minute</label>
						{{ Form::selectRange('minute', 0, 60, date('i'), array('class'=>'form-control')) }}
					</div>
				</div>
			</div>
		@endif
	</div>

	{{ Form::close() }}
</div>
@stop