@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/category.css')}}">
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
                            <span property="name">{{ __('working with us?') }}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>


                <div id="header-left-content">

                    <h1>{{ __('working with us?') }}</h1>

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
                        <h4><span style="color: #ffffff;">{{ __('For our advertisement websites we are looking for self-employed for the following functions;') }}</span></h4>
                        <p><span style="color: #ffffff;"><strong>{{ __('telephone advertisement sales:') }}</strong></span></p>
                        <ul>
                            <li>
                                <h4><span style="color: #ffffff;">{{ __('English speaking') }}</span></h4>
                            </li>
                            <li>
                                <h4><span style="color: #ffffff;">{{ __('German speaking') }}</span></h4>
                            </li>
                            <li>
                                <h4><span style="color: #ffffff;">{{ __('Italian speaking') }}</span></h4>
                            </li>
                            <li>
                                <h4><span style="color: #ffffff;">{{ __('French speaking') }}</span></h4>
                            </li>
                            <li>
                                <h4><span style="color: #ffffff;">{{ __('Spanish speaking') }}</span></h4>
                            </li>
                            <li>
                                <h4><span style="color: #ffffff;">{{ __('Polish speaking') }}</span></h4>
                            </li>
                            <li>
                                <h4><span style="color: #ffffff;">{{ __('Chinese speaking') }}</span></h4>
                            </li>
                        </ul>
                        <h4><span style="color: #ffffff;">&nbsp;</span></h4>
                        <p><span style="color: #ffffff;"><strong>{{ __('design and maintanance:') }}</strong></span></p>
                        <h4><span style="color: #ffffff;">{{ __('We are looking for a partner for both maintenance and webdesign for all our projects.') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('You can contact us by mail:&nbsp;&nbsp;&nbsp;') }} <a href="mailto:contact@oldandyoungtimer.com">{{ __('contact@oldandyoungtimer.com') }}</a></span></h4>
                        <p>&nbsp;</p>
                        </div>

                </section>
            </div>
            <div id="sidebar" class="col-lg-3 sidebar-right last extendright">

            </div>
        </div>
    </div>
@stop

