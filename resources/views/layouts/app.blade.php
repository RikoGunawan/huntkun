<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', 'Hunt Kun - Minecraft & Doomsday')">
    <meta name="keywords" content="Minecraft, Doomsday, Gaming, Hunt Kun, Games, Story Mode, Minigames">
    <title>@yield('title', 'Hunt Kun')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Styles -->
    <style>
        body {
            font-family: 'Microsoft Sans Serif', sans-serif; /* Default Font */
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>

<body>
    <div id="app">
        <div class="custom-navbar">
            <a class="navbar-brand" href="{{ url('/') }}">
                Hunt Kun
            </a>

            <ul class="navbar-links navbar-left">
                <li><a href="{{ route('users.index') }}" @if (request()->routeIs('users.*')) class="active" @endif>Users</a></li>
                <li><a href="{{ route('minecraft.index') }}" @if (request()->routeIs('minecraft.*')) class="active" @endif>Minecraft</a></li>
                <li><a href="{{ route('doomsday.index') }}" @if (request()->routeIs('doomsday.*')) class="active" @endif>Doomsday</a></li>
            </ul>

            <ul class="navbar-links navbar-right">
                @guest
                    @if (Route::has('login'))
                        <li><a href="{{ route('login') }}">Login</a></li>
                    @endif

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endif
                @else
                    <li>
                        <a href="#" class="dropdown-toggle">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>

        </div>

        <main class="pb-4 container mx-auto w-90">
            @yield('content')
        </main>

        <footer class="footer">
            Made by Riko Gunawan
        </footer>
    </div>
</body>

</html>
