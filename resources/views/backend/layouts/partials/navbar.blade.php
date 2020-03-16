<nav id="navbar" class="navbar">
	<div class="nav-left">
		{{-- <button id="toggle-sidebar-btn">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			  <path d="M3,8H21a1,1,0,0,0,0-2H3A1,1,0,0,0,3,8Zm18,8H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Zm0-5H3a1,1,0,0,0,0,2H21a1,1,0,0,0,0-2Z"/>
			</svg>
		</button> --}}
		<button id="toggle-sidebar-btn">
			<span></span>
		</button>
		<a href="{{ route('backend.dashboard') }}" class="navbar-brand">
			<img src="{{ asset('img/aidysapp-logo.svg') }}" alt="{{ config('app.name') }}">
			{{-- <img class="md:hidden" src="{{ asset('img/aidysapp-icon.png') }}" alt="{{ config('app.name') }}"> --}}
		</a>
	</div>
	<div class="nav-right">
		<button id="toggle-auth-menu-btn">
			<svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
			  <path d="M12,2A10,10,0,0,0,4.65,18.76h0a10,10,0,0,0,14.7,0h0A10,10,0,0,0,12,2Zm0,18a8,8,0,0,1-5.55-2.25,6,6,0,0,1,11.1,0A8,8,0,0,1,12,20ZM10,10a2,2,0,1,1,2,2A2,2,0,0,1,10,10Zm8.91,6A8,8,0,0,0,15,12.62a4,4,0,1,0-6,0A8,8,0,0,0,5.09,16,7.92,7.92,0,0,1,4,12a8,8,0,0,1,16,0A7.92,7.92,0,0,1,18.91,16Z"/>
			</svg>
		</button>
	</div>
</nav>

@include('backend.layouts.partials.auth-menu')