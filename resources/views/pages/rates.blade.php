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

    <div class="homeHeader">

        {{--<div--}}

        <section id="page-top" class="title_only">


            <div class="wrapper">

                <div class="last">

                    <div id="breadcrumb-wrapper" class="title_only_bd">

                        <!-- Breadcrumb NavXT 6.0.4 -->
                        <span property="itemListElement" typeof="ListItem">
                            <a property="item" typeof="WebPage"  href="{{action('HomeController@index')}}" class="home">
                                <span property="name">{{ __('Classics') }}</span>
                            </a>
                            <meta property="position" content="1">
                        </span> &gt; <span property="itemListElement" typeof="ListItem">
                            <span property="name">{{ __('advertisement rates') }}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>


                <div id="header-left-content">

                    <h1>{{ __('advertisement rates') }}</h1>

                </div>



                <div class="clear"></div>

            </div>

        </section>
    </div>
    <div id="page-wrapper" class="wrapper">
        <div class="row">
            <div class="col-lg-8 card bg-darker text-white" style="margin-top: 20px;margin-bottom: 20px;padding: 20px;margin-left: 35px;">
                <section id="post-content">
                    <div class="the-content">
                        <p>&nbsp;</p>
                        <p><span style="color: #ffffff;">{{ __('Private persons can advertise (incl. tax);') }}</span></p>
                        <p><span style="color: #ffffff;">{{ __('per') }}<strong> 3&nbsp;</strong>{{ __('months for € 12,50') }}</span><br>
                            <span style="color: #ffffff;"> {{ __('per&nbsp;') }}<strong>6&nbsp;</strong>{{ __('months for € 20,-') }}</span><br>
                            <span style="color: #ffffff;"> {{ __('per') }} <strong>12</strong> {{ __('months for € 30,-') }}</span></p>
                        <p><span style="color: #ffffff;">{{ __('For businesses we have the following packages (prices are excl. tax):') }}</span></p>
                        <p><span style="color: #ffffff;"><strong>{{ __('List One;') }}</strong>&nbsp;1 advertisement € 25,-</span><br>
                            <span style="color: #ffffff;"> <strong>{{ __('Light') }}</strong>; 5 advertisements € 99,-</span><br>
                            <span style="color: #ffffff;"> <b>{{ __('Pro') }}</b>; 50 advertisements € 199,-</span><br>
                            <span style="color: #ffffff;"> <strong>{{ __('Max;') }}</strong>&nbsp;unlimited advertisements € 349,-</span></p>
                        <p><span style="color: #ffffff;"><b>{{ __('Extra credits') }}</b>; 50 advertisements € 179,-</span></p>
                        <p><span style="color: #ffffff;">{{ __('Apart from the advertisements your firm will be mentioned in the “specialists” section of the websites.') }}</span></p>
                        <p><span style="color: #ffffff;">{{ __('Companies can also opt for a banner; we have 3 banner periods:') }}</span></p>
                        <p><span style="color: #ffffff;">3 months&nbsp;€ 297,-</span><br>
                            <span style="color: #ffffff;"> 6&nbsp;months&nbsp;€ 495,-</span><br>
                            <span style="color: #ffffff;"> 12 months&nbsp;€ 990,-</span></p>
                        <p><span style="color: #ffffff;">{{ __('Please contact us with your questions or wishes;&nbsp;&nbsp;') }} </span>&nbsp;<span style="color: #ff6600; font-size: 16px;"><a href="mailto:contact@oldandyoungtimer.com">{{ __('contact@oldandyoungtimer.com') }}</a></span></p>
                        <p><span style="color: #999999;">{{ __('examples:') }}</span></p>
                        <p>
                            <img class="size-medium wp-image-394 alignleft" src="http://www.ccfb.biz/wp-content/uploads/2017/01/Victor-2837-March-16-2017-12.55-300x41.jpg" alt="" width="300" height="41"  sizes="(max-width: 300px) 100vw, 300px"></p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                            <img class="size-medium wp-image-396 alignleft" src="http://www.ccfb.biz/wp-content/uploads/2017/01/Victor-2837-March-16-2017-12.59-300x40.jpg" alt="" width="300" height="40" sizes="(max-width: 300px) 100vw, 300px"></p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>
                            <img class="size-medium wp-image-400 alignleft" src="http://www.ccfb.biz/wp-content/uploads/2017/01/Victor-2837-March-16-2017-14.02-300x39.jpg" alt="" width="300" height="39" sizes="(max-width: 300px) 100vw, 300px"></p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </div>
                </section>
            </div>
            <div id="sidebar" class="col-lg-3 sidebar-right last extendright">

            </div>
        </div>
    </div>
@stop

