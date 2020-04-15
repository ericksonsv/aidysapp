@csrf

<div class="flex justify-center sm:justify-end mt-10 mb-6">
	<a href="{{ route('backend.posts.index') }}" class="btn mr-1">{{ __('Cancel') }}</a>
	<button class="btn">{{ $btnText }}</button>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
	
	<div class="lg:col-span-8">

		{{-- Title --}}
			<div class="card">
				<div class="card-header"><label for="title">{{ __('Post Title') }}</label></div>
				<div class="card-body">
					<input type="text" name="title" id="title" class="input @error('title') input-error @enderror" value="{{ old('title', $post->title) }}">
					@error('title')
						<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
		{{-- Title --}}
		
		{{-- Excerpt --}}
			<div class="card">
				<div class="card-header"><label for="excerpt">{{ __('Post Excerpt') }}</label></div>
				<div class="trumbowyg-dark">
					<textarea name="excerpt" id="excerpt" class="input @error('excerpt') input-error @enderror" rows="5">{{ old('excerpt', $post->excerpt) }}</textarea>
					@error('excerpt')
						<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
		{{-- Excerpt --}}
		
		{{-- Body --}}
			<div class="card">
				<div class="card-header"><label for="body">{{ __('Post Body') }}</label></div>
				<div class="trumbowyg-dark">
					<textarea name="body" id="body" class="input @error('body') input-error @enderror" rows="10">{{ old('body', $post->body) }}</textarea>
					@error('body')
						<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
		{{-- Body --}}

	</div>

	<div class="lg:col-span-4">

		<div class="card">
			<div class="card-header">Post Details</div>
			<div class="card-body">
				{{-- Category --}}
					<div class="input-group">
						<label for="category" class="block mb-2">{{ __('Category') }}</label>
						<select name="category" id="category" class="input">
							@foreach ($categories as $id => $name)
								<option value="{{ $id }}" {{ (old('category',($post->category) ? $post->category->id : '') == $id) ? 'selected' : '' }}>{{ $name }}</option>
							@endforeach
						</select>
						@error('category')
							<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
						@enderror
					</div>
				{{-- Category --}}

				{{-- Tags --}}
					<div class="input-group">
						<label for="tags" class="block mb-2">{{ __('Tags') }}</label>
						<select name="tags[]" id="tags" class="input" multiple style="width: 100%">
							@foreach ($tags as $id => $name)
								<option value="{{ $id }}" {{ ($post->tags->pluck('id')->contains($id)) ? 'selected' : '' }}>{{ $name }}</option>
							@endforeach
						</select>
						@error('category')
							<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
						@enderror
					</div>
				{{-- Tags --}}

				{{-- Status --}}
					<div class="input-group">
						<label for="status" class="block mb-2">{{ __('Status') }}</label>
						<select name="status" id="status" class="input">
							<option value="PUBLISHED" {{ (old('status',$post->status) == 'PUBLISHED') ? 'selected' : '' }}>{{ __('Published') }}</option>
							<option value="PENDING" {{ (old('status',$post->status) == 'PENDING') ? 'selected' : '' }}>{{ __('Pending') }}</option>
							<option value="DRAFT" {{ (old('status',$post->status) == 'DRAFT') ? 'selected' : '' }}>{{ __('Draft') }}</option>
						</select>
						@error('status')
						<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
						@enderror
					</div>
				{{-- Status --}}

				{{-- Featured --}}
					<div class="mt-6">
						<label class="inline-flex items-center">
							<input type="checkbox" name="featured" class="form-checkbox bg-gray-200 border-gray-300 text-gray-800 border-2 shadow-sm h-6 w-6" {{ old('featured', $post->featured) ? 'checked' : '' }}>
							<span class="ml-2 text-sm">{{ __('Featured') }}</span>
						</label>
					</div>
				{{-- Featured --}}
			</div>
		</div>
		<div class="card">
			<div class="card-header"><label for="email">{{ __('Post Image') }}</label></div>
			<div class="card-body">
				{{-- image --}}
				<div>
					@if ($post->image)
						<div id="delete-image">
							<img src="{{ asset('storage/posts/images/'.$post->image) }}" id="image-preview" class="img-fluid shadow-md">
							<button id="delete-image-btn" class="btn w-full my-4" v-on:click.prevent="deleteImage">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
									<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
								</svg>
								<span class="ml-2">{{ __('Delete Image') }}</span>
							</button>
						</div>
					@else
						<img src="" id="image-preview" class="img-fluid mb-4" style="display: none;">
					@endif
				</div>
				<div class="input-group">
					<input type="file" name="image" id="image" class="input @error('image') input-error @enderror" value="{{ old('image') }}" onchange="previewImage('image-preview')">
					@error('image')
						<p class="input-feedback feedback-error mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
				<div>
					<input type="text" name="image_url" id="image_url" class="input @error('image_url') input-error @enderror" value="{{ old('image_url', $post->image_url) }}" placeholder="{{ __('Image URL ...')}}">
					@error('image_url')
						<p class="input-feedback feedback-error mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header"><label for="email">{{ __('Post Video') }}</label></div>
			<div class="card-body">
				{{-- Video --}}
				<div>
					@if ($post->video)
						<div id="delete-video">
							<video width="100%" height="auto" id="video-preview" class="block border-4 border-gray-800 shadow-md" controls>
								<source src="{{ asset('storage/posts/videos/'.$post->video) }}" type="video/mp4">
								<span>{{ __('Your browser does not support the video tag.') }}</span>
							</video>
							<button id="delete-video-btn" class="btn w-full my-4" v-on:click.prevent="deleteVideo">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
									<path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18ZM20,6H16V5a3,3,0,0,0-3-3H11A3,3,0,0,0,8,5V6H4A1,1,0,0,0,4,8H5V19a3,3,0,0,0,3,3h8a3,3,0,0,0,3-3V8h1a1,1,0,0,0,0-2ZM10,5a1,1,0,0,1,1-1h2a1,1,0,0,1,1,1V6H10Zm7,14a1,1,0,0,1-1,1H8a1,1,0,0,1-1-1V8H17Zm-3-1a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z"/>
								</svg>
								<span class="ml-2">{{ __('Delete Video') }}</span>
							</button>
						</div>
					@else
						<video width="100%" height="auto" id="video-preview" class="block border-4 border-gray-800 shadow-md mb-4" style="display: none;" controls>
							<source src="" type="video/mp4">
							<span>{{ __('Your browser does not support the video tag.') }}</span>
						</video>
					@endif
				</div>
				<div class="input-group">
					<input type="file" name="video" id="video" class="input @error('video') input-error @enderror" value="{{ old('video') }}" onchange="previewVideo('video-preview')">
					@error('video')
						<p class="input-feedback feedback-error mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
				<div>
					<input type="text" name="video_url" id="video_url" class="input @error('video_url') input-error @enderror" value="{{ old('video_url', $post->video_url) }}" placeholder="{{ __('Video URL ...')}}">
					@error('video_url')
						<p class="input-feedback feedback-error mt-1 mb-2 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">Post SEO</div>
			<div class="card-body">
				{{-- SEO Title --}}
				<div class="input-group">
					<label for="seo_title">{{ __('SEO Title') }}</label>
					<input type="text" name="seo_title" id="seo_title" class="input @error('seo_title') input-error @enderror" value="{{ old('seo_title', $post->seo_title) }}">
					@error('seo_title')
						<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
				{{-- Meta Description --}}
				<div class="input-group">
					<label for="meta_description">{{ __('Meta Description') }}</label>
					<textarea name="meta_description" id="meta_description" class="input @error('meta_description') input-error @enderror" rows="3">{{ old('meta_description', $post->meta_description) }}</textarea>
					@error('meta_description')
						<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
				{{-- Meta Keywords --}}
				<div>
					<label for="meta_keywords">{{ __('Meta Keywords') }}</label>
					<textarea name="meta_keywords" id="meta_keywords" class="input @error('meta_keywords') input-error @enderror" rows="3">{{ old('meta_keywords', $post->meta_keywords) }}</textarea>
					@error('meta_keywords')
						<p class="input-feedback feedback-error mt-1 animated fadeInUp">{{ $message }}</p>
					@enderror
				</div>
			</div>
		</div>

	</div>

</div>