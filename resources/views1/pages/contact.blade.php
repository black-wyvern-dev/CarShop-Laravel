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
                            <span property="name">{{ __('about us') }}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>


                <div id="header-left-content">

                    <h1>{{ __('about us') }}</h1>

                </div>



                <div class="clear"></div>

            </div>

        </section>
    </div>
    <div id="page-wrapper" class="wrapper">
        <div class="row">
            <div class="col-lg-8 text-white" style="margin-top: 20px;margin-bottom: 20px;padding: 20px;margin-left: 35px;">
                <section id="post-content">

                    <div class="the-content">
                        <h4><span style="color: #ffffff;">{{ __('CCFB (Classic Cars + Fast Beauties), Classics24 and Oldandyoungtimer started out of love for classic cars.') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('At the beginning of the 80’s I was already involved with classic cars, the photographer who I worked with had a great collection of merely Italian thorougbreds and I could just chose whatever model I wanted to drive. Hence you could find me driving Montreals (he had 4') }} <img draggable="false" class="emoji" alt="🙂" src="https://s.w.org/images/core/emoji/11/svg/1f642.svg"> ) and a rare Fiat 1500 Ghia on my way to photoshoots.</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('Those were the days.') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('And I drove around Amsterdam in my Fiat 600, yes, I was a daredevil!') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('In the pre-internet era one had to rush to the newspaper shops to buy the Saturday’s paper, that was the place to look for gems like the Porsche 356 or Montreals, not many people wanted them back then…. These cars where underrated and really cheap.') }}</span><br>
                            <span style="color: #ffffff;"> {{ __('When the internet apeared, a friend of mine claimed Classics.nl and made it into a hobbysite advertsing some classics of his customers.') }}</span><br>
                            <span style="color: #ffffff;"> {{ __('When I obtained the domain from him in 2002, I transformed the site into a slightly more modern website, catering not only classic cars, but also cameras, watches, LP-albums etc.') }}</span><br>
                            <span style="color: #ffffff;"> {{ __('Classics.nl evolved into a more streamlined website only catering for cars, bikes and boats in 2007, and we obtained many url’s in many languages.') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('At this moment we have many advertisers from many parts of the World and have sections like cars, motorbikes, mopeds, boats etcetera.') }}</span></h4>
                        <h4><span style="color: #ffffff;">{{ __('Classics, Passion for the past!') }}</span></h4>
                        <p><span style="color: #ffffff;">{{ __('Victor van Cruijsen') }}</span></p>
                        <p><span style="color: #ffffff;">{{ __('CCFB') }}</span><br>
                            <span style="color: #ffffff;"> {{ __('Classics24') }}</span><br>
                            <span style="color: #ffffff;"> {{ __('Oldandyoungtimer') }}</span></p>
                        <p><img class=" wp-image-919 aligncenter" src="http://www.ccfb.biz/wp-content/uploads/2016/11/Victor-4996-July-26-2017-13.56.jpg" alt="" width="304" height="110" srcset="http://www.ccfb.biz/wp-content/uploads/2016/11/Victor-4996-July-26-2017-13.56.jpg 593w, http://www.ccfb.biz/wp-content/uploads/2016/11/Victor-4996-July-26-2017-13.56-300x109.jpg 300w" sizes="(max-width: 304px) 100vw, 304px"></p>
                        <p>&nbsp;</p>
                        <div id="ca-pub-4193431005629062:7430574998" class="ads ads_after"><script type="text/javascript">
                                google_ad_client = "ca-pub-4193431005629062";
                                google_ad_slot = "7430574998";
                                google_ad_width = 728;
                                google_ad_height = 90;
                            </script>
                            <!-- Qualitystuff, onderaan -->
                            <script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/show_ads.js">
                            </script></div>		</div>

                </section>
            </div>
            <div id="sidebar" class="col-lg-3 sidebar-right last extendright">

            </div>
        </div>
    </div>
@stop

