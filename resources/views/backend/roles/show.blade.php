@extends('backend.layouts.app')

@section('title', $role->name)

@section('content')

<section class="page-header">
	<h4 class="text-2xl">{{ __('Role') }} "{{ Str::title($role->name) }}"</h4>
	@canany(['browse-roles','edit-roles'])
		<section>
			@can('browse-roles')
				<a href="{{ route('backend.roles.index') }}" class="btn mr-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					  <path d="M20.71 16.71l-2.42-2.42a1 1 0 00-1.42 0l-3.58 3.58a1 1 0 00-.29.71V21a1 1 0 001 1h2.42a1 1 0 00.71-.29l3.58-3.58a1 1 0 000-1.42zM16 20h-1v-1l2.58-2.58 1 1zm-6 0H6a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3v1a1 1 0 002 0V9v-.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0L12.06 2H6a3 3 0 00-3 3v14a3 3 0 003 3h4a1 1 0 000-2zm3-14.59L15.59 8H14a1 1 0 01-1-1zM8 14h6a1 1 0 000-2H8a1 1 0 000 2zm0-4h1a1 1 0 000-2H8a1 1 0 000 2zm2 6H8a1 1 0 000 2h2a1 1 0 000-2z"/>
					</svg>
				</a>
			@endcan
			@can('edit-roles')
				<a href="{{ route('backend.roles.edit', $role->id) }}" class="btn">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						<path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
					</svg>
				</a>
			@endcan
		</section>
	@endcanany
</section>

<div class="card">
	<div class="card-body">
		{{-- Name --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Name') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $role->name }}</p>
			</div>
		</div>
		{{-- Label --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Label') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $role->label }}</p>
			</div>
		</div>
		{{-- Abilities --}}
		<div class="flex flex-wrap">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Abilities') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if (count($role->abilities))
					<div class="flex">
						@foreach ($role->abilities as $ability)
							<p class="flex items-center text-sm m-1">
								<svg class="w-5 h-5 text-blue-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
								  <path d="M10.21,14.75a1,1,0,0,0,1.42,0l4.08-4.08a1,1,0,0,0-1.42-1.42l-3.37,3.38L9.71,11.41a1,1,0,0,0-1.42,1.42ZM21,2H3A1,1,0,0,0,2,3V21a1,1,0,0,0,1,1H21a1,1,0,0,0,1-1V3A1,1,0,0,0,21,2ZM20,20H4V4H20Z"/>
								</svg>
								<span class="block ml-1">{{ $ability->ability_label }}</span>
							</p>
						@endforeach
					</div>
				@else
					<p>{{ __('No Abilities Assigned') }}</p>
				@endif
			</div>
		</div>
	</div>
</div>

@endsection