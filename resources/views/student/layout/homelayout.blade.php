<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    
    <link href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/css/index') }}" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    
</head>

<body id="page-top">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="{{ route('students.return_home') }}">
            <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="{{ asset('/student_img/4_7.jpg') }}"
            alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown" id="information">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                        {{ __('lang.information') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">{{ __('lang.update_information') }}</a>
                    </div>
                </li>
                <li class="nav-item" id="register">
                    <a class="nav-link" href="#">{{ __('lang.subject_register') }}</a>
                </li>
                    
                <li class="nav-item" id="logout">
                    <a class="nav-link" href="{{ route('students.do_logout') }}">{{ __('lang.logout') }}</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid p-0">
        @yield('content')
    </div>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/home.js') }}"></script>
    
</body>

</html>
