@extends('layouts.authenticated')

@section('page-header')
	<h1>Stats</h1>
@stop

@section('body')
<div class="row">
	<div class="col-md-4">
		<h3>Counts</h3>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>Tweets</th>
						<th>Followers</th>
						<th>Listed</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($counts as $count)
					<tr>
						<td>{{ $count->created_at }}</td>
						<td>{{ $count->statuses }}</td>
						<td>{{ $count->followers }}</td>
						<td>{{ $count->listed }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="col-md-8">
		<h3>Tweets</h3>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th style="width:300px;">Text</th>
						<th>Favorite Count</th>
						<th>Retweet Count</th>
						<th>Published At</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($tweets as $tweet)
					<tr>
						<td>{{ $tweet->text }}</td>
						<td>{{ $tweet->favorite_count }}</td>
						<td>{{ $tweet->retweet_count }}</td>
						<td>{{ $tweet->twitter_created_at }}</td>
						<td>
							
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			{{ $tweets->links() }}
		</div>
	</div>
</div>
@stop