@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="user-header">
        <h1 class="user-name">{{ $user->name }}'s Profile</h1>
        <div class="user-info">
            <h6><strong>Registered On:</strong> {{ $user->created_at->toDateString() }}</h6>
            <h6><strong>Email Address On:</strong> {{ $user->email }}</h6>
        </div>
        <div class="user-info">
            <h6><strong>No. Posts:</strong> {{ $postsCount }}</h6>
            <h6><strong>No. Comments:</strong> {{ $commentsCount }}</h6>
        </div>
        <div class="user-nav">
            <a href="{{ route('user.posts', $user->id) }}" class="btn">Posts</a>
            <a href="{{ route('user.comments', $user->id) }}" class="btn">Comments</a>
        </div>
    </div>
</div>
@endsection
