@extends('layouts.app')

@section('title', 'Create Post')

@section('style')

@endsection

@section('content')
<form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @include('post.form.form-partials')
</form>
@endsection

@section('script')

@endsection
