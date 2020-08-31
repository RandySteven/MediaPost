@extends('layouts.app')

@section('title', 'Create Post')

@section('style')

@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        @if ($post->thumbnail)
            <img style="height: 450px; object-fit: cover; object-position: top" src="{{ $post->takeImage }}" alt="" class="rounded w-100">
        @endif
        <h1>{{ $post->title }}</h1>
        <div class="text-secondary">
            <a href="{{ route('category', $post->category->slug) }}">{{ $post->category->name }}</a> &middot; {{ $post->created_at->format("d M, Y") }}
            &middot;
            @foreach ($post->tags as $tag)
                <a href="{{ route('tag', $tag->slug) }}">{{ $tag->name }}</a>
            @endforeach

            <div class="media my-3">
                <img width="60" class="rounded-circle mr-3" src="{{ $post->user->gravatar() }}" alt="">
                <div class="media-body">
                    <div>
                        Wrote by &middot; <a href="{{ route('profile.show', $post->user->id) }}">
                            {{ $post->user->name }}
                        </a>
                    </div>
                    {{ '@'.$post->user->email }}
                </div>
            </div>

        </div>
        {{-- <p>{{ $post->slug }}</p> --}}
        <p>{!! nl2br($post->body) !!}</p>

        <div>
                    <!-- Button trigger modal -->
            @can('delete', $post)
                <div class="flex mt-3">
                    <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-sm btn-success">Edit</a>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Delete
                    </button>
                </div>
            @endcan

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="mb-2">
                                {{ $post->title }}
                            </div>
                        </div>
                        <div>
                            {{ $post->created_at }}
                        </div>
                        

                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('post.delete', $post->slug) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Ya</button>
                        </form>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button>
                    </div>
                </div>
                </div>
            </div>

            <div class="card-body">
                @include('post.comment.create', ['comments' => $post->comments, 'post_id' => $post->id])
                    <h5>Leave a comment</h5>
                    <form method="post" action="{{ route('comment.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" id="" class="form-control" rows="10" placeholder="Write your comment ..."></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                        </div>
                    </form>
                </div>
        </div>

        </div>



        <div class="col-md-4">
            Rekomendasi yang mungkin anda suka
            @foreach ($posts as $post)

            <div class="card mb-4">
                <div class="card-title">
                    <a href="{{ route('post.show', $post->slug) }}">
                        {{ $post->title }}
                    </a>
                </div>
                <div class="card-body">
                    <a href="/categories/{{ $post->category->slug }}" class="text-secondary">
                        {{ $post->category->name }}
                    </a>
                    -
                    @foreach ($post->tags as $tag)
                        <a href="/tags/{{ $tag->slug }}" class="text-secondary">
                            {{ $tag->name }}
                        </a>
                    @endforeach

                    <div>{{ $post->created_at->format("d M, Y") }}</div>
                    <div class="my-3">
                    {{ Str::limit($post->body, 120, '.') }}
                    </div>
                        {{-- <a href="/post/{{ $post->slug }}">Read more</a> --}}
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-between mt-2">
                        <div class="media align-items-center">
                            <img width="40" class="rounded-circle mr-3" src="{{ $post->user->gravatar() }}" alt="">
                            <div class="media-body">
                                <div>
                                    Wrote by &middot;
                                    <a href="{{ route('profile.show', $post->user->id) }}">
                                        {{ $post->user->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>
@endsection

@section('script')

@endsection
