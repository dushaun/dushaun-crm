<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.admin_name') }}</title>

    <!-- Styles -->
    <link href="{{ mix('/css/crm/crm.css') }}" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.3.3/sweetalert2.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @section('navbar')
            <nav class="navbar navbar-default navbar-fixed-top">
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
                        <a class="navbar-brand" href="{{ url('/crm') }}">
                            DuShaun's Web Services
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/crm/enquiries') }}">Enquiries</a></li>
                            <li><a href="{{ url('/crm/clients') }}">Clients</a></li>
                            <li><a href="{{ url('/crm/jobs') }}">Jobs</a></li>
                            <li><a href="{{ url('/crm/invoices') }}">Invoices</a></li>
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
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
                        </ul>
                    </div>
                </div>
            </nav>
        @show

        <div class="container">
            @yield('content')
        </div>
    </div>

    @section('footer')
        <footer class="footer">
            <div class="container text-center">
                <p class="text-muted">Copyright &copy; {{ config('app.admin_name') }}. {{ date('Y') }}</p>
            </div>
        </footer>
    @show

    <!-- Scripts -->
    <script src="{{ mix('/js/crm/crm.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.3.3/sweetalert2.min.js"></script>
</body>
</html>
