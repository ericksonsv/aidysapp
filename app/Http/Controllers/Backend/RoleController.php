<?php

namespace App\Http\Controllers\Backend;

use App\Role;
use App\Ability;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Controller;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['can:browse-roles'])->only(['index']);
        $this->middleware(['can:read-roles'])->only(['show']);
        $this->middleware(['can:edit-roles'])->only(['edit','update']);
        $this->middleware(['can:add-roles'])->only(['create','store']);
        $this->middleware(['can:destroy-roles'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::where([['id', '!=', 1],['id', '!=', 2]])->get();
        return view('backend.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = new Role;
        $abilities = Ability::all()->groupBy(function($item, $key) { return Str::afterLast($item['name'], '-'); });
        return view('backend.roles.create', compact('role','abilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();

        $request->validate([
            'name'      => ['required', 'string', 'max:50','unique:roles'],
            'label'     => ['sometimes', 'max:25'],
        ]);

        $role = Role::create([
            'name'     => strtolower($request->name),
            'label'    =>  Str::title($request->label),
        ]);

        if ($request->abilities) {
            foreach ($request->abilities as $ability) {
                $role->allowTo($ability);
            }
        }

        return redirect()->route('backend.roles.index')->with('success', __('Role Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('backend.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = Role::whereName($role->name)->with('abilities')->first();
        $abilities = Ability::all()->groupBy(function($item, $key) { return Str::afterLast($item['name'], '-'); });
        return view('backend.roles.edit', compact('role','abilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'      => ['required', 'string', 'max:50','unique:roles,name,'.$role->id],
            'label'     => ['sometimes', 'max:25'],
        ]);

        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();

        if ($request->abilities) {
            $role->disallowTo(Ability::all());
            foreach ($request->abilities as $ability) {
                $role->allowTo($ability);
            }
        } else {
            $role->disallowTo(Ability::all());
        }

        return redirect()->route('backend.roles.index')->with('success', __('Role Updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if ($role->id === 1 or $role->id === 2) {
            return  redirect()->route('backend.roles.index')->with('warning', __('You Cannot Delete This Role'));
        } else {
            Role::destroy($role->id);
            return  redirect()->route('backend.roles.index')->with('success', __('Role Deleted Permanently'));
        }
    }
}
