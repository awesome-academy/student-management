<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    @if (isset($student))
        {{ $student->full_name }}
    @endif
    <br>
    <a href="{{ route('students.do_logout') }}">{{ trans('lang.logout') }}</a>
</body>
</html>
