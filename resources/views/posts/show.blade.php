@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="flex-div">

        <div class="image-div">
            <img class="img" src="/../{{ $post->img_path }}" alt="post-img">
        </div>
        
        <div class="body-div">
            <div class="header-div">
                <h1>{{ $post->title }}</h1>
                <div>
                    <img class="author-img" src="../{{ $post->user->img_path }}" alt="author-img">
                    <h6>Author: <strong><a href="{{ route('user.show', $post->user_id) }}">{{ $post->author }}</a></strong> - Date Published: {{ $post->created_at->toDateString(); }}</h6>
                </div>
            </div>

            <div class="text-div">
                {!! $post->text !!}
            </div>

        </div>

        <div class="comment-div">
            <h3>Comments</h3>
            <form action="/post/{{ $post->id }}" method="POST">
                @csrf
                @if ($errors->get('comment'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="comment" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Comments</label>
                  </div>
                <button class="btn btn-success mb-1">Comment</button>
            </form>
            @if(session('added'))
                <div class="alert alert-success">
                    {{session('added')}}
                </div>
            @endif
            @if(session('deleted'))
                <div class="alert alert-danger">
                    {{ session('deleted') }}
                </div>
            @endif
            @if(session('reply-deleted'))
                <div class="alert alert-danger">
                    {{ session('reply-deleted') }}
                </div>
            @endif
            @if(session('reply-stored'))
                <div class="alert alert-success">
                    {{ session('reply-stored') }}
                </div>
            @endif
            <div class="comments">
                @foreach($post->recentComments as $comment)
                    <div class="card mb-3 mt-3 rounded">
                        <div class="card-header">
                            <img class="commentator-img inline me-3" src="/../{{ $comment->user->img_path }}" alt="commenter-img">
                            <h5 class="inline"><a href="{{ route('user.show', $comment->user->id) }}"><strong>{{ $comment->user->name }}</strong></a> - </h5><h6 class="inline opacity-75">Commented on: {{ Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</h6>
                        </div>
                        <div class="card-body p-3">
                            <p class="fs-5">{{ $comment->comment }}</p>
                            @if(Auth::check())
                                @if(Auth::user()->id == $comment->commenter_id)
                                    <a href="{{ route('edit-comment', $comment->id) }}" class="comment-controls btn btn-dark"><i class="bi bi-pencil-fill"></i></a>
                                    <form action="{{ route('comment.destroy') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="comment-controls btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                        <input type="hidden" name="comment-id" value="{{ $comment->id }}">
                                    </form>
                                @endif
                                <form action="{{ route('reply.store', $post->id) }}" method="POST">
                                    @csrf
                                    <button class="comment-controls btn btn-dark"><i class="bi bi-reply-fill"></i></button>
                                    <input type="hidden" name="comment-id" value="{{ $comment->id }}">
                                    <input type="text" name="reply" class="reply">
                                </form>
                            @endif
                        </div>
                    </div>

                    @foreach($comment->replies as $reply)
                        @if($reply->reply_id == null)
                            <div class="card mb-3 mt-3 rounded ms-4">
                                <div class="card-header">
                                    <img class="commentator-img inline me-3" src="/../{{ $reply->user->img_path }}" alt="commenter-img">
                                    <h5 class="inline"><a href="{{ route('user.show', $reply->user_id) }}"><strong>{{ $reply->user->name }}</strong></a> - </h5><h6 class="inline">Replied on: {{ $reply->created_at->toDateString() }}</h6>
                                </div>
                                <div class="card-body p-3">
                                    <p class="fs-5">{{ $reply->reply }}</p>
                                    @if(Auth::check())
                                        @if(Auth::user()->id == $reply->user_id)
                                        <a href="{{ route('edit-comment', $comment->id) }}" class="comment-controls btn btn-dark"><i class="bi bi-pencil-fill"></i></a>
                                            <form action="{{ route('reply.destroy') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="comment-controls btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                                <input type="hidden" name="reply-id" value="{{ $reply->id }}">
                                            </form>
                                        @endif
                                        <form action="{{ route('reply.store-reply', $reply->id) }}" method="POST">
                                            @csrf
                                            <button class="comment-controls btn btn-dark"><i class="bi bi-reply-fill"></i></button>
                                            <input type="hidden" name="comment-id" value="{{ $comment->id }}">
                                            <input type="text" name="reply" class="reply">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endif
                        
                        @foreach($reply->replies as $reply)
                        <div class="card mb-3 mt-3 rounded ms-5">
                            <div class="card-header">
                                <img class="commentator-img inline me-3" src="/../{{ $reply->user->img_path }}" alt="commenter-img">
                                <h5 class="inline"><a href="{{ route('user.show', $reply->user_id) }}"><strong>{{ $reply->user->name }}</strong></a> - </h5><h6 class="inline">Replied on: {{ $reply->created_at->toDateString() }}</h6>
                            </div>
                            <div class="card-body p-3">
                                <p class="fs-5">{{ $reply->reply }}</p>
                                @if(Auth::check())
                                    @if(Auth::user()->id == $reply->user_id)
                                    <a href="{{ route('edit-comment', $comment->id) }}" class="comment-controls btn btn-dark"><i class="bi bi-pencil-fill"></i></a>
                                        <form action="{{ route('reply.destroy') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="comment-controls btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                                            <input type="hidden" name="reply-id" value="{{ $reply->id }}">
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
