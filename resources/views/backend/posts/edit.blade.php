@extends('backend.layouts.app')

@section('title', __('Edit Post'))

@section('styles')
	<link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
@endsection

@section('content')

	<section class="page-header">
		<h4 class="text-2xl">{{ __('Editing') }} "<span class="text-info">{{ $post->title }}</span>" {{ __('Post') }}</h4>
		@can('browse-posts')
			<section>
				<a href="{{ route('backend.posts.index') }}" class="btn">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					  <path d="M9 10h1a1 1 0 000-2H9a1 1 0 000 2zm0 2a1 1 0 000 2h6a1 1 0 000-2zm11-3.06a1.31 1.31 0 00-.06-.27v-.09a1.07 1.07 0 00-.19-.28l-6-6a1.07 1.07 0 00-.28-.19.32.32 0 00-.09 0 .88.88 0 00-.33-.11H7a3 3 0 00-3 3v14a3 3 0 003 3h10a3 3 0 003-3V9v-.06zm-6-3.53L16.59 8H15a1 1 0 01-1-1zM18 19a1 1 0 01-1 1H7a1 1 0 01-1-1V5a1 1 0 011-1h5v3a3 3 0 003 3h3zm-3-3H9a1 1 0 000 2h6a1 1 0 000-2z"/>
					</svg>
				</a>
			</section>
		@endcan
	</section>

	<form action="{{ route('backend.posts.update', $post->id) }}" method="POST" id="post-edit-form" enctype="multipart/form-data">
		@method('PATCH')
		@include('backend.posts._form', ['btnText' => __('Update')])
	</form>

@endsection

@section('scripts')
	@include('backend.partials.preview-image')
	@include('backend.partials.preview-video')
	<script>
		// Remove Image
		let postEditForm = new Vue({
			el: '#post-edit-form',
			methods: {
				deleteImage() {
					Swal.fire({
					  title: '{{ __('Are you sure?') }}',
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: '{{ __('Yes, delete it!')}}'
					}).then((result) => {
					  if (result.value) {
					  	axios.post('{{ route('backend.posts.delete-image', $post->id) }}')
					  	.then(function (response) {
					  		document.querySelector('#image-preview').style.display = 'none';
					  		document.querySelector('#delete-image-btn').style.display = 'none';
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
				deleteVideo() {
					Swal.fire({
					  title: '{{ __('Are you sure?') }}',
					  icon: 'warning',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: '{{ __('Yes, delete it!')}}'
					}).then((result) => {
					  if (result.value) {
					  	axios.post('{{ route('backend.posts.delete-video', $post->id) }}')
					  	.then(function (response) {
					  		document.querySelector('#video-preview').style.display = 'none';
					  		document.querySelector('#delete-video-btn').style.display = 'none';
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
			}
		});
	</script>
	<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/trumbowyg/dist/trumbowyg.min.js') }}"></script>
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() {
		    $('#tags').select2();
		});
	</script>
	<script>
		$('#excerpt').trumbowyg({
			removeformatPasted: true,
			btns: [
		        ['viewHTML'],
		        ['undo', 'redo'], // Only supported in Blink browsers
		        ['formatting'],
		        ['strong', 'em'],
		        ['link'],
		        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
		        ['unorderedList', 'orderedList'],
		        ['horizontalRule'],
		        ['removeformat'],
		        ['fullscreen']
		    ]
		});
		$('#body').trumbowyg({
			removeformatPasted: true,
			btns: [
		        ['viewHTML'],
		        ['undo', 'redo'], // Only supported in Blink browsers
		        ['formatting'],
		        ['strong', 'em'],
		        ['link'],
		        ['insertImage'],
		        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
		        ['unorderedList', 'orderedList'],
		        ['horizontalRule'],
		        ['removeformat'],
		        ['fullscreen']
		    ]
		});
	</script>
@endsection