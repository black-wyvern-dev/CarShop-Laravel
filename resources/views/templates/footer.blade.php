<style>
    .footer-infors {
        display:flex;
        flex-wrap: wrap;
        justify-content : space-between;
    }
    .social-icons {
        width : 230px;
        display : flex;
        flex-direction: column;
        justify-content : space-around;
    }
    

    .signinupStyle {
        display:flex;
        justify-content : flex-end;
        margin-top:10px;
        align-items:flex-end;
        color : #fec31d;
    }

    .internal p {
        margin-bottom: 0rem
    }

    .internal h3 {
        margin-bottom: 0rem;
    }

    .internal {
        position: unset !important;
        margin : 0px !important;
    }

    .widget-title {
        border-color: #fec31d !important;
    }

    #copyright-holder a{
        display: none
    }

    @media only screen and (max-width: 765px) {
        #nav_menu-8 {
            display:block;
            width : 100%;
        }
        .social-icons {
            width : 100%;
        }
        .footer-infors {
            width : 100%;
            justify-content: center;
        }
        .signinupStyle {
            justify-content: center;
            margin-bottom : 30px;
        }
        .internal {
            text-align: center !important;
        }
        .footer-menus-wrapper {
            text-align: center;
        }
        #copyright-holder a{
            display: block
        }

        .footer-menus-wrapper{
            width : 200px;
        }
    }

</style>

<footer class="override-margin">

    <div class="container" style="">
    <!-- <div class="footer_wrapper" style=""> -->

        <div class="top-footer footer-single-column">
            <div class = "footer-infors">
                <!-- <div id="nav_menu-8" class="widget d-none d-sm-block widget_nav_menu"> -->
                <div class = "footer-menus-wrapper">
                    <h3 class="widget-title" style="border-color: #fec31d !important"><span>{{ __('information') }}</span></h3>
                    <!-- <span style="margin-top: -21px;" class="footer-border"></span> -->
                    <div class="menu-diverse-container">
                        <ul id="menu-diverse" style="list-style: none; padding :0px" class="menu dropit">
                            @include('elements.footer-links')
                        </ul>
                    </div>
                </div>

                <div class="internal" style="text-align: right">
                    <h3 >{{ __('Total advertisements') }}</h3>
                    <p><span class="number" style="font-size: 18px;">{{Helper::getTotalAdvertisements()}}</span></p>
                    <h3>{{ __('Registered users') }}</h3>
                    <p><span class="number" style="font-size: 18px;">{{Helper::getTotalRegisteredUsers()}}</span></p>
                    <h3>{{ __('Would you like to advertise?') }}</h3>
                    <div class = "signinupStyle" style="font-size: 15px;">
                        <a class="" href="{{ route('login') }}">
                            <!-- <img src = "https://cdn3.iconfinder.com/data/icons/round-icons-vol-2/512/Login_enter-512.png" style = "width : 50px; height : 50px; background-size : 100% 100%"> -->
                            <i class="fas fa-sign-in-alt" style = "font-size : 23px"></i><br>
                            login
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;&nbsp;
                        <a class="" href="{{ route('register') }}">
                            <!-- <img src = "https://cdn0.iconfinder.com/data/icons/follower/154/follower-man-user-login-round-512.png" style = "width : 50px; height : 50px; background-size : 100% 100%"> -->
                            <i class="fas fa-user-plus" style = "font-size : 23px"></i><br>
                            register
                        </a>
                    </div>
                </div>
            </div>

            <div id="copyright-holder" style="text-align: center; border-color: #fec31d !important">
                <p>&copy; 1997-2021 Classics.nl + OldandYoungtimer.com</p>
                <a href="{{action('HomeController@index')}}">
                    <img src="https://i.ibb.co/SJfxBkn/oldandyounglogo.png" alt="" style ="width : 60%">
                </a>
            </div>

        </div>
        <!-- <div class="clearboth"></div> -->
    </div>
</footer>
