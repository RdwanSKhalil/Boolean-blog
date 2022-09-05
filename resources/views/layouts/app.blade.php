<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Boolean Blog</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Get Tiny MCE component -->
    @yield('tinyMCE')

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <div id="app">
        <nav class="navbar-home">

            <ul class="logo">
                <li><a href="{{ url('/') }}">Blog</a></li>
            </ul>

            <ul class="creds">
                @if(Auth::check())
                    <li>
                        <div class="dropdown">
                            <a class="user-profile" href="{{ route('user.show', Auth::user()->id) }}">{{ Auth::user()->name }}</a>
                            <div class="dropdown-content">
                                <a href="{{ route('user.posts', Auth::user()->id) }}">Posts</a>
                                <a href="{{ route('user.comments', Auth::user()->id) }}">Comments</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                            </div>
                        </div>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                    </form>
            </ul>

        </nav>

        <main>
            @yield('content')
        </main>

    </div>

    <footer class="footer">
        <ul class="ul-footer">
            <li>&copy;2022 Boolean Blog, All rights reserved</li>
            <li>Developer: Rdwan Salih Khalil</li>
        </ul>
    </footer>

    <!--Importing Jquery-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
</body>

</html>
