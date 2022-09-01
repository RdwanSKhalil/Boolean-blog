@extends('layouts.user')

@section('user-content')
    <form action="{{ route('user.info-change', Auth::user()->id) }}" method="POST" class="form-info" enctype="multipart/form-data">
        @csrf
        <div class="inputs">
            <h4 class="">{{ session('updated') }}</h4>
        </div>
        <div class="inputs">
            <label for="title" class="input-label">Name:</label>
            <input type="name" class="input-field" name="name" value="{{ $user->name }}">
        </div>
        <div class="inputs">
            <label for="email" class="input-label">Email:</label>
            <input type="text" class="input-field" name="email" value="{{ $user->email }}">
        </div>
        <div class="inputs">
            <label for="password" class="input-label">Your Password:</label>
            <input type="text" class="input-field" name="password">
        </div>
        <div class="inputs">
            <label for="new_password" class="input-label">New Password:</label>
            <input type="text" class="input-field" name="new_password">
        </div>
        <div class="btn-div">
            <input type="submit" class="cos-btn form-btn" value="Update">
            <a href="{{ route('user.show', $user->id) }}" class="cos-btn">Cancel</a>
        </div>
    </form>
@endsection
