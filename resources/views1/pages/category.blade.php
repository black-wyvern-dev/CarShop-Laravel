@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/selectize.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/category.css')}}">

@endsection

@section('scripts')
    <script src="{{asset('js/jquery-sortable.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('js/microevent.js')}}"></script>
    <script src="{{asset('js/selectize.js')}}"></script>
    <script src="{{asset('js/pages/category.js')}}"></script>
@endsection

@section('content')

    <div class="homeHeader category">


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
                            <span property="name">{{$category}}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>


                <div id="header-left-content">

                    <h1>{{$category}}</h1>

                </div>



                <div class="clear"></div>

            </div>

        </section>
    </div>
    <div id="page-wrapper" class="wrapper category">
        <div class="row">
            <div class="col-lg-8 text-white" style="margin-top: 20px;margin-bottom: 20px;padding: 0px;margin-left: auto; margin-right: auto;">
                @if($type == 'Car')
                    @include('elements.listings')
                @elseif($type == 2)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/BonnevilleT100EFI_3.png" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 3)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2017/06/Brommer9.jpg" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 4)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/9221d4f8347a79b264b5c165fc9b3cdc.jpg" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 5)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/1425919254-08593d92ae74ab427c55dd685bfcf3a4-1366x909.jpg" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @elseif($type == 6)
                    <div class="the-content">
                        <p>{{ __('available soon') }}</p>
                        <p><img class="size-full-img" src="http://www.ccfb.biz/wp-content/uploads/2016/11/BonnevilleT100EFI_3.png" alt="" width="800" height="450"></p>
                        <p>&nbsp;</p>
                    </div>
                @endif
            </div>

            @include('elements.sidebar-footer-ads')
        </div>
    </div>

@stop

