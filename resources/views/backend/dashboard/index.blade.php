@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

	<div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
		@can('browse-users')
			<div class="info-box">
				<a href="{{ route('backend.users.index') }}">
					<div class="box-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						  <path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/>
						</svg>
					</div>
				</a>
				<div class="box-content">
					<div class="box-title">{{ __('Total Users') }}</div>
					<div class="box-description">{{ $users }}</div>
					<div class="flex justify-end">
						<a href="{{ route('backend.users.index') }}" class="box-btn">{{ __('View all users') }}</a>
					</div>
				</div>
			</div>
		@endcan
		@can('browse-posts')
			<div class="info-box">
				<a href="{{ route('backend.posts.index') }}">
					<div class="box-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						  <path d="M9 10h1a1 1 0 000-2H9a1 1 0 000 2zm0 2a1 1 0 000 2h6a1 1 0 000-2zm11-3.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0 .88.88 0 00-.33-.11H7a3 3 0 00-3 3v14a3 3 0 003 3h10a3 3 0 003-3V9v-.06zm-6-3.53L16.59 8H15a1 1 0 01-1-1zM18 19a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3zm-3-3H9a1 1 0 000 2h6a1 1 0 000-2z"/>
						</svg>
					</div>
				</a>
				<div class="box-content">
					<div class="box-title">{{ __('Total Posts') }}</div>
					<div class="box-description">{{ $posts }}</div>
					<div class="flex justify-end">
						<a href="{{ route('backend.posts.index') }}" class="box-btn">{{ __('View all posts') }}</a>
					</div>
				</div>
			</div>
		@endcan
	</div>

@endsection