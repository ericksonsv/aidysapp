<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Backend\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['can:browse-posts'])->only(['index']);
        $this->middleware(['can:read-posts'])->only(['show']);
        $this->middleware(['can:edit-posts'])->only(['edit','update']);
        $this->middleware(['can:add-posts'])->only(['create','store']);
        $this->middleware(['can:destroy-posts'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('backend.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id');
        $tags = Tag::pluck('name','id');
        $post = new Post;
        return view('backend.posts.create', compact('categories','tags','post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title'             => ['required','string','min:8','max:255'],
            'excerpt'           => ['nullable','string','min:16'],
            'body'              => ['required','string','min:25'],
            'category'          => ['required','integer'],
            'status'            => ['required','string'],
            'feature'           => ['boolean'],
            'image'             => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:1024'],
            'image_url'         => ['nullable','url'],
            'video'             => ['nullable','file','mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'],
            'video_url'         => ['nullable','url'],
            'seo_title'         => ['nullable','string','min:8','max:255'],
            'meta_description'  => ['nullable','string','min:8','max:255'],
            'meta_keywords'     => ['nullable','string','min:6','max:255'],
        ]);

        $post = Post::create([
            'user_id'           => auth()->user()->id,
            'category_id'       => $request->category,
            'title'             => $request->title,
            'slug'              => $request->title,
            'seo_title'         => $request->seo_title,
            'excerpt'           => $request->excerpt,
            'body'              => $request->body,
            'image_url'         => $request->image_url,
            'video_url'         => $request->video_url,
            'meta_description'  => $request->meta_description,
            'meta_keywords'     => $request->meta_keywords,
            'status'            => $request->status,
        ]);

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        if ($request->featured) {
            $post->featured = true;
            $post->save();
        }

        if ($request->has('image')) {
            $request->file('image')->store('public/posts/images');
            $post->image = $request->image->hashName();
            $post->save();
        }

        if ($request->has('video')) {
            $request->file('video')->store('public/posts/videos');
            $post->video = $request->video->hashName();
            $post->save();
        }

        return redirect()->route('backend.posts.index')->with('success', __('Post Created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('name','id');
        $tags = Tag::pluck('name','id');
        return view('backend.posts.edit',compact('categories','tags','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $fields = $request->validate([
            'title'             => ['required','string','min:8','max:255'],
            'excerpt'           => ['nullable','string','min:16'],
            'body'              => ['required','string','min:25'],
            'category'          => ['required','integer'],
            'status'            => ['required','string'],
            'feature'           => ['boolean'],
            'image'             => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:1024'],
            'image_url'         => ['nullable','url'],
            'video'             => ['nullable','file','mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'],
            'video_url'         => ['nullable','url'],
            'seo_title'         => ['nullable','string','min:8','max:255'],
            'meta_description'  => ['nullable','string','min:8','max:255'],
            'meta_keywords'     => ['nullable','string','min:6','max:255'],
        ]);

        $post->category_id       = $request->category;
        $post->title             = $request->title;
        $post->slug              = $request->title;
        $post->seo_title         = $request->seo_title;
        $post->excerpt           = $request->excerpt;
        $post->body              = $request->body;
        $post->image_url         = $request->image_url;
        $post->video_url         = $request->video_url;
        $post->meta_description  = $request->meta_description;
        $post->meta_keywords     = $request->meta_keywords;
        $post->status            = $request->status;

        if ($request->tags) {
            $post->tags()->detach();
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        if ($request->featured) {
            $post->featured = true;
            $post->save();
        } else {
            $post->featured = false;
            $post->save();
        }

        if ($request->has('image')) {
            if ($post->image) {
                Storage::delete('public/posts/images/'.$post->image);
            }
            $request->file('image')->store('public/posts/images');
            $post->image = $request->image->hashName();
            $post->save();
        }

        if ($request->has('video')) {
            if ($post->video) {
                Storage::delete('public/posts/videos/'.$post->video);
            }
            $request->file('video')->store('public/posts/videos');
            $post->video = $request->video->hashName();
            $post->save();
        }

        return redirect()->route('backend.posts.index')->with('success', __('Post Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (auth()->user()->id === $post->user_id or auth()->user()->role->id === 1) {
            if ($post->image) {
                $post->image()->delete($post->image);
                Storage::delete('public/posts/images/'.$post->image->name);
            }
            Post::destroy($post->id);
            return  redirect()->route('backend.posts.index')->with('success', __('Post Deleted Permanently'));
        } else {
            return  redirect()->route('backend.posts.index')->with('warning', __('You Cannot Delete This Post'));
        }
    }

    /**
     * Delete image to the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
        $post = Post::findOrFail($id);
        
        if ($post->image) {
            Storage::delete('public/posts/images/'.$post->image);
            $post->image = '';
            $post->save();
            return response(__('Image Deleted From Post'));
        } else {
            return respose(__('No image To Delete'));
        }
    }

    /**
     * Delete Video to the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteVideo($id)
    {
        $post = Post::findOrFail($id);
        
        if ($post->video) {
            Storage::delete('public/posts/videos/'.$post->video);
            $post->video = '';
            $post->save();
            return response(__('Video Deleted From Post'));
        } else {
            return respose(__('No Video To Delete'));
        }
    }
}
