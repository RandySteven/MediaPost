<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post){
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        return view('post.show', compact('post', 'posts'));
    }
    public function index(){
        $posts = Post::latest()->paginate(9);
        $categories = Category::all();
        return view('post.index', compact('posts', 'categories'));
    }

    public function create(){
        $categories = Category::get();
        $tags = Tag::get();
        $post = new Post;
        return view('post.create', compact('categories', 'tags', 'post'));
    }

    public function store(PostRequest $request){
        $attr = $request->all();
        $request->validate([
            'thumbnail' => 'image|mimes:png,jpg,jpeg,svg|max:2048'
        ]);
        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("images/post") : null;
        $attr['thumbnail'] = $thumbnail;
        $attr['category_id'] = request('category');
        $attr['slug'] = \Str::slug(request('title'));

        $post = auth()->user()->posts()->create($attr);
        $post->tags()->attach(request('tags'));

        session()->flash('success', 'Post Created');
        return redirect('/');
    }

    public function edit(Post $post){
        $categories = Category::get();
        $tags = Tag::get();
        return view('post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, Post $post){

        $request->validate([
            'thumbnail'=>'image|mimes:png,jpg, jpeg, svg|max:2048'
        ]);

        if(request()->file('thumbnail')){
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        }else{
            $thumbnail = $post->thumbnail;
        }


        $attr['slug'] = \Str::slug(request('title'));
        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;


        $post->update($attr);
        $post->tags()->sync(request('tags'));

        session()->flash('success', 'Updated Success');
        //session()->flash('error', 'Error');
        //return redirect('/posts');
        return redirect('/');
    }

    public function destroy(Post $post){
        $this->authorize('delete', $post);
        $post->tags()->detach();
        $post->delete();

        session()->flash('success', 'Delete Success');
        return redirect('/');
    }
}
