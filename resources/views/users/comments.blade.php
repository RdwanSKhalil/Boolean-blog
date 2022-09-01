@extends('layouts.user')

@section('user-content')
    @foreach($comments as $comment)
    <div class="commentors">
        <h5><strong>{{ $user->name }}</strong> - </h5><h6>Commented on: {{ Carbon\Carbon::parse($comment->created_at)->format('Y-m-d') }}</h6>
        <p>{{ $comment->comment }}</p>
        @if(Auth::check())
            @if($comment->commenter_id == Auth::user()->id)
                <form action="{{ route('comment.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="comment-controls">Delete</button>
                    <input type="hidden" name="comment-id" value="{{ $comment->id }}">
                </form>
            @endif
        @endif
    </div>
    @endforeach
    @if(count($comments) == 0)
        <div class="info-flex">
            <div class="no-info">
                <h1>No Comments Yet</h1>
            </div>
        </div>
    @endif 
@endsection
