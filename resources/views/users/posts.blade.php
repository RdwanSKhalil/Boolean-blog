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
    @foreach($posts as $post)
        <div class="posts">
            <div class="info">
                <a href="{{ route('show-post', $post->id) }}"><h1 class="post-title">{{ $post->title }}</h1></a>
                <h5 class="post-author">Author: {{ $post->author }} - Uploaded On: {{ $post->created_at->toDateString(); }}</h5>
                <p class="post-desc">{{ Str::limit($post->text, 500) }}</p>
            </div>
            <div class="image"> 
                <a href="{{ route('show-post', $post->id) }}">
                    <img class="post-img" src="/../{{ $post->img_path }}" alt="post-img">
                </a>
            </div>
        </div>
    @endforeach
    @if(count($posts) == 0)
        <div class="info-flex">
            <div class="no-info">
                <h1>No Posts Yet</h1>
            </div>
        </div>
    @endif 
</div>
@endsection
