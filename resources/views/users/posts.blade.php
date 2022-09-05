@extends('layouts.user')

@section('user-content')
    @if(session('deleted'))
        <div class="alert alert-success">
            {{ session('deleted') }}
        </div>
    @endif
    @foreach($user->posts as $post)
        <div class="posts">
            <div class="info">
                <a href="{{ route('show-post', $post->id) }}"><h1 class="post-title">{{ $post->title }}</h1></a>
                <h5 class="post-author">Author: {{ $post->author }} - Uploaded On: {{ Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</h5>
                <<div>
                    {!! Str::words($post->text, 50) !!}
                </div>
                <div class="controls">
                    @if(Auth::check())
                        <a href="{{ route('post.editShow', $post->id) }}" class="btn btn-primary"><i class="bi bi-pencil-fill me-2"></i>Edit</a>
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="bi bi-trash-fill me-2"></i>Delete</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="image"> 
                <a href="{{ route('show-post', $post->id) }}">
                    <img class="post-img" src="/../{{ $post->img_path }}" alt="post-img">
                </a>
            </div>
        </div>
    @endforeach
    @if($user->posts->count() == 0)
        <div class="info-flex">
            <div class="no-info">
                <h1>No Posts Yet</h1>
            </div>
        </div>
    @endif 
@endsection
