<!doctype html>
<html>
<head>
    <link rel="shortcut icon" href="{{ asset('/img/favicon.png') }}" type="image/x-icon">
    {!!
        Minify::stylesheet([
            '/css/bootstrap.min.css',
            '/css/font-awesome.css',
            '/css/elements/live-preview.css',
         ])->withFullUrl()
    !!}
</head>
@yield('head')
<body>

@yield('content')

@include('template.jsVars')

</body>
</html>