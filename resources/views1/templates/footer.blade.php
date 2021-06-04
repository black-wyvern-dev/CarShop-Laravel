<footer class="override-margin">

    <div class="footer_wrapper" style="">



        <div class="top-footer footer-single-column">
            <div class="row">
{{--
                <div class="col-lg-4">
                    <div id="newsletterwidget-7" class="widget widget_newsletterwidget">
                        <h3 class="widget-title"><span>{{ __('newsletter') }}</span></h3>
                        <span style="margin-top: -21px;" class="footer-border"></span>would you like to receive our newsletters?
                        <div class="tnp tnp-widget">
                            <form method="post" action="http://www.ccfb.biz/?na=s" onsubmit="return newsletter_check(this)">
                                    <input type="hidden" name="nr" value="widget">
                                <input type="hidden" name="nl[]" value="0">
                                <div class="tnp-field tnp-field-email"><label>{{ __('Email') }}</label><input class="tnp-email" type="email" name="ne" required=""></div>
                                <div class="tnp-field tnp-field-button"><input class="tnp-submit" type="submit" value="Subscribe">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
--}}
                <div class="col-md-6">
                    <div id="nav_menu-8" class="widget d-none d-sm-block widget_nav_menu">
                        <h3 class="widget-title"><span>{{ __('information') }}</span></h3>
                        <span style="margin-top: -21px;" class="footer-border"></span>
                        <div class="menu-diverse-container">
                            <ul id="menu-diverse" style="list-style: none" class="menu dropit">
                                @include('elements.footer-links')
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="stats-column col-md-6" style="height: 378px;">
                    <div id="nav_menu-8" class="d-block d-sm-none widget_nav_menu"><h3 class="widget-title">
                            <span>{{ __('information') }}</span></h3>
                        <div class="menu-diverse-container">
                            <ul id="menu-diverse" style="list-style: none" class="menu dropit">
                                @include('elements.footer-links')
                            </ul>
                        </div>
                    </div>
                    <div class="internal">

                        <h3>{{ __('total advertisements') }}</h3>
                        <p><span class="number" style="font-size: 27px;">{{Helper::getTotalAdvertisements()}}</span></p>
                        <h3>{{ __('registered users') }}</h3>
                        <p><span class="number">{{Helper::getTotalRegisteredUsers()}}</span></p>
                        <h3>{{ __('would you like to advertise?') }}</h3>
                        <p><a class="big-button login wpml-btn login-window" href="{{ route('login') }}">{{ __('Sign In or Register') }}</a></p>

                    </div>

                </div>
            </div>


            <div class="clearboth"></div>


            <div id="copyright-holder">
                <span class="footer-border"></span>

                <p>© 2021 OldandYoungtimer</p>

                <div id="footer-social">
                    <ul class="social-nav-list"><li class="social-icon"><a class="tip-me" href="https://www.facebook.com/oldandyoungtimer.classics" data-toggle="tooltip" data-animation="true" title=""><span class="icon-facebook"></span></a></li></ul>          </div>
            </div>
        </div>



        <div class="clearboth"></div>

    </div>

</footer>
