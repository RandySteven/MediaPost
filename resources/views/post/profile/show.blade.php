@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="jumbotron jumbotron-fluid" id="picture">
    <div class="container">
        <div class="container text-center">
            <img src="{{ $user->takeImage }}" alt="" width="200" height="200" class="rounded-circle" style="background-color: black">
            <h1>{{ $user->name }}</h1>
            @if (auth()->user()->id == $user->id)
                <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-primary">Update</a>
            @endif
        </div>
    </div>
</div>
<div class="container">
    @forelse ($posts as $post)
        @if ($user->id==$post->user_id)
            <div class="card mb-1 mt-2" style="max-width: 100%; max-height: 75%; min-height: 50%;">
                <div class="row no-gutters">
                <div class="col-md-4 mt-2">
                    @if ($post->takeImage)
                        <img src="{{ $post->takeImage }}" style=" width: 75%" class="card-img" alt="...">
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->body, '120', '...') }}</p>
                    <p class="card-text"><small class="text-muted">{{ $post->created_at->format("d M, Y") }}</small></p>
                    <a href="{{ route('post.show', $post->slug) }}" class="btn btn-primary">Show</a>
                    </div>
                </div>
                </div>
            </div>
        @endif
        @empty
            You haven't post
    @endforelse
</div>
@endsection
