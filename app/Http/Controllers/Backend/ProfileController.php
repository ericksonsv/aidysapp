<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('backend.profile.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('backend.profile.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'avatar'    => ['image','mimes:jpeg,png,jpg,gif,svg','max:512'],
            'cover'     => ['image','mimes:jpeg,png,jpg,gif,svg','max:512'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if (isset($request->password)) {
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        return redirect()->route('backend.profile.show')->with('success', __('Profile Updated'));
    }

    /**
     * Delete avatar image to the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAvatar()
    {
        $user = auth()->user();
        if ($user->avatar) {
            Storage::delete('public/users/avatars/'.$user->avatar);
            $user->avatar = '';
            $user->save();
            return response(__('Profile Updated, Avatar Removed'));
        } else {
            return response(__('No Avatar'));
        }
    }

    /**
     * Delete cover image to the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteCover()
    {
        $user = auth()->user();
        if ($user->cover) {
            Storage::delete('public/users/covers/'.$user->cover);
            $user->cover = '';
            $user->save();
            return response(__('Profile Updated, Cover Removed'));
        } else {
            return response(__('No Cover'));
        }
    }
}