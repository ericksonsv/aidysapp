@extends('backend.layouts.app')

@section('title', __('Create User'))

@section('content')

	<section class="page-header">
		<h4 class="text-2xl">{{ __('Creating User') }}</h4>
	</section>

	<form action="{{ route('backend.users.store') }}" method="POST" enctype="multipart/form-data">
		@include('backend.users.form', ['btnText' => __('Create')])
	</form>

@endsection

@section('scripts')
	@include('backend.partials.preview-image')
@endsection