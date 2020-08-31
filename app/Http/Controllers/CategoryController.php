<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category){
        $posts = $category->posts()->latest()->paginate(9);
        $categories = Category::all();
        return view('post.index', compact('posts', 'categories'));
    }
}
