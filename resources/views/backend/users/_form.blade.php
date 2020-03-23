@csrf

<div class="card">
	<div class="card-body">
		{{-- Role --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="role">{{ __('Role') }}</label></div>
			<div class="w-full md:w-4/5">
				<select name="role" id="role" class="input">
					@foreach ($roles as $role)
						<option value="{{ $role->id }}" {{ ($user->role) ? ($user->role->id === $role->id) ? 'selected' : '' : '' }}>
							{{ ($role->label) ? $role->label : Str::title(str_replace('-',' ', $role->name)) }}
						</option>
					@endforeach
				</select>
				@error('role')
					<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Abilities --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="name">{{ __('Direct Abilities') }}</label></div>
			<div class="w-full md:w-4/5">
				<div class="h-32 p-4 rounded bg-gray-800 border-gray-700 border-2 shadow-md overflow-y-auto">					
					<div>
						@foreach ($abilities as $abilitiesGroup => $abilitiesAll)
						<div class="mb-4">
							<p class="text-lg mb-2">{{ ucfirst($abilitiesGroup) }} {{ __('Permissions') }}</p>
							@foreach ($abilitiesAll as $ability)
							<label class="flex items-center">
								<input type="checkbox" class="form-checkbox" name="abilities[]" value="{{ $ability->name }}" 
								{{ ($user->abilities->pluck('id')->contains($ability->id)) ? 'checked' : '' }}
								>
								<span class="ml-2">{{ $ability->ability_label }}</span>
							</label>
							@endforeach
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
		{{-- Name --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="name">{{ __('Name') }}</label></div>
			<div class="w-full md:w-4/5">
				<input type="text" name="name" id="name" class="input @error('name') input-error @enderror" value="{{ old('name', $user->name) }}">
				@error('name')
					<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Email --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="email">{{ __('Email') }}</label></div>
			<div class="w-full md:w-4/5">
				<input type="email" name="email" id="email" class="input @error('email') input-error @enderror" value="{{ old('email', $user->email) }}">
				@error('email')
					<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Avatar --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="email">{{ __('Avatar') }}</label></div>
			<div class="w-full md:w-4/5">
				<div class="mb-4">
					@if ($user->avatar)
						<div class="flex items-center mb-6 mt-1" id="delete-avatar">
							<img src="{{ asset('storage/users/avatars/'.$user->avatar) }}" id="avatar-preview" class="h-20 rounded-full">
							<button id="delete-avatar-btn" class="btn btn-sm ml-2" v-on:click.prevent="deleteAvatar">
								<svg class="fill-current w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
									<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
								</svg>
							</button>
						</div>
					@else
						<img src="{{ asset('img/default-avatar.png') }}" id="avatar-preview" class="h-20 rounded-full">
					@endif
				</div>
				<input type="file" name="avatar" id="avatar" class="input @error('avatar') input-error @enderror" value="{{ old('avatar') }}" onchange="previewImage('avatar-preview')">
				@error('avatar')
					<p class="input-feedback mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Cover --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="email">{{ __('Cover') }}</label></div>
			<div class="w-full md:w-4/5">
				<div class="mb-4">
					@if ($user->cover)
						<div class="flex items-center mb-6 mt-1" id="delete-cover">
							<img src="{{ asset('storage/users/covers/'.$user->cover) }}" id="cover-preview" class="h-32">
							<button id="delete-cover-btn" class="btn btn-sm ml-2" v-on:click.prevent="deleteCover">
								<svg class="fill-current w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
									<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
								</svg>
							</button>
						</div>
					@else
						<img src="{{ asset('img/default-cover.png') }}" id="cover-preview" class="h-32">
					@endif
				</div>
				<input type="file" name="cover" id="cover" class="input @error('cover') input-error @enderror" value="{{ old('cover') }}" onchange="previewImage('cover-preview')">
				@error('cover')
					<p class="input-feedback mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Status --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="email">{{ __('Status') }}</label></div>
			<div class="w-full md:w-4/5">
				<select name="status" id="status" class="input">
					<option value="1" {{ ($user->active === 1 || old('active') === 1) ? 'selected' : '' }}>{{ __('Active') }}</option>
					<option value="0" {{ ($user->active === 0 || old('active') === 0) ? 'selected' : '' }}>{{ __('Inactive') }}</option>
				</select>
				@error('status')
				<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Password --}}
		<div class="flex flex-wrap mb-8">
			<div class="flex items-center w-full md:w-1/5"><label for="password">{{ __('Password') }}</label></div>
			<div class="w-full md:w-4/5">
				<input type="password" name="password" id="password" class="input @error('password') input-error @enderror">
				@error('password')
					<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
				@enderror
			</div>
		</div>
		{{-- Password Confirmation --}}
		<div class="flex flex-wrap">
			<div class="flex items-center w-full md:w-1/5"><label for="password_cofirm">{{ __('Password Confirm') }}</label></div>
			<div class="w-full md:w-4/5"><input type="password" name="password_confirmation" id="password_cofirm" class="input"></div>
		</div>
	</div>
	<div class="card-footer flex justify-end">
		<a href="{{ route('backend.users.index') }}" class="btn mr-1">{{ __('Cancel') }}</a>
		<button class="btn">{{ $btnText }}</button>
	</div>
</div>