<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'thumbnail', 'category_id', 'body', 'slug'
    ];

    protected $with = [
        'user', 'category', 'tags'
    ];

    public function getTakeImageAttribute(){
        return "/storage/".$this->thumbnail;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class ,'tag_id');
    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }
}
