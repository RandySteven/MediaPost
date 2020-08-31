<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show(Tag $tag){
        $posts = $tag->posts()->latest()->paginate(9);
        $categories = Category::all();
        return view('post.index', compact('posts', 'categories'));
    }
}
