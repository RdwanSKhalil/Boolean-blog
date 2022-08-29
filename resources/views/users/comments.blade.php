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
    @foreach($comments as $comment)
    <div class="commentors">
        <h5><strong>{{ $user->name }}</strong> - </h5><h6>Commented on: {{ $comment->created_at->toDateString() }}</h6>
        <p>{{ $comment->comment }}</p>
    </div>
    @endforeach
    @if(count($comments) == 0)
        <div class="info-flex">
            <div class="no-info">
                <h1>No Comments Yet</h1>
            </div>
        </div>
    @endif 
</div>
@endsection
