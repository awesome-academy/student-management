<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    
    <link href="{{ config('social.bootstrap') }}" rel="stylesheet">
    <link href="{{ config('social.index') }}" rel="stylesheet">
    <link href="{{ config('social.home-css') }}" rel="stylesheet">
    
</head>

<body id="page-top">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="{{ route('students.return_home') }}">
            @if (isset($student))
                @if (!empty($student->avatar))
                    <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                    src="{{ config('social.student-img') . $student->avatar }}" alt="avatar">
                @else
                    <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                    src="{{ config('social.student-img') }}default_avatar.jpg" alt="avatar">
                @endif
            @endif
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown" id="information">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                        {{ __('lang.information') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('students.return_information') }}">{{ __('lang.check_information') }}</a>
                        <a class="dropdown-item" href="{{ route('students.return_update_information') }}">{{ __('lang.update_information') }}</a>
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

    <script src="{{ config('social.jquery') }}"></script>
    <script src="{{ config('social.bootstrap-bundle') }}"></script>
    <script src="{{ config('social.home-js') }}"></script>
    
</body>

</html>
