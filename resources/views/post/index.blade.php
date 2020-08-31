@extends('layouts.app')

@section('title', 'Create Post')

@section('style')

@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            @isset($category)
                <h4>Category : {{ $category->name }}</h4>
            @endisset
            @isset($tag)
                <h4>Tag : {{ $tag->name }}</h4>
            @endisset
            @if (!isset($tag) && !isset($category))
                Media Hari Ini
            @endif
        </div>
    </div>
    <div>
        @foreach ($categories as $category)
            <a href="{{ route('category', $category->slug) }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
    @forelse ($posts as $post)
    <div class="card mb-1 mt-2" style="max-width: 100%; max-height: 75%; min-height: 50%;">
        <div class="row no-gutters">
          <div class="col-md-4 mt-2">
            @if ($post->takeImage)
                <img src="{{ $post->takeImage }}" style=" width: 75%" class="card-img">
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

    <div>
    	{{ $posts->links() }}
    </div>
    @empty
        No Data Yet
    @endforelse
@endsection

@section('script')

@endsection
