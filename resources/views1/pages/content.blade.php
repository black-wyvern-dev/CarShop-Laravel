@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/category.css')}}">
@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function() {
            $('#tdp_car_search-3 .widget-title').click( function() {
                $('.search-form-widget').toggle();
            });
        });
    </script>
@endsection
@section('content')
@php
// get the page content
$content = $pages['description'];

// add newlines if necessary
if (strip_tags($content) === $content) {
    $content = nl2br($content);
}

// replace email addresses with links, if not already a link
$content = preg_replace_callback('/(?<!")\b([a-z+-=_.]+@[a-z_-]+(\.[a-z_-]+){1,3})(?!")(?!<\/a)/', function($matches) {
    $email = htmlentities($matches[1], ENT_QUOTES, 'UTF-8');
    return '<a href="mailto:' . $email . '">' . $email . '</a>';
}, $content);
@endphp
    <div class="homeHeader">
        <section id="page-top" class="title_only">
            <div class="wrapper" style=" border:0px solid red;margin-left: auto; margin-right: auto; width: 70%;">
                <div class="last">
                    <div id="breadcrumb-wrapper" class="title_only_bd">

                        <!-- Breadcrumb NavXT 6.0.4 -->
                        <span property="itemListElement" typeof="ListItem">
                            <a property="item" typeof="WebPage"  href="{{action('HomeController@index')}}" class="home">
                                <span property="name">{{ __('Classics') }}</span>
                            </a>
                            <meta property="position" content="1">
                            </span> &gt; <span property="itemListElement" typeof="ListItem">
                            <span property="name">{{$pages['title']}}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>

                <div id="header-left-content">
                    <h1>{{$pages['title']}}</h1>
                </div>

                <div class="clear"></div>
            </div>
        </section>
    </div>

    <div id="page-wrapper" class="wrapper" style=" border:0px solid green;width: 70%">
        <div class="row">
            <div class="col-lg-8 text-white" style="margin-top: 20px;margin-bottom: 20px;padding: 0px;margin-left: auto; margin-right: auto;">
                <section id="post-content">
                    <div class="the-content">
@if(!$pages['enabled'])
                        <div id="preview"><span>{{ __('PREVIEW') }}</span></div>
@endif
                            {!! $content !!}
                    </div>
                </section>
            </div>
            <div id="sidebar" class="col-lg-3 sidebar-right last extendright"></div>
        </div>
    </div>
@stop

