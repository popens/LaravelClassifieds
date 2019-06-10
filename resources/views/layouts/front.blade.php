<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <header class="bg-white border-bottom">
        <div class="container-fluid">
            <div class="d-flex flex-column flex-md-row pt-3 pb-3 align-items-center">
                <h1 class="lc-head-logo my-0 mr-md-auto">Laravel Classifieds</h1>
                
                <nav class="my-2 my-md-0 mr-md-3">
                    <a class="p-2 text-dark" href="{{ url('/') }}">Home</a>
                    @if (Route::has('login'))
                        @auth
                            <a class="p-2 text-dark" href="{{ route('dashboard') }}">Dashboard</a>
                            <a class="p-2 text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a class="p-2 text-dark" href="{{ route('login') }}">Login</a>
                            <a class="p-2 text-dark" href="{{ route('register') }}">Register</a>
                        @endauth
                    @endif
                </nav>
                <a class="btn btn-secondary" href="#">POST FREE AD</a>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="bg-white border-top">
        <div class="container-fluid">
            <small class="d-block mb-3 text-muted">&copy; 2017-2019</small>
        </div>
    </footer>
</body>
</html>