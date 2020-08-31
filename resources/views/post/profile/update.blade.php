@extends('layouts.app')

@section('content')
    <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="exampleFormControlSelect1">Name</label>
            <input type="text" name="name" id="" class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Profile Image</label>
            <input type="file" name="profile_image" id="" class="form-control">
        </div>
    </form>
@endsection
