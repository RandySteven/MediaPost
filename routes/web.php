<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/search', 'SearchController@post')->name('search');
Route::middleware('auth')->group(function(){
    Route::get('/', 'PostController@index')->withoutMiddleware('auth')->name('post.index');
    Route::get('/post-create', 'PostController@create')->name('post.create');
    Route::post('/post-store', 'PostController@store')->name('post.store');
    Route::get('/post-edit/{post:slug}', 'PostController@edit')->name('post.edit');
    Route::patch('/post-update/{post:slug}', 'PostController@update')->name('post.update');
    Route::delete('/post-delete/{post:slug}', 'PostController@destroy')->name('post.delete');
    Route::get('/post-show/{post:slug}', 'PostController@show')->withoutMiddleware('auth')->name('post.show');

   Route::post('/store-comment', 'CommentController@store')->name('comment.store');
   Route::post('/store-reply', 'CommentController@replyStroe')->name('comment.reply');

   Route::get('/profile/{user:id}', 'UserController@show')->name('profile.show');
   Route::get('/profile/edit/{user:id}', 'UserController@edit')->name('profile.edit');
   Route::patch('/profile/update/{user:id}', 'UserController@update')->name('profile.update');
});

Route::get('/post-by-category/category/{category:slug}', 'CategoryController@show')->name('category');
Route::get('/post-by-tags/tag/{tag:slug}', 'TagController@show')->name('tag');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
