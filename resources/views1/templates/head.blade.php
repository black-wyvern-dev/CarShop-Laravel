{{-- Generic Meta tags --}}

<meta charset="utf-8">
<title>{{ __('OldandYoungtimer') }}</title>
{{-- Favicon --}}
<link rel="shortcut icon" href="{{ asset('/img/favicon.png') }}" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- Mobile tab color --}}
<meta name="theme-color" content="#505050">

{{-- Fonts --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,300,500,600,700" rel="stylesheet">

@php
    $rootUrl = url('/');
    $appUrl  = \Illuminate\Support\Facades\Config::get('app.url');
    try {
        $urlGenerator = \Illuminate\Support\Facades\App::make(\Illuminate\Routing\UrlGenerator::class);
        $urlGenerator->forceRootUrl($appUrl);
@endphp
<link rel="canonical" href="{{ \Illuminate\Support\Facades\URL::current() }}" />
@php
    } finally {
        $urlGenerator->forceRootUrl($rootUrl);
    }
@endphp
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script data-ad-client="ca-pub-1283053404635250" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('css/fontawesome.min.css')}}">
<link rel="stylesheet" href="{{asset('css/styles.css')}}">
<link rel="stylesheet" href="{{asset('css/app.css')}}">
@yield('styles')


<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-tab-history.min.js')}}"></script>
<script src="{{asset('js/mfValid.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>
@yield('scripts')
