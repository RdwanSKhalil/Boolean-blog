@extends('layouts.user')

@section('user-content')
    <form action="{{ route('user.info-change', Auth::user()->id) }}" method="POST" class="form-info" enctype="multipart/form-data">
        @csrf
        <div class="inputs">
            <h4 class="">{{ session('updated') }}</h4>
        </div>
        <div class="inputs">
            <label for="title" class="form-label">Name:</label>
            <input type="name" class="form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="inputs">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
        </div>
        <div class="inputs">
            <label for="password" class="form-label">Your Password:</label>
            <input type="text" class="form-control" name="password">
        </div>
        <div class="inputs">
            <label for="new_password" class="form-label">New Password:</label>
            <input type="text" class="form-control" name="new_password">
        </div>
        <div class="btn-div">
            <input type="submit" class="btn btn-success" value="Update">
            <a href="{{ route('user.show', $user->id) }}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
    <form action="{{ route('user.destroy', Auth::user()->id) }}" method="POST" class="form-info" enctype="multipart/form-data">
        @csrf
        <div class="btn-div">
            <input type="submit" class="btn btn-danger" value="Delete Account">
        </div>
    </form>
@endsection
