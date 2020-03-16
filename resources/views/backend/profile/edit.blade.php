@extends('backend.layouts.app')

@section('title', auth()->user()->name.' '.__('Profile'))

@section('content')

<section class="page-header">
	<h4 class="text-2xl">{{ auth()->user()->name }} {{ __('Profile') }}</h4>
</section>

<form action="{{ route('backend.profile.update') }}" method="POST" enctype="multipart/form-data" id="auth-profile-form">
	@csrf
	@method('PATCH')
	<div class="card">
		<div class="card-body">
			{{-- Name --}}
			<div class="flex flex-wrap mb-8">
				<div class="flex items-center w-full md:w-1/5"><label for="name">{{ __('Name') }}</label></div>
				<div class="w-full md:w-4/5">
					<input type="text" name="name" id="name" class="input @error('name') input-error @enderror" value="{{ auth()->user()->name }}">
					@error('name')
						<p class="input-feedback mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
			{{-- Email --}}
			<div class="flex flex-wrap mb-8">
				<div class="flex items-center w-full md:w-1/5"><label for="email">{{ __('Email') }}</label></div>
				<div class="w-full md:w-4/5">
					<input type="email" name="email" id="email" class="input @error('email') input-error @enderror" value="{{ auth()->user()->email }}">
					@error('email')
						<p class="input-feedback mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
			{{-- Avatar --}}
			<div class="flex flex-wrap mb-8">
				<div class="flex items-center w-full md:w-1/5"><label for="email">{{ __('Avatar') }}</label></div>
				<div class="w-full md:w-4/5">
					<div class="mb-4">
						@if (auth()->user()->avatar)
							<div class="flex items-center mb-6 mt-1" id="delete-avatar">
								<img src="{{ asset('storage/users/avatars/'.auth()->user()->avatar) }}" id="avatar-preview" class="h-20 rounded-full">
								<button id="delete-avatar-btn" class="btn btn-sm ml-2" v-on:click.prevent="deleteAvatar">
									<svg class="fill-current w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
										<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
									</svg>
								</button>
							</div>
						@else
							<img src="{{ asset('img/default-avatar.png') }}" id="avatar-preview" class="h-20 rounded-full">
						@endif
					</div>
					<input type="file" name="avatar" id="avatar" class="input @error('avatar') input-error @enderror" value="{{ old('avatar') }}" onchange="previewImage('avatar-preview')">
					@error('avatar')
						<p class="input-feedback mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
			{{-- Cover --}}
			<div class="flex flex-wrap mb-8">
				<div class="flex items-center w-full md:w-1/5"><label for="email">{{ __('Cover') }}</label></div>
				<div class="w-full md:w-4/5">
					<div class="mb-4">
						@if (auth()->user()->cover)
							<div class="flex items-center mb-6 mt-1" id="delete-cover">
								<img src="{{ asset('storage/users/covers/'.auth()->user()->cover) }}" id="cover-preview" class="h-32">
								<button id="delete-cover-btn" class="btn btn-sm ml-2" v-on:click.prevent="deleteCover">
									<svg class="fill-current w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
										<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
									</svg>
								</button>
							</div>
						@else
							<img src="{{ asset('img/default-cover.png') }}" id="cover-preview" class="h-32">
						@endif
					</div>
					<input type="file" name="cover" id="cover" class="input @error('cover') input-error @enderror" value="{{ old('cover') }}" onchange="previewImage('cover-preview')">
					@error('cover')
						<p class="input-feedback mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
			{{-- Password --}}
			<div class="flex flex-wrap mb-8">
				<div class="flex items-center w-full md:w-1/5"><label for="password">{{ __('Password') }}</label></div>
				<div class="w-full md:w-4/5">
					<input type="password" name="password" id="password" class="input @error('password') input-error @enderror">
					@error('password')
						<p class="input-feedback mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
			{{-- Password Confirmation --}}
			<div class="flex flex-wrap">
				<div class="flex items-center w-full md:w-1/5"><label for="password_cofirm">{{ __('Password Confirm') }}</label></div>
				<div class="w-full md:w-4/5"><input type="password" name="password_confirmation" id="password_cofirm" class="input"></div>
			</div>
		</div>
		<div class="card-footer flex justify-end">
			<a href="{{ route('backend.profile.show') }}" class="btn mr-1">{{ __('Cancel') }}</a>
			<button class="btn">{{ __('Save') }}</button>
		</div>
	</div>
</form>

@endsection

@section('scripts')
	@include('backend.partials.preview-image')
	<script>
		// Remove Avatar and Cover Image
		let user = new Vue({
			el: '#auth-profile-form',
			methods: {
				deleteAvatar() {
					Swal.fire({
					  title: '{{ __('Are you sure?') }}',
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: '{{ __('Yes, delete it!')}}'
					}).then((result) => {
					  if (result.value) {
					  	axios.post('/backend/profile/delete-avatar')
					  	.then(function (response) {
					  		document.querySelector('#avatar-preview').src = '{{ asset('img/default-avatar.png') }}';
					  		document.querySelector('#delete-avatar-btn').style.display = 'none';
					  		Toast.fire({
					  			icon: 'success',
					  			title: response.data
					  		});
					  	})
					  	.catch(function (error) {
					  		Toast.fire({
					  			icon: 'error',
					  			title: response.data
					  		});
					  	});
					  }
					});
				},
				deleteCover() {
					Swal.fire({
					  title: '{{ __('Are you sure?') }}',
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: '{{ __('Yes, delete it!')}}'
					}).then((result) => {
					  if (result.value) {
					  	axios.post('/backend/profile/delete-cover')
					  	.then(function (response) {
					  		document.querySelector('#cover-preview').src = '{{ asset('img/default-cover.png') }}';
					  		document.querySelector('#delete-cover-btn').style.display = 'none';
					  		Toast.fire({
					  			icon: 'success',
					  			title: response.data
					  		});
					  	})
					  	.catch(function (error) {
					  		Toast.fire({
					  			icon: 'error',
					  			title: response.data
					  		});
					  	});
					  }
					});
				}
			}
		});
	</script>
@endsection