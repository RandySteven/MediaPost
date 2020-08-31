<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function post(){
        $query = request('query');
        $posts = Post::where("title","LIKE","%$query%")->latest()->paginate(9);
        return view('post.index', compact('posts'));
    }
}
