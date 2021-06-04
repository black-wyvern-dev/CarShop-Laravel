<style type="text/css">
    .pagination{
        margin-left: auto;
        margin-right: auto;
        font-size: 12px;
    }
    .page-link:hover {
        color: #fff;
        text-decoration: none;
        background-color:#000;
        border-color:#dee2e6;
    }
    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color:#000;
        border-color:#000;
    }
    ul.pagination li a {
        margin-left: auto;
        margin-right: auto;
        color: white;
        background-color:#000;
    }
    .page-item.page-link-separator.disabled .page-link,
    .pagination li.page-item .page-link-separator disabled,
    li.page-item {
        color: white !important;
        background-color:#000 !important;
        border-color: grey;
    }
    .page-item.disabled .page-link,
    .pagination .page-item  disabled{
        color: grey !important;
        background-color:#000 !important;
        border-color: grey;
    }
    .page-item.page-link-separator.disabled .page-link,
    .pagination li.page-item .page-link-separator disabled {
        color: grey !important;
        border-color: grey;
    }
    a.page-link,
    span.page-link {
        border-color: grey;
    }
    li.page-item.active span.page-link {
        border-color: white;
    }

    .header-section {
        display:flex;
        align-items:center;
        flex-direction : row-reverse;
        justify-content : space-between
    }
    .navbar-nav-ul {
        display: flex;
        flex-wrap: wrap;
        align-items:center
    }
    .social-icon {
        font-size : 25px
    }

    .mobileMenu {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        list-style: none;
        padding: 0px;
    }

    .mobileMenu li{
        padding : 0px 0px;
    }
    .mobileMenu li a{
        color : white;
    }

    .mobileMenu .nav-link {
        padding : 0.5rem 0.3rem;
    }
    .mobileMenuHeader #page-top {
        background-size: 100% 100%;
        margin-bottom: 13px;
        background-image: url("https://www.classics.nl/img/formBg-inside.jpg");
    }
    .mobileMenuHeader ul {
        margin-bottom: 0px;

    }

    @media only screen and (max-width: 768px) {
        #logo-container {
            margin: auto !important;
        }
    }
</style>

@section('styles')
    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
@endsection
<!-- <div class="override-margin"></div> -->

@if(!App::environment('production'))
    <div id="non-production-banner" style="position:absolute;top:0;left:0;width:100%;height:20px;background-color:pink;z-index:9999;color:orangered;font-weight:bold;font-size:14px;text-align:center;">
        NON-PRODUCTION
        <a href="#" style="position:absolute;right:4px;top:1px;color:red;font-weight:bold" onclick="document.getElementById('non-production-banner').style.display = 'none';return false;">{{ __('X') }}</a>
    </div>
@endif

<section id="top-bar">
    <div class="container">
        <div class="row">

        <div class="col-6">
            <div class="d-none d-sm-block" style="padding-top: 20px;">{{ __('Classics, passion for the past') }}</div>
            <button class="navbar-toggler toggler-example categoryBttn" type="button" data-toggle="collapse" data-target="#userMobileContent1"
                    aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation"><span class="dark-blue-text"><i class="fas fa-bars fa-1x"></i></span></button>
                <!-- Collapsible content -->
            @if(Auth::check())
                <!-- Collapse button -->
                <button class="navbar-toggler toggler-example userBttn" type="button" data-toggle="collapse" data-target="#userMobileContent2" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">{{Auth::user()->firstName}}</button>
            @endif
        </div>
        <div class="col-6" style="text-align: left; padding-top: 20px;">
            <ul class="nav justify-content-end">
                    @if(Auth::check())
                        <div style="    float: right;margin-top: -6px;" class="d-sm-block d-none dropdown show">
                            <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{Auth::user()->firstName}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{action('AdvertiseController@index')}}">{{ __('Advertise') }}</a>
                                <a class="dropdown-item" href="{{action('ListingsController@userListings')}}">{{ __('My listings') }}</a>
                                <a class="dropdown-item" href="{{action('UserController@userProfile')}}">{{ __('My Account') }}</a>
                                <a class="dropdown-item" href="{{route('logout')}}">{{ __('Logout') }}</a>
                            </div>
                        </div>
                    @else

                        <li style="float: left;" class="d-sm-block d-none">{{ __('Hello visitor, not registered yet?') }}</li>

                        <li><a href="{{ route('login') }}" id="open-login" class="login wpml-btn login-window"><i class="fas fa-sign-out-alt"></i> {{ __('Sign In') }}</a> {{ __('or') }} <a href="{{ route('register') }}" id="open-login" class="login wpml-btn login-window"> {{ __('Register') }}</a></li>
                    @endif

                </ul>
        </div>

        <div class="clear"></div>

    </div><!-- end wrapper -->
    </div>
</section>
<div class="override-margin"></div>


<section class="container header-section">
    <!-- Collapsible content -->
    <div class="collapse navbar-collapse">

        <!-- Links -->
        <ul class="navbar-nav navbar-nav-ul">
            <li class="nav-item active">
                <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'cars'])}}">{{ __('cars') }}</a></li>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'motorbikes'])}}">{{ __('motorbikes') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'mopeds'])}}">{{ __('mopeds') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'boats'])}}">{{ __('boats') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'automobila'])}}">{{ __('automobilia') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'parts'])}}">{{ __('parts') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{action('SpecialistsController@index')}}">{{ __('specialists') }}</a>
            </li>

            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                <a class="nav-link" href="https://www.facebook.com/oldandyoungtimer.classics" style = "color : transparent ;">
                    <i class="fab fa-facebook-f social-icon"></i>
                </a>
            </li>
            <li class="menu-item menu-item-type-custom menu-item-object-custom">
                <a class="nav-link" href="https://www.instagram.com/oldandyoungtimer/">
                    <i class="fab fa-instagram social-icon"></i>
                </a>
            </li>
        </ul>
        <!-- Links -->

    </div>
    <!-- Collapsible content -->
    @if(Auth::check())
        <div class="collapse navbar-collapse" id="userMobileContent2">
            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{action('AdvertiseController@index')}}">{{ __('Advertise') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{action('ListingsController@userListings')}}">{{ __('My listings') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{action('UserController@userProfile')}}">{{ __('My Account') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('logout')}}">{{ __('Logout') }}</a>
                </li>
            </ul>
            <!-- Links -->
        </div>
    @endif

    <style scoped>
        .menu-menu-container li a {
            font-size : 21px;
            font-weight : 300;
        }
    </style>
     <div id="navigation-wrapper" class="d-none d-sm-block two_third last" style = "padding-top : 0px;">
        <div class="menu-menu-container">
            <ul id="menu-menu-1" class="sf-menu sf-js-enabled sf-arrows navbar-nav-ul">
                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a href="{{action('CategoryController@getSearch', ['category' => 'cars'])}}">{{ __('cars') }}</a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a href="{{action('CategoryController@getSearch', ['category' => 'motorbikes'])}}">{{ __('motorbikes') }}</a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a href="{{action('CategoryController@getSearch', ['category' => 'mopeds'])}}">{{ __('mopeds') }}</a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a href="{{action('CategoryController@getSearch', ['category' => 'boats'])}}">{{ __('boats') }}</a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a href="{{action('CategoryController@getSearch', ['category' => 'automobilia'])}}">{{ __('automobilia') }}</a>
                </li>
                <li class="menu-item menu-item-type-post_type menu-item-object-page">
                    <a href="{{action('CategoryController@getSearch', ['category' => 'parts'])}}">{{ __('parts') }}</a>
                </li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                    <a href="{{action('SpecialistsController@index')}}">{{ __('specialists') }}</a>
                </li>


                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                    <a class="" href="https://www.facebook.com/oldandyoungtimer.classics" style = "color : transparent ;">
                        <i class="fab fa-facebook-f social-icon"></i>
                    </a>
                </li>
                <li class="menu-item menu-item-type-custom menu-item-object-custom">
                    <a class="" href="https://www.instagram.com/oldandyoungtimer/">
                        <i class="fab fa-instagram social-icon"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="logo-container" class="">
        <a href="{{action('HomeController@index')}}">
            <img src="{{asset('img/classics-specialists-logo-001.png')}}" alt="">
        </a>
    </div>
    <!-- <div class="clear"> -->
</section> <!-- end section -->
<div class="override-margin"></div>

<div class="mobileMenuHeader category collapse"  id="userMobileContent1">
    <section id="page-top" class="title_only">
        <!-- <div class="wrapper" style=" border:0px solid red;margin-left: auto; margin-right: auto; width: 70%;"> -->
        <div class="container">
            <div class="last">
                <ul class="mobileMenu">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'cars'])}}">{{ __('cars') }}</a></li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'motorbikes'])}}">{{ __('motorbikes') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'mopeds'])}}">{{ __('mopeds') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'boats'])}}">{{ __('boats') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'automobila'])}}">{{ __('automobilia') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('CategoryController@getSearch', ['category' => 'parts'])}}">{{ __('parts') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('SpecialistsController@index')}}">{{ __('specialists') }}</a>
                    </li>

                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a class="nav-link" href="https://www.facebook.com/oldandyoungtimer.classics">
                            like us on &nbsp;<i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="menu-item menu-item-type-custom menu-item-object-custom">
                        <a class="nav-link" href="https://www.instagram.com/oldandyoungtimer/">
                            follow us on &nbsp;<i class="fab fa-instagram"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>

