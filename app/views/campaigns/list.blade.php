@extends('layouts.authenticated')

@section('page-header')
	<h1>
		Campaigns
		@if(Auth::user()->can('create_campaign'))
			<small>{{ link_to_action('CampaignsController@getCreate', 'Create Campaign') }}</small>
		@endif
	</h1>
@stop

@section('body')
<div class="row">
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Status</h3>
			</div>
			
			<ul class="list-group">
				<li class="list-group-item @if (! Request::segment(3)) active @endif">
					{{ link_to_action('CampaignsController@getIndex', 'All') }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'draft') active @endif">
					{{ link_to_action('CampaignsController@getIndex', 'Draft', array('status' => 'draft')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'pending') active @endif">
					{{ link_to_action('CampaignsController@getIndex', 'Pending', array('status' => 'pending')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'approved') active @endif">
					{{ link_to_action('CampaignsController@getIndex', 'Approved', array('status' => 'approved')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'scheduled') active @endif">
					{{ link_to_action('CampaignsController@getIndex', 'Scheduled', array('status' => 'scheduled')) }}
				</li>
				<li class="list-group-item @if (Request::segment(3) == 'published') active @endif">
					{{ link_to_action('CampaignsController@getIndex', 'Published', array('status' => 'published')) }}
				</li>
			</ul>
		</div>
	</div>

	<div class="col-md-10">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Network</th>
						<th>Text</th>
						<th>Status</th>
						<th>Article</th>
						<th>Created By</th>
						<th>Scheduled At</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($posts as $post)
					<tr>
						<td>{{ $post->network }}</td>
						<td style="width: 300px;">{{ $post->text }}</td>
						<td>{{ $post->status }}</td>
						<td><a href="http://csusignal.com/?p={{ $post->article_id }}" target="_blank">{{ $post->article_id }}</a></td>
						<td>{{ $post->first_name }} {{ $post->last_name }}</td>
						<td>{{ date('F j, Y g:ia', strtotime($post->scheduled_at)) }}</td>
						<td>
							@if( Auth::user()->can('edit_others_campaign') OR Auth::id() == $post->user_id )
								{{ link_to_action('CampaignsController@getEdit', 'Edit', $post->id) }}
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{{ $posts->links() }}
		</div>
	</div>
</div>
@stop