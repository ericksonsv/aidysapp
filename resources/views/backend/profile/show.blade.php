@extends('backend.layouts.app')

@section('title', auth()->user()->name)

@section('content')

<section class="page-header">
	<h4 class="text-2xl">{{ __('My Profile') }}</h4>
	<section class="flex items-center">
		<a href="{{ route('backend.dashboard') }}" class="btn mr-2">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
			  <path d="M20 8l-6-5.26a3 3 0 00-4 0L4 8a3 3 0 00-1 2.26V19a3 3 0 003 3h12a3 3 0 003-3v-8.75A3 3 0 0020 8zm-6 12h-4v-5a1 1 0 011-1h2a1 1 0 011 1zm5-1a1 1 0 01-1 1h-2v-5a3 3 0 00-3-3h-2a3 3 0 00-3 3v5H6a1 1 0 01-1-1v-8.75a1 1 0 01.34-.75l6-5.25a1 1 0 011.32 0l6 5.25a1 1 0 01.34.75z"/>
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
		{{-- Role --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Role') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ auth()->user()->role_name }}</p>
			</div>
		</div>
		{{-- Abilities --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Direct Abilities') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if (count(auth()->user()->abilities))
					<div class="flex items-center">
						@foreach (auth()->user()->abilities as $ability)
							<p class="flex items-center text-sm mr-2">
								<svg class="w-5 h-5 text-blue-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								  <path d="M10.21,14.75a1,1,0,0,0,1.42,0l4.08-4.08a1,1,0,0,0-1.42-1.42l-3.37,3.38L9.71,11.41a1,1,0,0,0-1.42,1.42ZM21,2H3A1,1,0,0,0,2,3V21a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V3A1,1,0,0,0,21,2ZM20,20H4V4H20Z"/>
								</svg>
								<span class="block ml-1">{{ $ability->ability_label }}</span>
							</p>
						@endforeach
					</div>
				@else
					<p>{{ __('No Direct Abilities Assigned') }}</p>
				@endif
			</div>
		</div>
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