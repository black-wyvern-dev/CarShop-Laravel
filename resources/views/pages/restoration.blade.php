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
                            <span property="name">{{ __('car restoration') }}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>


                <div id="header-left-content">

                    <h1>{{ __('car restoration') }}</h1>

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
                        <h4><span style="color: #ffffff;">{{ __('Classic cars are nice!') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('However, sometimes these classic cars are neglected by their former owners and been transformed into mega rust cases…. or worse.') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('Together with you we can fix these cars back to their former glory, both optically as technically.') }}</span></h4>
                        <h4></h4>
                        <h4></h4>
                        <h4><span style="color: #ffffff;">{{ __('Contact us about the possibilities.') }}</span></h4>
                        <p><img class="alignnone wp-image-787 size-large" src="http://www.ccfb.biz/wp-content/uploads/2017/07/Art-Big-1024x681.jpg" alt="" width="640" height="426" sizes="(max-width: 640px) 100vw, 640px"></p>
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

