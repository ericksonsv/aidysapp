<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Controller;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['can:browse-videos'])->only(['index']);
        $this->middleware(['can:read-videos'])->only(['show']);
        $this->middleware(['can:edit-videos'])->only(['edit','update']);
        $this->middleware(['can:add-videos'])->only(['create','store']);
        $this->middleware(['can:destroy-videos'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('backend.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.videos.create', [
            'categories' => Category::pluck('name','id'),
            'video' => new Video()
        ]);
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
            'file'              => ['required_without:url','file','mimetypes:video/avi,video/mpeg,video/mp4,video/quicktime'],
            'url'               => ['required_without:file','url'],
            'description'       => ['nullable','string','min:16'],
            'category'          => ['required','integer'],
            'status'            => ['required','string'],
            'feature'           => ['boolean'],
            'thumbnail'         => ['image','mimes:jpeg,png,jpg,gif,svg','max:512'],
            'seo_title'         => ['nullable','string','min:8','max:255'],
            'meta_description'  => ['nullable','string','min:8','max:255'],
            'meta_keywords'     => ['nullable','string','min:6','max:255'],
        ]);

        $video = Video::create([
            'user_id'           => auth()->user()->id,
            'category_id'       => $request->category,
            'title'             => $request->title,
            'slug'              => $request->title,
            'url'               => $request->url,
            'seo_title'         => $request->seo_title,
            'description'       => $request->description,
            'meta_description'  => $request->description,
            'meta_keywords'     => $request->keywords,
            'status'            => $request->status,
        ]);

        if ($request->featured) {
            $video->featured = true;
            $video->save();
        }

        if ($request->has('file')) {
            $request->file('file')->store('public/videos/files');
            $video->file = $request->file->hashName();
            $video->save();
        }

        if ($request->has('thumbnail')) {
            $request->file('thumbnail')->store('public/videos/thumbnails');
            $video->image()->create(['name' => $request->thumbnail->hashName()]);
        }

        return redirect()->route('backend.videos.index')->with('success', __('Video Created'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        return view('backend.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        return view('backend.videos.edit', [
            'categories' => Category::pluck('name','id'),
            'video' => $video
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }

    /**
     * Delete image to the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
        $video = Video::findOrFail($id);
        
        if ($video->image) {
            $video->image()->delete($video->image);
            Storage::delete('public/videos/images/'.$video->image->name);
            return response(__('Image Deleted'));
        } else {
            return respose(__('No image to delete'));
        }
    }       
}
