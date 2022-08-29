@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="flex-div">

        <div class="image-div">
            <img class="img" src="/../{{ $post->img_path }}" alt="post-img">
        </div>
        
        <div class="body-div">

            <div class="controls">
                @if(Auth::check())
                    @if(Auth::user()->id == $post->user_id)
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="cos-btn delete-btn">Delete</button>
                        </form>
                    @endif
                @endif
            </div>

            <div class="header-div">
                <h1>{{ $post->title }}</h1>
                <h6>Author: <strong><a href="{{ route('user.show', $post->user_id) }}">{{ $post->author }}</a></strong> - Date Published: {{ $post->created_at->toDateString(); }}</h6>
            </div>

            <div class="text-div">
                <p>{{ $post->text }}</p>
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
                <textarea id='comment' name="comment" cols="30" rows="3" placeholder="Comment Something..."></textarea>
                <button class="cos-btn">Comment</button>
            </form>
            <div class="comments">
                @foreach($comments as $comment)
                    @if($comment->post_id == $post->id)
                        <div class="commentors">
                            <h5><a href="{{ route('user.show', $comment->commenter_id) }}"><strong>{{ $comment->name }}</strong></a> - </h5><h6>Commented on: {{ $comment->created_at->toDateString() }}</h6>
                            <p>{{ $comment->comment }}</p>
                            @if(Auth::check())
                                @if(Auth::user()->id == $comment->commenter_id)
                                    <a href="{{ route('edit-comment', $comment->id) }}" class="comment-controls">Edit</a>
                                    <form action="{{ route('comment.destroy') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="comment-controls">Delete</button>
                                        <input type="hidden" name="comment-id" value="{{ $comment->id }}">
                                    </form>
                                @endif
                            <form action="{{ route('reply.store', $post->id) }}" method="POST">
                                @csrf
                                <button class="comment-controls">Reply</button>
                                <input type="hidden" name="comment-id" value="{{ $comment->id }}">
                                <input type="text" name="reply" class="reply">
                                @if ($errors->get('reply'))
                                    <span class="alert">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                    </span>
                                @endif
                            </form>
                            @endif
                        </div>

                        @foreach($replies as $reply)
                            @if($comment->id == $reply->comment_id)
                                <div class="replies">
                                    <h5><a href="{{ route('user.show', $reply->user_id) }}"><strong>{{ $reply->name }}</strong></a> - </h5><h6>Replied on: {{ $reply->created_at->toDateString() }}</h6>
                                    <p>{{ $reply->reply }}</p>
                                    @if(Auth::check())
                                        @if(Auth::user()->id == $reply->user_id)
                                            <a href="{{ route('edit-reply', $reply->id) }}" class="comment-controls">Edit</a>
                                            <form action="{{ route('reply.destroy') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="comment-controls">Delete</button>
                                                <input type="hidden" name="reply-id" value="{{ $reply->id }}">
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
