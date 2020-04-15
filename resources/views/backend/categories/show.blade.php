@extends('backend.layouts.app')

@section('title', __('Viewing Category'))

@section('content')

<section class="page-header">
	<h4 class="text-2xl">{{ __('Category') }} "<span class="text-info">{{ $category->name }}</span>"</h4>
	@canany(['browse-categories','edit-categories'])
		<section>
			@can('browse-categories')
				<a href="{{ route('backend.categories.index') }}" class="btn mr-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					  <path d="M2.5,8.86l9,5.2a1,1,0,0,0,1,0l9-5.2A1,1,0,0,0,22,8a1,1,0,0,0-.5-.87l-9-5.19a1,1,0,0,0-1,0l-9,5.19A1,1,0,0,0,2,8,1,1,0,0,0,2.5,8.86ZM12,4l7,4-7,4L5,8Zm8.5,7.17L12,16,3.5,11.13a1,1,0,0,0-1.37.37,1,1,0,0,0,.37,1.36l9,5.2a1,1,0,0,0,1,0l9-5.2a1,1,0,0,0,.37-1.36A1,1,0,0,0,20.5,11.13Zm0,4L12,20,3.5,15.13a1,1,0,0,0-1.37.37,1,1,0,0,0,.37,1.36l9,5.2a1,1,0,0,0,1,0l9-5.2a1,1,0,0,0,.37-1.36A1,1,0,0,0,20.5,15.13Z"/>
					</svg>
				</a>
			@endcan
			@can('edit-categories')
				<a href="{{ route('backend.categories.edit', $category->id) }}" class="btn">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						<path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
					</svg>
				</a>
			@endcan
		</section>
	@endcanany
</section>

<div class="card">
	<div class="card-header">{{ __('Category Details') }}</div>
	<div class="card-body">
		{{-- Name --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Name') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $category->name }}</p>
			</div>
		</div>
		{{-- Description --}}
		<div class="flex flex-wrap">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Description') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $category->description }}</p>
			</div>
		</div>
	</div>
</div>

@canany(['browse-posts','read-posts','edit-posts','destroy-posts'])
	@if (count($category->posts))
		<div class="card">
			<div class="card-header flex justify-between">
				<section class="flex items-center">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					  <path d="M9 10h1a1 1 0 000-2H9a1 1 0 000 2zm0 2a1 1 0 000 2h6a1 1 0 000-2zm11-3.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0 .88.88 0 00-.33-.11H7a3 3 0 00-3 3v14a3 3 0 003 3h10a3 3 0 003-3V9v-.06zm-6-3.53L16.59 8H15a1 1 0 01-1-1zM18 19a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3zm-3-3H9a1 1 0 000 2h6a1 1 0 000-2z"/>
					</svg>
					<span class="ml-2">{{ __('Related Posts') }}</span>
				</section>
				<section>{{ __('Total: ') }}{{ count($category->posts) }}</section>
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
								<th>{{ __('Author') }}</th>
								<th>{{ __('Title') }}</th>
								<th>{{ __('Status') }}</th>
								<th>{{ __('Featured') }}</th>
								<th>{{ __('Created At') }}</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($category->posts as $post)
							<tr>
								<td>
									<div class="table-checkbox">
										<label>
											<input type="checkbox" class="form-checkbox">
										</label>
									</div>
								</td>
								<td>
									<span class="table-label">{{ __('Author') }}</span>
									<span class="table-content">{{ $post->user->name }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Title') }}</span>
									<span class="table-content">{{ $post->title }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Status') }}</span>
									<span class="table-content">{{ $post->status }}</span>
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
	@endif
@endcanany

@endsection

@if (count($category->posts))
@section('scripts')
	<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/src/js/jquery.dataTables.min.js') }}"></script>
	@if (count($category->posts))
		@can('browse-posts')
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
		@endcan
	@endif
	@can('destroy-posts')
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
	@endcan
@endsection
@endif