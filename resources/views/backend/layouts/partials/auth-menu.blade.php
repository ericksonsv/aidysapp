<div id="auth-menu">
	<header class="bg-cover" style="background-image: url( {{ (auth()->user()->cover) ? asset('storage/users/covers/'.auth()->user()->cover) : asset('img/default-cover.png') }} );">
		<div id="auth-overlay-color"></div>
		@if (auth()->user()->avatar)
			<img src="{{ asset('storage/users/avatars/'.auth()->user()->avatar) }}" alt="" id="auth-avatar" class="h-16 rounded-full">
		@else
			<img src="{{ asset('img/default-avatar.png') }}" alt="" id="auth-avatar" class="h-16 rounded-full">
		@endif
		<p id="auth-name">{{ auth()->user()->name }}</p>
		<p id="auth-email">{{ auth()->user()->email }}</p>
		<p id="auth-role">Administrator</p>
	</header>
	<a href="{{ route('backend.profile.show') }}" class="{{ setActive('backend.profile.*') }}">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
		  <path d="M14.81,12.28a3.73,3.73,0,0,0,1-2.5,3.78,3.78,0,0,0-7.56,0,3.73,3.73,0,0,0,1,2.5A5.94,5.94,0,0,0,6,16.89a1,1,0,0,0,2,.22,4,4,0,0,1,7.94,0A1,1,0,0,0,17,18h.11a1,1,0,0,0,.88-1.1A5.94,5.94,0,0,0,14.81,12.28ZM12,11.56a1.78,1.78,0,1,1,1.78-1.78A1.78,1.78,0,0,1,12,11.56ZM19,2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V5A3,3,0,0,0,19,2Zm1,17a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4H19a1,1,0,0,1,1,1Z"/>
		</svg>
		<span>{{ __('My Profile') }}</span>
	</a>
	<a href="">
		<svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
		  <path d="M18,13.18V10a6,6,0,0,0-5-5.91V3a1,1,0,0,0-2,0V4.09A6,6,0,0,0,6,10v3.18A3,3,0,0,0,4,16v2a1,1,0,0,0,1,1H8.14a4,4,0,0,0,7.72,0H19a1,1,0,0,0,1-1V16A3,3,0,0,0,18,13.18ZM8,10a4,4,0,0,1,8,0v3H8Zm4,10a2,2,0,0,1-1.72-1h3.44A2,2,0,0,1,12,20Zm6-3H6V16a1,1,0,0,1,1-1H17a1,1,0,0,1,1,1Z"/>
		</svg>
		<span>{{ __('Notification') }}</span>
	</a>
	<footer>
		<a href="{{ route('backend.logout') }}" onclick="event.preventDefault(); document.getElementById('backend-logout-form').submit();">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			  <path d="M12.59,13l-2.3,2.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0l4-4a1,1,0,0,0,.21-.33,1,1,0,0,0,0-.76,1,1,0,0,0-.21-.33l-4-4a1,1,0,1,0-1.42,1.42L12.59,11H3a1,1,0,0,0,0,2ZM12,2A10,10,0,0,0,3,7.55a1,1,0,0,0,1.8.9A8,8,0,1,1,12,20a7.93,7.93,0,0,1-7.16-4.45,1,1,0,0,0-1.8.9A10,10,0,1,0,12,2Z"/>
			</svg>
			<span>{{ __('Logout') }}</span>
		</a>
		<form id="backend-logout-form" action="{{ route('backend.logout') }}" method="POST" style="display: none;">
			@csrf
		</form>
	</footer>
</div>