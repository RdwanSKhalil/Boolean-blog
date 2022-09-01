@extends('layouts.app')

@section('content')
@if(Auth::check())
    <div class="home-controls">
        <a class="cos-btn create-post" href="{{ route('create-post') }}">Create a Post</a>
    </div>
@endif
<div class="wrapper">
    @foreach($posts as $post)
        <div class="posts">
            <div class="info">
                <a href="{{ route('show-post', $post->id) }}"><h1 class="post-title">{{ $post->title }}</h1></a>
                <h5 class="post-author">
                    <img class="user-img" src="{{ $post->user_img_path }}" alt="">
                    Author: <strong><a href="{{ route('user.show', $post->user_id) }}">{{ $post->author }}</a></strong> - Uploaded On: {{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}
                </h5>
                <p class="post-desc">{{ Str::limit($post->text, 500) }}</p>
            </div>
            <div class="image"> 
                <a href="{{ route('show-post', $post->id) }}">
                    <img class="post-img" src="{{ $post->img_path }}"alt="post-img">
                </a>
            </div>
        </div>
    @endforeach
</div>
@endsection
