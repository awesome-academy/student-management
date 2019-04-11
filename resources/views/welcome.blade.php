<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>{{ trans('lang.welcome_title') }}</title>
        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ trans('lang.welcome_content') }}
                </div>
                <div class="links">
                    <a href="">{{ trans('lang.welcome_admin') }}</a>
                    <a href="{{ route('students.return_home') }}">{{ trans('lang.welcome_student') }}</a>
                    
                </div>
            </div>
        </div>
    </body>
</html>
