<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['can:browse-tags'])->only(['index']);
        $this->middleware(['can:read-tags'])->only(['show']);
        $this->middleware(['can:edit-tags'])->only(['edit','update']);
        $this->middleware(['can:add-tags'])->only(['create','store']);
        $this->middleware(['can:destroy-tags'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.tags.index', [
            'tags' => Tag::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tags.create', ['tag' => new Tag()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','min:3','max:15','unique:tags']
        ]);

        $tag = Tag::create([
            'name' => $request->name,
            'slug' => $request->name
        ]);

        return redirect()->route('backend.tags.index')->with('success', __('Tag Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('backend.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('backend.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => ['required','min:3','max:15','unique:tags,name,'.$tag->id]
        ]);

        $tag->name = $request->name;
        $tag->slug = $request->name;
        $tag->save();

        return redirect()->route('backend.tags.index')->with('success', __('Tag Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        Tag::destroy($tag->id);
        
        return redirect()->route('backend.tags.index')->with('success', __('Tag Deleted'));
    }
}
