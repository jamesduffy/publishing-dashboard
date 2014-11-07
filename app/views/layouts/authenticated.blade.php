<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Team Publisher</title>

	<link href="/css/styles.css" rel="stylesheet">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">CSU Signal Publisher</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li @if (Request::segment(1) === 'dashboard') class="active" @endif>
						{{ link_to_action('DashboardController@getIndex', 'Dashboard') }}</li>
					@if(Auth::user()->can('view_campaigns'))
						<li @if (Request::segment(1) === 'campaigns') class="active" @endif>
							{{ link_to_action('CampaignsController@getIndex', 'Campaigns') }}</li>
					@endif
					@if(Auth::user()->can('view_articles'))
						<li @if (Request::segment(1) === 'articles') class="active" @endif>
							{{ link_to_action('ArticlesController@getIndex', 'Articles') }}</li>
					@endif
					@if(Auth::user()->can('view_staff'))
						<li @if (Request::segment(1) === 'users') class="active" @endif>
							{{ link_to_action('UsersController@getIndex', 'Staff') }}</li>
					@endif
					@if(Auth::user()->role == 'admin' OR Auth::user()->role == 'editor')
						<li @if (Request::segment(1) === 'stats') class="active" @endif>
							{{ link_to_action('StatsController@getIndex', 'Stats') }}</li>
					@endif
					@if(Auth::user()->can('view_settings'))
					<li @if (Request::segment(1) === 'settings') class="active" @endif>
						{{ link_to_action('SettingsController@getIndex', 'Settings') }}</li>
					@endif
		        </ul>

				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li>{{ link_to_action('UsersController@getEdit', 'My Account', Auth::id()) }}</li>
							<li>{{ link_to_action('UsersController@getLogout', 'Logout') }}</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="page-header">
		<div class="container">
			@yield('page-header')
		</div>
	</div>

	<div class="container main-content">
		@if(Session::has('message'))
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-warning" role="alert">{{ Session::get('message') }}</div>
				</div>
			</div>
		@endif

		@yield('body')
	</div>

	<div class="container footer">
		<div class="row">
			<div class="col-md-12">
				<hr>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<p class="text-left">Confidential. All Rights Reserved.</p>
			</div>

			<div class="col-md-6">
				<p class="text-right">{{ date('l F j, Y g:ia') }}</p>
			</div>
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/js/bootstrap.min.js"></script>

</body>
</html>