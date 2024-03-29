<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DuShaun - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
@yield('front-page-style')

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    @section('navbar')
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        @if(Auth::guest())
                            DuShaun
                        @else
                            DuShaun's Web Services
                        @endif
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @if(Auth::guest())
                            <li><a href="{{ url('/about') }}">About</a></li>
                            <li><a href="{{ url('/services') }}">Services</a></li>
                            <li><a href="{{ url('/portfolio') }}">Portfolio</a></li>
                            <li><a href="{{ url('/contact') }}">Contact</a></li>
                        @else
                            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            {{--<li><a href="{{ url('/login') }}">Login</a></li>--}}
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    @show

    @yield('content')
</div>

@section('footer')
    <footer class="footer">
        <div class="flex-center position-ref">
            <div class="links alt">
                <a href="https://medium.com/@dushaun"><i class="fa fa-medium fa-2x" aria-hidden="true"></i></a>
                <a href="https://twitter.com/DuShaunUK"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/dushaun_uk/"><i class="fa fa-instagram fa-2x" aria-hidden="true"></i></a>
                <a href="https://github.com/dushaunac"><i class="fa fa-github fa-2x" aria-hidden="true"></i></a>
            </div>
        </div>
    </footer>
@show

<!-- Scripts -->
<script src="{{ elixir('js/app.js') }}"></script>
</body>
</html>