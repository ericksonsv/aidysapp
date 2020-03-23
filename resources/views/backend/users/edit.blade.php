@extends('backend.layouts.app')

@section('title', __('Edit User'))

@section('content')

	<section class="page-header">
		<h4 class="text-2xl">{{ __('Editing to') }} {{ $user->name }}</h4>
		<section>
			<a href="{{ route('backend.users.index') }}" class="btn">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
				  <path d="M12.3,12.22A4.92,4.92,0,0,0,14,8.5a5,5,0,0,0-10,0,4.92,4.92,0,0,0,1.7,3.72A8,8,0,0,0,1,19.5a1,1,0,0,0,2,0,6,6,0,0,1,12,0,1,1,0,0,0,2,0A8,8,0,0,0,12.3,12.22ZM9,11.5a3,3,0,1,1,3-3A3,3,0,0,1,9,11.5Zm9.74.32A5,5,0,0,0,15,3.5a1,1,0,0,0,0,2,3,3,0,0,1,3,3,3,3,0,0,1-1.5,2.59,1,1,0,0,0-.5.84,1,1,0,0,0,.45.86l.39.26.13.07a7,7,0,0,1,4,6.38,1,1,0,0,0,2,0A9,9,0,0,0,18.74,11.82Z"/>
				</svg>
			</a>
		</section>
	</section>

	<form action="{{ route('backend.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" id="user-edit-form">
		@method('PATCH')
		@include('backend.users._form', ['btnText' => __('Update')])
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
					  	axios.post('{{ route('backend.users.delete-avatar', $user->id) }}')
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
					  	axios.post('{{ route('backend.users.delete-cover', $user->id) }}')
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