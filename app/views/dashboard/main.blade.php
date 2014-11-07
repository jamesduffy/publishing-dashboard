@extends('layouts.authenticated')

@section('page-header')
	<h1>Dashboard</h1>
@stop

@section('body')
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Right Now</h3>
			</div>
			
			<ul class="list-group">
				<li class="list-group-item">
					Draft
					<span class="badge">{{ $counts['draft'] }}</span>
				</li>
				<li class="list-group-item">
					Pending
					<span class="badge pull-right">{{ $counts['pending'] }}</span>
				</li>
				<li class="list-group-item">
					Approved
					<span class="badge pull-right">{{ $counts['approved'] }}</span>
				</li>
				<li class="list-group-item">
					Scheduled
					<span class="badge pull-right">{{ $counts['scheduled'] }}</span>
				</li>
				<li class="list-group-item">
					Published
					<span class="badge pull-right">{{ $counts['published'] }}</span>
				</li>
			</ul>
		</div>
	</div>

	<div class="col-md-9">
		<h3>Available for Campaigns</h3>

		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Title</th>
						<th>Author</th>
						<th>Published At</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($articles as $article)
					<tr>
						<td><a href="{{ $article->link }}" target="_blank">{{ $article->title }}</a></td>
						<td>{{ $article->author }}</td>
						<td>{{ $article->published_at }}</td>
						<td>
							@if(Auth::user()->can('create_campaign'))
								{{ link_to_action('CampaignsController@getCreate', 'Create Campaign', $article->external_id) }}
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop