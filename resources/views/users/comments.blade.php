@extends('layouts.user')

@section('user-content')
    @if(session('deleted'))
        <div class="alert alert-success">
            {{ session('deleted') }}
        </div>
    @endif
    @foreach($user->comments as $comment)
    <div class="card mb-3 rounded">
        <div class="card-header">
            <img class="commentator-img inline me-2" src="/../{{ $comment->user->img_path }}" alt="commenter-img">
            <h5 class="inline"><strong>{{ $user->name }}</strong> - </h5><h6 class="inline opacity-75">Commented on: {{ Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</h6>
        </div>
        <div class="card-body p-3">
            <p>{{ $comment->comment }}</p>
            <a href="{{ route('edit-comment', $comment->id) }}" class="comment-controls btn btn-dark"><i class="bi bi-pencil-fill"></i></a>
            @if(Auth::check())
                @if($comment->commenter_id == Auth::user()->id)
                    <form action="{{ route('comment.destroy') }}" class="inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="comment-controls btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        <input type="hidden" name="comment-id" value="{{ $comment->id }}">
                    </form>
                @endif
            @endif
        </div>
    </div>
    @endforeach
    @if($user->comments->count() == 0)
        <div class="info-flex">
            <div class="no-info">
                <h1>No Comments Yet</h1>
            </div>
        </div>
    @endif 
@endsection
