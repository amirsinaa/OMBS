<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<title>{{ config('app.name', ' - Register') }}</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="{{ asset('lib/font-awesome.min.css') }}">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/layout.css') }}">
</head>

<body>
	<main id="app">
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
      <div class="container-fluid">
        <div style="margin: 3em 25em; padding: 7em 5em 4em; border: 1px solid rgb(204, 204, 204); border-radius: 55px;">
          @yield('content')
        </div>
      </div>
    </section>
	</main>
</body>
</html>
