<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <link href="{{ config('social.all-min-css') }}" rel="stylesheet" type="text/css">
    <link href="{{ config('social.app-css') }}" rel="stylesheet" type="text/css">

</head>

<body style="background-color: #008080" >
    <div>
        <div class="container">
      
            <!-- Outer Row -->

            @yield('content')

        </div>
    </div>
    <!-- Bootstrap core JavaScript-->

    <script src="{{ config('social.jquery') }}"></script>
    <script src="{{ config('social.bootstrap-bundle') }}"></script>
    <script src="{{ config('social.home-js') }}"></script>

</body>

</html>
