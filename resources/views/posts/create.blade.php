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
    <form action="/post" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <label for="img" class="item label label-file" name="imgPath-lbl">Image:</label>
        <input type="file" class="item input-file" id="img" name="imgPath" value="{{ old('imgPath') }}" accept=".gif,.jpg,.jpeg,.png">
        <label for="title" class="item label label-title">Title:</label>
        <input type="text" class="item input input-title" name="title" value="{{ old('title') }}" id="title">
        <label for="text" class="item label label-body">Body:</label>
        <textarea name="text" value="{{ old('text') }}" class="item" id="text" cols="30" rows="10"></textarea>
        <div class="btn-margin">
            <input type="submit" class="cos-btn form-btn" value="Post">
            <a href="{{ route('home') }}" class="cos-btn">Cancel</a>
        </div>
    </form>
</div>
@endsection
