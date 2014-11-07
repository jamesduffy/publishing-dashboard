@extends('layouts.authenticated')

@section('page-header')
	<h1>Articles</h1>
@stop

@section('body')
<div class="row">
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Section</h3>
			</div>
			
			<ul class="list-group">
				<li class="list-group-item @if (! Request::segment(3)) active @endif">
					{{ link_to_action('ArticlesController@getIndex', 'All') }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'news') active @endif">
					{{ link_to_action('ArticlesController@getIndex', 'News', array('category' => 'news')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'culture') active @endif">
					{{ link_to_action('ArticlesController@getIndex', 'Culture', array('category' => 'culture')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'opinion') active @endif">
					{{ link_to_action('ArticlesController@getIndex', 'Opinion', array('category' => 'opinion')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'sports') active @endif">
					{{ link_to_action('ArticlesController@getIndex', 'Sports', array('category' => 'sports')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'other') active @endif">
					{{ link_to_action('ArticlesController@getIndex', 'Other', array('category' => 'other')) }}
				</li>
			</ul>
		</div>
	</div>

	<div class="col-md-10">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th style="width:300px;">Title</th>
						<th>Author</th>
						<th>Section</th>
						<th>Published At</th>
						<th>Campaigns</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($articles as $article)
					<tr>
						<td>{{ $article->external_id }}</td>
						<td><a href="http://csusignal.com/?p={{ $article->external_id }}" target="_blank">{{ $article->title }}</a></td>
						<td>{{ $article->author }}</td>
						<td>{{ $article->category }}</td>
						<td>{{ $article->published_at }}</td>
						<td>{{ $article->num_campaigns }}</td>
						<td>
							@if(Auth::user()->can('create_campaign'))
								{{ link_to_action('CampaignsController@getCreate', 'Create Campaign', $article->external_id) }}
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{{ $articles->links() }}
		</div>
	</div>
</div>
@stop