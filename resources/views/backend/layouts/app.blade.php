<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#141925">
    <title>@yield('title', __('Dashboard')) - {{ config('app.name') }} {{ __('Backend') }}</title>
    <link rel="icon" href="{{ asset('img/aidysapp-icon.png') }}">
    <link href="{{ asset('css/backend.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body class="dark-theme">
	<div id="backend-app">
		@include('backend.layouts.partials.sidebar')
		@include('backend.layouts.partials.navbar')
		<main id="main-content-wrapper">
            <div id="main-content" class="animated fadeIn">
                @yield('content')
            </div>
        </main>
	</div>
    <script src="{{ asset('js/backend.js') }}"></script>
    @include('backend.partials.notifications')
    @yield('scripts')
</body>
</html>
