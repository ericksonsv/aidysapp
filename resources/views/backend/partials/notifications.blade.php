{{-- Login --}}
@if (session()->has('login'))
	<script>
		Toast.fire({
			icon: 'success',
			title: '{{ session()->get('login') }}',
			position: 'bottom-end'
		});
	</script>
@endif

{{-- Logout --}}
@if (session()->has('logout'))
	<script>
		Toast.fire({
			icon: 'success',
			title: '{{ session()->get('logout') }}',
			position: 'bottom-end'
		});
	</script>
@endif

{{-- Errors --}}
@if ($errors->any())
	<script>
		Toast.fire({
			icon: 'error',
			title: '{{ __('Please check the errors list bellow') }}'
		});
	</script>
@endif

{{-- Success --}}
@if (session()->has('success'))
	<script>
		Toast.fire({
			icon: 'success',
			title: '{{ session()->get('success') }}'
		});
	</script>
@endif

{{-- Warning --}}
@if (session()->has('warning'))
	<script>
		Toast.fire({
			icon: 'warning',
			title: '{{ session()->get('warning') }}'
		});
	</script>
@endif