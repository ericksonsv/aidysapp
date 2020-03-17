@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

	<div class="flex flex-wrap -mx-1">
		<div class="w-full w-full lg:w-1/4 px-1 mb-2">
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
				</div>
			</div>
		</div>
		{{-- <div class="w-full w-full lg:w-1/4 px-1 mb-2">
			<div class="info-box">
				<a href="">
					<div class="box-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						  <path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/>
						</svg>
					</div>
				</a>
				<div class="box-content">
					<div class="box-title">{{ __('Box Title') }}</div>
					<div class="box-description">{{ __('Box Description') }}</div>
				</div>
			</div>
		</div>
		<div class="w-full w-full lg:w-1/4 px-1 mb-2">
			<div class="info-box">
				<a href="">
					<div class="box-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						  <path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/>
						</svg>
					</div>
				</a>
				<div class="box-content">
					<div class="box-title">{{ __('Box Title') }}</div>
					<div class="box-description">{{ __('Box Description') }}</div>
				</div>
			</div>
		</div>
		<div class="w-full w-full lg:w-1/4 px-1 mb-2">
			<div class="info-box">
				<a href="">
					<div class="box-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						  <path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/>
						</svg>
					</div>
				</a>
				<div class="box-content">
					<div class="box-title">{{ __('Box Title') }}</div>
					<div class="box-description">{{ __('Box Description') }}</div>
				</div>
			</div>
		</div> --}}
	</div>

@endsection