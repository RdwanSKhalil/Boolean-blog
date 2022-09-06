@extends('layouts.app')

@section('tinyMCE')
    <script src="https://cdn.tiny.cloud/1/5ooaadfevtq6xn7vrf4bjpeaqyezzwdp3ie2tqdol4ofsm1z/tinymce/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
        selector: 'textarea#tinyMCEEditor',
        height: 220,
        theme: 'modern',
        mobile: { theme: 'mobile' },
        plugins: 'lists',
        toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat',
        menubar: false,
        });
    </script>
@endsection

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
        <form action="{{ route('post.edit', $post->id) }}" method="POST" class="form" enctype="multipart/form-data">
            @csrf
            <div class="choose-image-div">
                <label for="img" class="label label-file" name="imgPath-lbl">Image:</label>
                <input type="file" class="item input-file" id="img-edit" name="imgPath" accept=".gif,.jpg,.jpeg,.png">
            </div>
            <label for="title" class="item label label-title">Title:</label>
            <input type="text" class="item input input-title" name="title" value="{{ $post->title }}" id="title">
            <label for="text" class="item label label-body">Body:</label>
            <textarea id="tinyMCEEditor" name="text" value="{{ $post->text }}" class="item" cols="30" rows="10"></textarea>
            <div class="btn-margin">
                <input type="submit" class="btn btn-success" value="Post">
                <a href="{{ route('home') }}" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
@endsection
