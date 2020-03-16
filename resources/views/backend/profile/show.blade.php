@extends('backend.layouts.app')

@section('title', auth()->user()->name)

@section('content')

<section class="page-header">
	<h4 class="text-2xl">{{ auth()->user()->name }} {{ __('Profile') }}</h4>
	<section class="flex items-center">
		<a href="" class="btn mr-2">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/>
			</svg>
		</a>
		<a href="{{ route('backend.profile.edit') }}" class="btn">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
			</svg>
		</a>
	</section>
</section>

<div class="card">
	<div class="card-body">
		{{-- Name --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Name') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ auth()->user()->name }}</p>
			</div>
		</div>
		{{-- Email --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Email') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ auth()->user()->email }}</p>
			</div>
		</div>
		{{-- Avatar --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Avatar') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if (auth()->user()->avatar)
					<img src="{{ asset('storage/users/avatars/'.auth()->user()->avatar) }}" id="avatar-preview" class="h-20 rounded-full">
				@else
					<img src="{{ asset('img/default-avatar.png') }}" id="avatar-preview" class="h-20 rounded-full">
				@endif
			</div>
		</div>
		{{-- Cover --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Cover') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if (auth()->user()->cover)
					<img src="{{ asset('storage/users/covers/'.auth()->user()->cover) }}" id="cover-preview" class="h-32">
				@else
					<img src="{{ asset('img/default-cover.png') }}" id="cover-preview" class="h-32">
				@endif
			</div>
		</div>
		{{-- Status --}}
		<div class="flex flex-wrap">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Status') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ (auth()->user()->active) ? __('Active') : __('Disable') }}</p>
			</div>
		</div>
	</div>
</div>

@endsection