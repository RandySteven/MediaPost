@extends('layouts.app')

@section('title', 'Edit Post')

@section('style')

@endsection

@section('content')
@if ($errors)
    @foreach ($errors as $error)
        {{ $message }}
    @endforeach
@endif
<form action="{{ route('post.update', $post->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    @include('post.form.form-partials')

</form>
@endsection

@section('script')

@endsection
