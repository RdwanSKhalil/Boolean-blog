@extends('layouts.user')

@section('user-content')
    @foreach($posts as $post)
        <div class="posts">
            <div class="info">
                <a href="{{ route('show-post', $post->id) }}"><h1 class="post-title">{{ $post->title }}</h1></a>
                <h5 class="post-author">Author: {{ $post->author }} - Uploaded On: {{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</h5>
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
@endsection
