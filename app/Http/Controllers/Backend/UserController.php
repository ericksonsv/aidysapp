<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('backend.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create',['user'=> new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar'    => ['image','mimes:jpeg,png,jpg,gif,svg','max:512'],
            'status'    => ['required','boolean'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'active'    => $request->status,
            'password'  => bcrypt($request->password)
        ]);

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
        return view('backend.users.edit', compact('user'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'avatar'    => ['image','mimes:jpeg,png,jpg,gif,svg','max:512'],
            'status' => ['required'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->active = $request->status;
        $user->save();

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
     * Change status to the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteAvatar($id)
    {
        $user = User::findOrFail($id);
        if ($user->image) {
            Storage::delete('public/users/avatars/'.$user->image->name);
            $user->image->delete();
            return response(__('Avatar Removed'));
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