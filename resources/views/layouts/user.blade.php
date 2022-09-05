@extends('layouts.app')
@section('content')
<div class="wrapper">
    <div class="user-header">
        <div class="user-img-div">
            <div class="dropdown">
                <img class="user-img" src="/../{{ $user->img_path }}" alt="user-img">
                @if(Auth::check())
                    @if(Auth::user()->id == $user->id)
                        <div class="dropdown-content">
                            <label for="file-input">
                                <img class="user-img-change" src="/../images/change-user-img.png" alt="user-img">
                                <form action="{{ route('user.store-img', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input id="file-input" class="hidden-img-input" type="file" name="imgPath" value="{{ old('imgPath') }}" accept=".gif,.jpg,.jpeg,.png" onchange="this.form.submit();">
                                </form>
                            </label>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="user-name-div">
            @if(Auth::check())
                @if(Auth::user()->id == $user->id)
                    <h1 class="user-name">Your Profile</h1>
                @else
                    <h1 class="user-name">{{ $user->name }}'s Profile</h1>
                @endif
            @endif
        </div>
        <div class="user-info">
            <h6><strong>Registered On:</strong> {{ $user->created_at->toDateString() }}</h6>
            <h6><strong>Email Address:</strong> {{ $user->email }}</h6>
        </div>
        <div class="user-info">
            <h6><strong>No. Posts:</strong> {{ $user->posts->count() }}</h6>
            <h6><strong>No. Comments:</strong> {{ $user->comments->count() }}</h6>
        </div>
        <div class="btn-group user-nav" role="group" aria-label>
            <a href="{{ route('user.posts', $user->id) }}" class="btn btn-primary">Posts</a>
            <a href="{{ route('user.comments', $user->id) }}" class="btn btn-primary">Comments</a>
            @if(Auth::check())
                @if(Auth::user()->id == $user->id)
                    <a href="{{ route('user.info', $user->id) }}" class="btn btn-primary">Change Your Info</a>
                @endif
            @endif
        </div>
    </div>
    @yield('user-content')
</div>
@endsection
