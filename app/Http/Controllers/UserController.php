<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(User $user){
        return view('post.profile.update', compact('user'));
    }

    public function update(User $user, Request $request){
        $attr = $request->all();

        if(request()->file('profile_image')){
            \Storage::delete($user->profile_image);
            $profile_image = request()->file('profile_image')->store("images/user");
        }else{
            $profile_image = $user->profile_image;
        }
        $attr['profile_image'] = $profile_image;
        return redirect('/');
    }

    public function show(User $user, Post $post){
        $posts = Post::all();
        return view('post.profile.show', compact('user', 'posts', 'post'));
    }
}
