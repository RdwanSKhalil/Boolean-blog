@extends('layouts.app')

@section('content')
<div class="wrapper">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('show-reply', $reply->id) }}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <label for="text" class="item label label-body">Edit Your reply:</label>
        <textarea name="text" value="{{ $reply->reply }}" class="item" id="text" cols="30" rows="10"></textarea>
        <input type="submit" class="cos-btn form-btn" value="Edit">
        <a href="{{ route('show-post', $reply->post_id) }}" class="cos-btn">Cancel</a>
    </form>
</div>
@endsection
