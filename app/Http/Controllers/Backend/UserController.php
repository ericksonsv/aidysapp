<?php

namespace App\Http\Controllers\Backend;

use App\Ability;
use App\Http\Controllers\Backend\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['can:browse-users'])->only(['index']);
        $this->middleware(['can:read-users'])->only(['show']);
        $this->middleware(['can:edit-users'])->only(['edit','update']);
        $this->middleware(['can:add-users'])->only(['create','store']);
        $this->middleware(['can:destroy-users'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where([['id', '!=', 1],['id', '!=', auth()->user()->id]])->get();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User;
        $roles = Role::select('id','name','label')->get();
        $abilities = Ability::all()->groupBy(function($item, $key) { return Str::afterLast($item['name'], '-'); });
        return view('backend.users.create', compact('user','roles','abilities'));
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
            'role'      => ['required','integer'],
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar'    => ['image','mimes:jpeg,png,jpg,gif,svg','max:512'],
            'status'    => ['required','boolean'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'role_id'   => $request->role,
            'name'      => $request->name,
            'email'     => $request->email,
            'active'    => $request->status,
            'password'  => bcrypt($request->password)
        ]);

        if ($request->abilities) {
            foreach ($request->abilities as $ability) {
                $user->assignDirectAbility($ability);
            }
        }

        if ($request->has('avatar')) {
            $request->file('avatar')->store('public/users/avatars');
            $user->avatar = $request->avatar->hashName();
            $user->save();
        }

        if ($request->has('cover')) {
            $request->file('cover')->store('public/users/covers');
            $user->cover = $request->cover->hashName();
            $user->save();
        }

        return redirect()->route('backend.users.index')->with('success', __('User Created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('backend.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::select('id','name','label')->get();
        $abilities = Ability::all()->groupBy(function($item, $key) { return Str::afterLast($item['name'], '-'); });
        return view('backend.users.edit', compact('user','roles','abilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role'      => ['required','integer'],
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'avatar'    => ['image','mimes:jpeg,png,jpg,gif,svg','max:512'],
            'status'    => ['required'],
        ]);

        $user->role_id = $request->role;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->status;
        $user->save();

        if ($request->abilities) {
            $user->removeDirectAbility(Ability::all());
            foreach ($request->abilities as $ability) {
                $user->assignDirectAbility($ability);
            }
        } else {
            $user->removeDirectAbility(Ability::all());
        }

        if (isset($request->password)) {
            $request->validate([
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            $user->password = bcrypt($request->password);
            $user->save();
        }

        if ($request->has('avatar')) {
            if ($user->avatar) {
                Storage::delete('public/users/avatars/'.$user->avatar);
                $request->file('avatar')->store('public/users/avatars');
                $user->avatar = $request->avatar->hashName();
                $user->save();
            } else {
                $request->file('avatar')->store('public/users/avatars');
                $user->avatar = $request->avatar->hashName();
                $user->save();
            }
        }

        if ($request->has('cover')) {
            if ($user->cover) {
                Storage::delete('public/users/covers/'.$user->cover);
                $request->file('cover')->store('public/users/covers');
                $user->cover = $request->cover->hashName();
                $user->save();
            } else {
                $request->file('cover')->store('public/users/covers');
                $user->cover = $request->cover->hashName();
                $user->save();
            }
        }

        return redirect()->route('backend.users.index')->with('success', __('User Updated'));
    }

    /**
     * Change status to the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->active) {
            $user->active = 0;
            $user->save();
        } else {
            $user->active = 1;
            $user->save();
        }
        return response(__('User Updated'));
    }

    /**
     * Delete avatar to the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAvatar($id)
    {
        $user = User::findOrFail($id);

        if ($user->avatar) {
            Storage::delete('public/users/avatars/'.$user->avatar);
            $user->avatar = '';
            $user->save();
            return response(__('Avatar Removed'));
        } else {
            return response(__('No Avatar'));
        }
    }

    /**
     * Delete cover to the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCover($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->cover) {
            Storage::delete('public/users/covers/'.$user->cover);
            $user->cover = '';
            $user->save();
            return response(__('Cover Removed'));
        } else {
            return response(__('No Avatar'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return  redirect()->route('backend.users.index')->with('warning', __('You Cannot Delete Yourself'));
        } else {
            User::destroy($user->id);
            return  redirect()->route('backend.users.index')->with('success', __('User Deleted Permanently'));
        }
    }
}