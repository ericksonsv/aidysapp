@extends('backend.layouts.app')

@section('title', __('Edit User'))

@section('content')

	<section class="page-header">
		<h4 class="text-2xl">{{ __('Editing to') }} {{ $user->name }}</h4>
	</section>

	<form action="{{ route('backend.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="user-edit-form">
		@method('PATCH')
		@include('backend.users.form', ['btnText' => __('Update')])
	</form>

@endsection

@section('scripts')
	@include('backend.partials.preview-image')
	<script>
		// Remove Avatar and Cover Image
		let user = new Vue({
			el: '#user-edit-form',
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