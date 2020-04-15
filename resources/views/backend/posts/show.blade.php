@extends('backend.layouts.app')

@section('title', __('Viewing Post'))

@section('content')

<section class="page-header">
	<h4 class="text-2xl">{{ __('Post') }} "<span class="text-info">{{ $post->title }}</span>"</h4>
	@canany(['browse-posts','edit-posts'])
		<section>
			@can('browse-posts')
				<a href="{{ route('backend.posts.index') }}" class="btn mr-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					  <path d="M9 10h1a1 1 0 000-2H9a1 1 0 000 2zm0 2a1 1 0 000 2h6a1 1 0 000-2zm11-3.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0 .88.88 0 00-.33-.11H7a3 3 0 00-3 3v14a3 3 0 003 3h10a3 3 0 003-3V9v-.06zm-6-3.53L16.59 8H15a1 1 0 01-1-1zM18 19a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3zm-3-3H9a1 1 0 000 2h6a1 1 0 000-2z"/>
					</svg>
				</a>
			@endcan
			@can('edit-posts')
				<a href="{{ route('backend.posts.edit', $post->id) }}" class="btn">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
						<path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
					</svg>
				</a>
			@endcan
		</section>
	@endcanany
</section>

<div class="card">
	<div class="card-header">{{ __('Post Details') }}</div>
	<div class="card-body">
		{{-- Author --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Author') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $post->user->name }}</p>
			</div>
		</div>
		{{-- Title --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Title') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $post->title }}</p>
			</div>
		</div>
		{{-- Category --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Category') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ $post->category->name }}</p>
			</div>
		</div>
		{{-- Excerpt --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Excerpt') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<a href="" class="btn mb-3 text-xs toggle-collapse">{{ __('Show Content') }}</a>
				<div class="collapse">
					<p>{!! $post->excerpt !!}</p>
				</div>
			</div>
		</div>
		{{-- Body --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Body') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<a href="" class="btn mb-3 text-xs toggle-collapse">{{ __('Show Content') }}</a>
				<div class="collapse">
					<p>{!! $post->body !!}</p>
				</div>
			</div>
		</div>
		{{-- Status --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Status') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ Str::title($post->status) }}</p>
			</div>
		</div>
		{{-- Featured --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Featured') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				{{ ($post->featured) ? __('Yes') : __('No') }}
			</div>
		</div>
		{{-- Image --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Image') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->image)
					<img src="{{ asset('storage/posts/images/'.$post->image) }}" class="img-fluid shadow">
				@else
					{{ __('No Image Available') }}
				@endif
			</div>
		</div>
		{{-- Image URL --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Image URL') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->image_url)
					<img src="{{ $post->image_url }}" class="img-fluid shadow">
					<div class="mt-2">{{ $post->image_url }}</div>
				@else
					{{ __('No Image URL Available') }}
				@endif
			</div>
		</div>
		{{-- Video --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Video') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->video)
					<div class="border-4 border-gray-800 shadow-md">
						<video width="100%" height="auto" controls>
							<source src="{{ asset('storage/posts/videos/'.$post->video) }}" type="video/mp4">
							<span>{{ __('Your browser does not support the video tag.') }}</span>
						</video>
					</div>
				@else
					{{ __('No Video Available') }}
				@endif
			</div>
		</div>
		{{-- Video URL --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Video URL') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->video_url)
					<img src="{{ $post->video_url }}" class="img-fluid shadow">
					<div class="mt-2">{{ $post->video_url }}</div>
				@else
					{{ __('No Video URL Available') }}
				@endif
			</div>
		</div>
		{{-- SEO Title --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('SEO Title') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->seo_title)
					{{ $post->seo_title }}
				@else
					{{ __('No Available') }}
				@endif
			</div>
		</div>
		{{-- Meta Description --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Meta Description') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->meta_description)
					{{ $post->meta_description }}
				@else
					{{ __('No Available') }}
				@endif
			</div>
		</div>
		{{-- Meta Keywords --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Meta Keywords') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->meta_keywords)
					{{ $post->meta_keywords }}
				@else
					{{ __('No Available') }}
				@endif
			</div>
		</div>
		{{-- Tags --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Tags') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				@if ($post->tags->count())
					<div class="flex flex-wrap">
						@foreach ($post->tags as $tag)
							<span class="bg-blue-900 shadow rounded m-1 px-2 py-1 text-sm">{{ $tag->name }}</span>
						@endforeach
					</div>
				@else
					{{ __('No Tags Available') }}
				@endif
			</div>
		</div>
		{{-- Views --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5">
				<p class="text-sm font-bold mb-2">{{ __('Views') }}</p>
			</div>
			<div class="w-full md:w-4/5">
				<p>{{ Str::title($post->views) }}</p>
			</div>
		</div>
	</div>
</div>

@if (count($post->comments))
	<div class="card">
		<div class="card-header flex justify-between">
			<span>{{ __('Comments') }}</span>
			<span>{{ __('Total: ') }} {{ count($post->comments) }}</span>
		</div>
		<div class="card-body">
			<div class="table-container">
				<table class="table" id="comments-table">
					<thead>
						<tr>
							<th>
								<div class="table-checkbox">
									<label>
										<input type="checkbox" class="form-checkbox">
									</label>
								</div>
							</th>
							<th>{{ __('Comment') }}</th>
							<th>{{ __('Author') }}</th>
							<th>{{ __('Created At') }}</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach ($post->comments as $comment)
							<tr>
								<td>
									<div class="table-checkbox">
										<label>
											<input type="checkbox" class="form-checkbox">
										</label>
									</div>
								</td>
								<td>
									<span class="table-label">{{ __('Comment') }}</span>
									<span class="table-content">{{ Str::words($comment->body, 10, ' ...') }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Author') }}</span>
									<span class="table-content">{{ $comment->user->name }}</span>
								</td>
								<td>
									<span class="table-label">{{ __('Created At') }}</span>
									<span class="table-content">{{ $comment->created_at->diffForHumans() }}</span>
								</td>
								<td>
									<div class="table-options">
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

@endsection

@section('scripts')
	@include('backend.partials.toggle-collapse')
	@if (count($post->comments))
		<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
		<script src="{{ asset('vendor/datatables/src/js/jquery.dataTables.min.js') }}"></script>
		<script>
			$(document).ready(function() {
				$('#comments-table').DataTable({
					// "language": {
					// 	"url": "{{ asset('vendor/datatables/Spanish.json') }}"
					// },
					"order": ([2,'desc']),
					"columns": [
						{ "orderable": false },
						null,
						null,
						null,
						{ "orderable": false }
					]
				});
			} );
		</script>
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
							  	// destroyBtn[i].nextElementSibling.submit();
							  }
							});
						})
					}
				{{-- Delete Action Corfirmation --}}
			</script>
		@endcan
	@endif
@endsection

