<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Backend\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['can:browse-categories'])->only(['index']);
        $this->middleware(['can:read-categories'])->only(['show']);
        $this->middleware(['can:edit-categories'])->only(['edit','update']);
        $this->middleware(['can:add-categories'])->only(['create','store']);
        $this->middleware(['can:destroy-categories'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('id','!=',1)->get();
        // $categories = Category::paginate(5);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create',['category' => new Category]);
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
            'name' => ['required','min:3','max:25','unique:categories'],
            'description' => ['nullable','string','min:6','max:255']
        ]);

        $category = Category::create([
            'name' => $request->name,
            'slug' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('backend.categories.index')->with('success', __('Category Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('backend.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'          => ['required','min:3','max:25','unique:categories,name,'.$category->id],
            'description'   => ['nullable','string','min:6','max:255']
        ]);

        $category->name = $request->name;
        $category->slug = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('backend.categories.index')->with('success', __('Category Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ($category->id === 1) {
            return redirect()->back()->with('warning', __('This Category Cannot Be Deleted'));
        }

        if (count($category->posts)) {
            return redirect()->back()->with('warning', __('This Category Have Related Posts, Cannot Be Deleted'));
        } else {
            Category::destroy($category->id);
            return  redirect()->route('backend.categories.index')->with('success', __('Category Deleted'));
        }
    }
}
