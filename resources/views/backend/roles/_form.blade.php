@csrf

<div class="card">
	<div class="card-body">
		{{-- Name --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="name">{{ __('Name') }}</label></div>
			<div class="w-full md:w-4/5">
				<input type="text" name="name" id="name" class="input @error('name') input-error @enderror" value="{{ old('name', $role->name) }}">
				@error('name')
					<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Label --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="name">{{ __('Label') }}</label></div>
			<div class="w-full md:w-4/5">
				<input type="text" name="label" id="label" class="input @error('label') input-error @enderror" value="{{ old('label', $role->label) }}">
				@error('label')
					<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Abilitiees --}}
		<div class="flex flex-wrap">
			<div class="flex items-center w-full md:w-1/5"><label for="abilities">{{ __('Abilities') }}</label></div>
			<div class="w-full md:w-4/5">
				<div class="flex flex-wrap -mx-1">
					@foreach ($abilities as $abilitiesGroup => $abilitiesAll)
					    <div class="w-full w-full lg:w-1/3 px-1 mb-2">
					    	<label class="flex items-center mb-2">
								<input type="checkbox" class="form-checkbox">
								<span class="ml-2 text-lg">{{ ucfirst($abilitiesGroup) }} {{ __('Permissions') }}</span>
							</label>
					    	@foreach ($abilitiesAll as $ability)
					    		<label class="flex items-center">
									<input type="checkbox" class="form-checkbox" name="abilities[]" value="{{ $ability->name }}" 
									{{ ($role->abilities->pluck('id')->contains($ability->id)) ? 'checked' : '' }}>
									<span class="ml-2 text-sm">{{ $ability->ability_label }}</span>
								</label>
					    	@endforeach
					    </div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<div class="card-footer flex justify-end">
		<a href="{{ route('backend.roles.index') }}" class="btn mr-1">{{ __('Cancel') }}</a>
		<button class="btn">{{ $btnText }}</button>
	</div>
</div>