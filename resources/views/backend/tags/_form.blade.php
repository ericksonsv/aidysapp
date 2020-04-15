@csrf

<div class="card">
	<div class="card-body">
		{{-- Name --}}
		<div class="flex flex-wrap">
			<div class="flex items-center w-full md:w-1/5"><label for="name">{{ __('Name') }}</label></div>
			<div class="w-full md:w-4/5">
				<input type="text" name="name" id="name" class="input @error('name') input-error @enderror" value="{{ old('name', $tag->name) }}">
				@error('name')
					<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
	</div>
	<div class="card-footer flex justify-end">
		<a href="{{ route('backend.tags.index') }}" class="btn mr-1">{{ __('Cancel') }}</a>
		<button class="btn">{{ $btnText }}</button>
	</div>
</div>