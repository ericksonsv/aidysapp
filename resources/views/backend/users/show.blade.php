@extends('backend.layouts.app')

@section('title', $user->name)

@section('content')

<section class="page-header">
	<h4 class="text-2xl">{{ $user->name }}</h4>
	@canany(['browse-users','edit-users'])
		<section class="flex items-center">
			@can('browse-users')
				<a href="{{ route('backend.users.index') }}" class="btn mr-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					  <path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/>
					</svg>
				</a>
			@endcan
			@can('edit-users')
				<a href="{{ route('backend.users.edit', $user->id) }}" class="btn">
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
		{{-- Role --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Role') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $user->role_name }}</p>
			</div>
		</div>
		{{-- Abilities --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Direct Abilities') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if (count($user->abilities))
					<div class="flex items-center">
						@foreach ($user->abilities as $ability)
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
				<p>{{ $user->name }}</p>
			</div>
		</div>
		{{-- Email --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Email') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $user->email }}</p>
			</div>
		</div>
		{{-- Avatar --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Avatar') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($user->avatar)
					<img src="{{ asset('storage/users/avatars/'.$user->avatar) }}" id="avatar-preview" class="h-20 rounded-full">
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
				@if ($user->cover)
					<img src="{{ asset('storage/users/covers/'.$user->cover) }}" id="cover-preview" class="h-32">
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
				<p>{{ ($user->active) ? __('Active') : __('Disable') }}</p>
			</div>
		</div>
	</div>
</div>

@canany(['browse-posts','read-posts','edit-posts','destroy-posts'])
	@if (count($user->posts))
		<div class="card">
			<div class="card-header flex justify-between">
				<section class="flex items-center">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					  <path d="M9 10h1a1 1 0 000-2H9a1 1 0 000 2zm0 2a1 1 0 000 2h6a1 1 0 000-2zm11-3.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0 .88.88 0 00-.33-.11H7a3 3 0 00-3 3v14a3 3 0 003 3h10a3 3 0 003-3V9v-.06zm-6-3.53L16.59 8H15a1 1 0 01-1-1zM18 19a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3zm-3-3H9a1 1 0 000 2h6a1 1 0 000-2z"/>
					</svg>
					<span class="ml-2">{{ __('User Posts') }}</span>
				</section>
				<section>{{ __('Total: ') }} {{ count($user->posts) }}</section>
			</div>
			<div class="card-body">
				<div class="table-container">
					<table class="table" id="posts-table">
						<thead>
							<tr>
								<th>
									<div class="table-checkbox">
										<label>
											<input type="checkbox" class="form-checkbox">
										</label>
									</div>
								</th>
								<th>{{ __('Title') }}</th>
								<th>{{ __('Category') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Featured') }}</th>
								<th>{{ __('Created At') }}</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($user->posts as $post)
							<tr>
								<td>
									<div class="table-checkbox">
										<label>
											<input type="checkbox" class="form-checkbox">
										</label>
									</div>
								</td>
								<td>
									<span class="table-label">{{ __('Title') }}</span>
									<span class="table-content">{{ $post->title }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Category') }}</span>
									<span class="table-content">{{ $post->category->name }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Status') }}</span>
									<span class="table-content">{{ Str::title($post->status) }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Featured') }}</span>
									<span class="table-content">{{ ($post->featured) ? __('Yes') : __('No') }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Created At') }}</span>
									<span class="table-content">{{ $post->created_at->diffForHumans() }}</span>
								</td>
								<td>
									<div class="table-options">
										@can('read-posts')
											<a href="{{ route('backend.posts.show', $post->id) }}" class="table-btn btn-table-show">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/>
												</svg>
											</a>
										@endcan
										@can('edit-posts')
											<a href="{{ route('backend.posts.edit', $post->id) }}" class="table-btn btn-table-edit">
												<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
													<path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
												</svg>
											</a>
										@endcan
										@can('destroy-posts')
										<a href="{{ route('backend.posts.destroy', $post->id) }}" class="table-btn btn-table-destroy destroy-btn">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
												<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
											</svg>
										</a>
										<form id="backend-posts-destroy-{{$post->id}}" action="{{ route('backend.posts.destroy', $post->id) }}" method="POST" style="display: none;">
											@csrf
											@method('DELETE')
										</form>
										@endcan
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	@else
		<div class="card">
			<div class="card-body flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				  <path d="M9 10h1a1 1 0 000-2H9a1 1 0 000 2zm0 2a1 1 0 000 2h6a1 1 0 000-2zm11-3.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0 .88.88 0 00-.33-.11H7a3 3 0 00-3 3v14a3 3 0 003 3h10a3 3 0 003-3V9v-.06zm-6-3.53L16.59 8H15a1 1 0 01-1-1zM18 19a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3zm-3-3H9a1 1 0 000 2h6a1 1 0 000-2z"/>
				</svg>
				<span class="ml-2">{{ __("You Don't Have Any Post") }}</span>
			</div>
		</div>
	@endif
@endcanany

@canany(['browse-videos','read-videos','edit-videos','destroy-videos'])
	@if (count($user->videos))
	<div class="card">
		<div class="card-header flex justify-between">
			<section class="flex items-center">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path d="M21.53 7.15a1 1 0 00-1 0L17 8.89A3 3 0 0014 6H5a3 3 0 00-3 3v6a3 3 0 003 3h9a3 3 0 003-2.89l3.56 1.78A1 1 0 0021 17a1 1 0 00.53-.15A1 1 0 0022 16V8a1 1 0 00-.47-.85zM15 15a1 1 0 01-1 1H5a1 1 0 01-1-1V9a1 1 0 011-1h9a1 1 0 011 1zm5-.62l-3-1.5v-1.76l3-1.5z"/>
				</svg>
				<span class="ml-2">{{ __('User Videos') }}</span>
			</section>
			<section>{{ __('Total: ') }}{{ count($user->videos) }}</section>
		</div>
		<div class="card-body">
			<div class="table-container">
				<table class="table" id="videos-table">
					<thead>
						<tr>
							<th>
								<div class="flex items-center justify-center">
									<label class="flex items-center">
										<input type="checkbox" class="form-checkbox">
									</label>
								</div>
							</th>
							<th>{{ __('Title') }}</th>
							<th>{{ __('Category') }}</th>
							<th>{{ __('Status') }}</th>
							<th>{{ __('Featured') }}</th>
							<th>{{ __('Created At') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($user->videos as $video)
						<tr>
							<td>
								<div class="table-checkbox">
									<label>
										<input type="checkbox" class="form-checkbox">
									</label>
								</div>
							</td>
							<td>
								<span class="table-label">{{ __('Title') }}</span>
								<span class="table-content">{{ $video->title }}</span>
							</td>
							<td>
								<span class="table-label">{{ __('Category') }}</span>
								<span class="table-content"><a href="{{ route('backend.categories.show', $video->category->id) }}">{{ $video->category->name }}</a></span>
							</td>
							<td>
								<span class="table-label">{{ __('Status') }}</span>
								<span class="table-content">{{ Str::title($video->status) }}</span>
							</td>
							<td>
								<span class="table-label">{{ __('Featured') }}</span>
								<span class="table-content">{{ ($video->featured) ? __('Yes') : __('No') }}</span>
							</td>
							<td>
								<span class="table-label">{{ __('Created At') }}</span>
								<span class="table-content">{{ $video->created_at->diffForHumans() }}</span>
							</td>
							<td>
								<div class="table-options">
									@can('read-videos')
									<a href="{{ route('backend.videos.show', $video->id) }}" class="table-btn btn-table-show">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
											<path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/>
										</svg>
									</a>
									@endcan
									@can('edit-videos')
									<a href="{{ route('backend.videos.edit', $video->id) }}" class="table-btn btn-table-edit">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
											<path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
										</svg>
									</a>
									@endcan
									@can('destroy-videos')
									<a href="{{ route('backend.videos.destroy', $video->id) }}" class="table-btn btn-table-destroy destroy-btn">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
											<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
										</svg>
									</a>
									<form id="backend-videos-destroy-{{$video->id}}" action="{{ route('backend.videos.destroy', $video->id) }}" method="video" style="display: none;">
										@csrf
										@method('DELETE')
									</form>
									@endcan
								</div>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	@else
	<div class="card">
		<div class="card-body flex items-center">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				<path d="M21.53 7.15a1 1 0 00-1 0L17 8.89A3 3 0 0014 6H5a3 3 0 00-3 3v6a3 3 0 003 3h9a3 3 0 003-2.89l3.56 1.78A1 1 0 0021 17a1 1 0 00.53-.15A1 1 0 0022 16V8a1 1 0 00-.47-.85zM15 15a1 1 0 01-1 1H5a1 1 0 01-1-1V9a1 1 0 011-1h9a1 1 0 011 1zm5-.62l-3-1.5v-1.76l3-1.5z"/>
			</svg>
			<span class="ml-2">{{ __("You Don't Have Any Video") }}</span>
		</div>
	</div>
	@endif
@endcanany

@endsection

@section('scripts')
	<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/src/js/jquery.dataTables.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#posts-table').DataTable({
				// "language": {
				// 	"url": "{{ asset('vendor/datatables/Spanish.json') }}"
				// },
				"order": ([2,'desc']),
				"columns": [
					{ "orderable": false },
					null,
					null,
					null,
					null,
					null,
					{ "orderable": false }
				]
			});
		} );
	</script>
	<script>
		$(document).ready(function() {
			$('#videos-table').DataTable({
				// "language": {
				// 	"url": "{{ asset('vendor/datatables/Spanish.json') }}"
				// },
				"order": ([2,'desc']),
				"columns": [
					{ "orderable": false },
					null,
					null,
					null,
					null,
					null,
					{ "orderable": false }
				]
			});
		} );
	</script>
	@canany(['destroy-posts','destroy-videos'])
		<script>
			{{-- Delete Action Corfirmation --}}
				let destroyBtn = document.querySelectorAll('.destroy-btn');
				for (let i = 0; i < destroyBtn.length; i++) {
					destroyBtn[i].addEventListener('click', e => {
						e.preventDefault();
						Swal.fire({
						  title: '{{ __('Are you sure?') }}',
						  icon: 'warning',
						  showCancelButton: true,
						  confirmButtonColor: '#3085d6',
						  cancelButtonColor: '#d33',
						  confirmButtonText: '{{ __('Yes, delete it!')}}'
						}).then((result) => {
						  if (result.value) {
						  	console.log('Deleted');
						  	destroyBtn[i].nextElementSibling.submit();
						  }
						});
					})
				}
			{{-- Delete Action Corfirmation --}}
		</script>
	@endcanany
@endsection