<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="theme-color" content="#141925">
	<title>{{ config('app.name') }} - {{ __('Backend Login') }}</title>
	<link rel="icon" href="{{ asset('img/aidysapp-icon.png') }}">
	<link href="{{ asset('css/backend.css') }}" rel="stylesheet">
</head>
<body class="dark-theme">
	<div id="backend-login" class="h-full flex items-center justify-center px-6">
		<div class="w-full max-w-sm">
			<header class="flex flex-col items-center justify-center mb-6">
				<img src="{{ asset('img/aidysapp-logo.svg') }}" alt="Logo" class="h-20 w-auto">
				<p class="mt-4 text-lg">{{ __('Backend Access') }}</p>
			</header>
			<form action="{{ route('backend.login') }}" method="POST">
				@csrf
				<div class="mb-2">
					<input type="email" name="email" class="input @error('email') input-error @enderror" placeholder="{{ __('Email Address') }}" value="{{ old('email') }}">
					@error('email')
					<p class="input-feedback feedback-error mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
				<div class="mb-6">
					<input type="password" name="password" class="input @error('password') input-error @enderror" placeholder="{{ __('Password') }}">
					@error('password')
					<p class="input-feedback feedback-error mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
				<div class="flex items-center justify-between">
					<div>
						<label class="inline-flex items-center">
							<input type="checkbox" name="remember" class="form-checkbox bg-gray-200 border-gray-300 text-gray-800 border-2 shadow-sm h-6 w-6" {{ old('remember') ? 'checked' : '' }}>
							<span class="ml-2 text-sm">{{ __('Remember Me') }}</span>
						</label>
					</div>
					<button class="btn" type="submit">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
							<path d="M17,9H9V7a3,3,0,0,1,5.12-2.13,3.08,3.08,0,0,1,.78,1.38,1,1,0,1,0,1.94-.5,5.09,5.09,0,0,0-1.31-2.29A5,5,0,0,0,7,7V9a3,3,0,0,0-3,3v7a3,3,0,0,0,3,3H17a3,3,0,0,0,3-3V12A3,3,0,0,0,17,9Zm1,10a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V12a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"/>
						</svg>
						<span class="ml-2">{{ __('Login') }}</span>
					</button>
				</div>
			</form>
		</div>
	</div>
	<script src="{{ asset('js/backend.js') }}"></script>
	@include('backend.partials.notifications')
</body>
</html>
