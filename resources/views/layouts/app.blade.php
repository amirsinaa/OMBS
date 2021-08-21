<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<title>{{ config('app.name') }}</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
	<link rel="stylesheet" href="{{ asset('lib/font-awesome.min.css') }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

<body>
	<main id="app">
		<nav class="navbar navbar-dark bg-dark navbar-expand-sm">
			<div class="container-fluid">
				<a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name') }}</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-11" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar-list-11">
					<ul class="ml-auto navbar-nav">
						@guest
							<li class="px-1 nav-item">
								<a class="nav-link" href="{{ route('login') }}"><i class="fa fa-pencil fa-1x "></i>{{ trans('c.Login') }}</a>
							</li>
						@if (Route::has('register'))
							<li class="px-1 nav-item">
								<a class="nav-link" href="{{ route('register') }}"><i class="fa fa-pencil fa-1x "></i>{{ __('c.Register') }}</a>
							</li>
						@endif
						@else
							@if (Auth::check() && Auth::user()->admin == 2)
								<a href="{{ URL::to('superadminarea') }}" class='px-5 btn btn-primary btn-secondary main-color-background border-radius-25'> <strong>Admin Panel</strong></a>
							@endif
							@if (Auth::check())
								<li class="px-1 nav-item"><a class="px-5 button-w-effect nav-link btn btn-primary btn-secondary main-color-background border-radius-25" href="{{ URL::to('product/add') }}"> New Medicine </a></li>
							@endif
							<li class="pt-2 pl-2 pr-1 notifs-button"><a href="{{ URL::to('user/notifications') }}"><i class='fa fa-bell'></i></a></li>
							<li class="pt-2 pl-2 pr-1 notifs-button"><a href="{{ URL::to('basket/basketfull') }}"><i class="fa fa-shopping-cart"></i></a></li>
							<li class="px-1 nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									<i class='fa fa-user'></i>{{ Auth::user()->name }} <span class="caret"></span>
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>
		@if (session('message'))
			<div class="alert alert-success" role="alert">
				{{ session('message') }}
			</div>
		@endif

		@if (session('error'))
			<div class="alert alert-danger" role="alert">
				{{ session('error') }}
			</div>
		@endif
		<div class="alert alert-success message_ok" style="display:none;"></div>
		<div class="alert alert-success message_error" style="display:none;"></div>
		<section>
			<div class="px-5 container-fluid">
				<div class="row">
					<div class="col-md-2 col-xs-12">
						<nav class="border-0 navbar navbar-expand-lg">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
							<div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="mr-auto navbar-nav flex-column vertical-nav">
									<li class="px-1 nav-item">
										<a class="nav-link" href="{{ URL::to('/dashboard') }}">My Inventory</a>
									</li>
									<li class="px-1 nav-item">
										<a class="nav-link" href="{{ URL::to('/mysales') }}">My Sales</a>
									</li>
									<li class="px-1 nav-item">
										<a class="nav-link" href="{{ URL::to('/sentbids') }}"> Biddings</a>
									</li>
									</li>
									<li class="px-1 nav-item">
										<a class="nav-link" href="{{ URL::to('/list') }}">Listing</a>
									</li>
									<li class="px-1 nav-item">
										<a class="nav-link" href="{{ URL::to('/sent_orders') }}">Activities</a>
									</li>
								</ul>
								<ul class="ml-auto navbar-nav"></ul>
							</div>
						</nav>
					</div>
					<div class="col-md-10 col-xs-12">
						@yield('content')
					</div>
				</div>
			</div>
		</section>
	</main>
</body>
</html>
