<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	{{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Scripts -->
	<script src="{{ mix('js/app.js') }}" defer></script>
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/image.js') }}"></script>
	<script src="https://kit.fontawesome.com/1cb03eac5e.js" crossorigin="anonymous"></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

	<!-- Styles -->
	<link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div id="app">

		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
			<div class="container">
				<a class="navbar-brand" href="{{ url('/') }}">
					{{ config('app.name', 'Laravel') }}
					<i class="far fa-money-bill-alt"></i>
				</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto w-100">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
						</li>
						@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
						</li>
						@endif
						@else
						<li class="nav-item dropdown">
							<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
								{{ Auth::user()->names .' '.Auth::user()->last_names }} <span class="caret"></span>
							</a>

							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
								@if (Auth::user()->rol == 'ADMIN')
								<a class="dropdown-item" href="{{route('dashboard')}}">
									Dashboard
								</a>
								@endif

								<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>

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



	<main class="overflow-hidden container-main">
		<div class="row">
			<div class="col-md-3"></div>
			<div class=" col-md-3 sidebar" >
				<ul class="list-group list-group-flush ul-container">
					<a href="{{route('dashboard')}}" class="list-group-item">Dashboard</a>
					<a href="{{route('categories')}}" class="list-group-item">Categories</a>
					<a href="{{route('products')}}" class="list-group-item">Products</a>
					<a href="{{route('users')}}" class="list-group-item">Users</a>
				</ul>
			</div>
			<div class="col-md-8 m-2">
					@yield('content')
			</div>
		</div>
	</main>

</div>
</body>
</html>
