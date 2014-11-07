@extends('layouts.authenticated')

@section('page-header')
	<h1>
		Staff
		@if(Auth::user()->can('create_staff'))
			<small>{{ link_to_action('UsersController@getCreate', 'Create Staff Memeber') }}</small>
		@endif
	</h1>
@stop

@section('body')
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Role</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
				<tr>
					<td>{{ $user->first_name }} {{ $user->last_name }}</td>
					<td>{{ $user->username }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->role }}</td>
					<td>
						@if(isset($filter) AND $filter=='trash') {{ link_to_action('UsersController@getRestore', 'Restore', $user->id) }} @endif
						
						@if( Auth::user()->can('edit_other_staff') OR Auth::id() == $user->id )
							{{ link_to_action('UsersController@getEdit', 'Edit', $user->id) }}
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	{{ $users->links() }}
@stop