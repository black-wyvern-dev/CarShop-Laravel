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
                            <span property="name">{{ __('insurance') }}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>


                <div id="header-left-content">

                    <h1>{{ __('insurance') }}</h1>

                </div>



                <div class="clear"></div>

            </div>

        </section>
    </div>
    <div id="page-wrapper" class="wrapper">
        <div class="row">
            <div class="col-lg-8 card bg-darker text-white" style="margin-top: 20px;margin-bottom: 20px;padding: 20px;margin-left: 35px;">
                <div class="the-content">
                    <h3><span style="color: #ffffff;">{{ __('Make sure your pride and joy is insured properly.') }}</span></h3>
                    <h3><span style="color: #ffffff;">{{ __('Insure your cars, motorcycles, mopeds or boats against all things possible.') }}</span></h3>
                    <h3><span style="color: #ffffff;">{{ __('Please contact us for a tailormade quote') }}</span></h3>
                    <h3><span style="color: #ffffff;">&nbsp;</span></h3>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </div>
            </div>
            <div id="sidebar" class="col-lg-3 sidebar-right last extendright">

            </div>
        </div>
    </div>
@stop

