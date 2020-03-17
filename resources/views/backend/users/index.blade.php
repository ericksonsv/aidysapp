@extends('backend.layouts.app')

@section('title', __('Users Management'))

@section('content')
	<section class="page-header">
		<h4 class="text-2xl">{{ __('Users Management') }}</h4>
		<section>
			<a href="{{ route('backend.users.create') }}" class="btn">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
					<path d="M19,11H13V5a1,1,0,0,0-2,0v6H5a1,1,0,0,0,0,2h6v6a1,1,0,0,0,2,0V13h6a1,1,0,0,0,0-2Z"/>
				</svg>
			</a>
		</section>
	</section>

	<div class="table-container">
		<table class="table" id="users-table">
			<thead>
				<tr>
					<th>
						<div class="flex items-center justify-center">
							<label class="flex items-center">
								<input type="checkbox" class="form-checkbox">
							</label>
						</div>
					</th>
					<th style="width: 100px">{{ __('Avatar') }}</th>
					<th>{{ __('Name') }}</th>
					<th>{{ __('Email') }}</th>
					<th>{{ __('Status') }}</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td>
							<div class="flex items-center justify-center">
								<label class="flex items-center">
									<input type="checkbox" class="form-checkbox">
								</label>
							</div>
						</td>
						<td>
							<div class="flex items-center justify-center">
								@if ($user->avatar)
									<img src="{{ asset('storage/users/avatars/'.$user->avatar) }}" id="avatar-preview" class="h-6 rounded-full">
								@else
									<img src="{{ asset('img/default-avatar.png') }}" id="avatar-preview" class="h-6 rounded-full">
								@endif
							</div>
						</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ ($user->active) ? __('Active') : __('Inactive') }}</td>
						<td>
							<div class="table-options">
								<a href="{{ route('backend.users.show', $user->id) }}">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
										<path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/>
									</svg>
								</a>
								<a href="{{ route('backend.users.edit', $user->id) }}">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
										<path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/>
									</svg>
								</a>
								<a href="{{ route('backend.users.destroy', $user->id) }}" class="btn-table destroy-btn">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
										<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
									</svg>
								</a>
								<form id="backend-users-destroy-{{$user->id}}" action="{{ route('backend.users.destroy', $user->id) }}" method="POST" style="display: none;">
									@csrf
									@method('DELETE')
								</form>
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('scripts')
	<script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('vendor/datatables/src/js/jquery.dataTables.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#users-table').DataTable({
				"language": {
					"url": "{{ asset('vendor/datatables/Spanish.json') }}"
				},
				"order": ([2,'desc']),
				"columns": [
					{ "orderable": false },
					{ "orderable": false },
					null,
					null,
					null,
					{ "orderable": false }
				]
			});
		} );
	</script>
	<script>
		// Update Users Status
		let usersTable = new Vue({
			el: '#users-table',
			methods: {
				changeUserStatus(id) {
					axios.post('/backend/users/'+id+'/change-status')
					.then(function (response) {
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
			}
		});
	</script>
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
@endsection