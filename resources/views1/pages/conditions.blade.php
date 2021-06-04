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
                            <span property="name">{{ __('conditions') }}</span>
                            <meta property="position" content="2">
                        </span>
                    </div>

                </div>


                <div id="header-left-content">

                    <h1>{{ __('conditions') }}</h1>

                </div>



                <div class="clear"></div>

            </div>

        </section>
    </div>
    <div id="page-wrapper" class="wrapper">
        <div class="row">
            <div class="col-lg-8 card bg-darker text-white" style="margin-top: 20px;margin-bottom: 20px;padding: 20px;margin-left: 35px;">
                <div class="the-content">
                    <p>{{ __('Conditions for advertising on our worldwide classic car platforms,') }}<br>
                        Oldandyoungtimer, Classics24, CCFB.</p>
                    <p>{{ __('You can obtain a list of our classic car websites by asking via our contactpage.') }}<br>
                        The conditions as displayed here are for all the websites mentioned above.</p>
                    <p>{{ __('Please read our conditions before you advertise on Oldandyoungtimer, Classics24, CCFB or other sistersites operated by our organisation.') }}<br>
                        As soon as you have registered yourself and advertised your car(s) or any other item, you have agreed to our conditions.<br>
                        Our conditions will be altered if or when the situation asks for alteration.</p>
                    <p>{{ __('You are kindly asked to follow the “house rules” of our organisation.') }}<br>
                        Any pornographic or discriminating advertisements will be taken off the website as soon as noticed, without noticing the advertising person in advance.</p>
                    <p>{{ __('Article 1. Texts and offered items and/or services') }}</p>
                    <p>{{ __('Oldandyoungtimer keeps continious control over the contents, both texts and offerde items and/or services. As the texts of the offered items are uploaded by the advertisers, sometimes the contents may not be accurate or correct. However, we at&nbsp;Oldandyoungtimer, Classics24, CCFB or other sistersites are not responsible for the contents of the advertisements.') }}</p>
                    <p>{{ __('Article 2. Your personal data') }}</p>
                    <p>{{ __('All the data neccessary for selling your item or delivering your service will be deleted from our database as soon as the item or service you provide is not longer available. This might be after the item has been sold or after your advertising period has ended with our platform.') }}<br>
                        We will never use your data for any other purpose than selling your item(s) or offering your service(s).<br>
                        When using our websites, all the information about the offered item or service should be up-to-date and correct.<br>
                        When using our websites, you should be qualified to do financial handlings according to advertising on our platform.</p>
                    <p>{{ __('Obviously, your data should be correct at the moment of placing the ads.') }}</p>
                    <p>{{ __('When asked by justice departments to help out and producing data, we will always ask our lawyer to advice us how to react. There must be enough reasonable doubt to help out at all.') }}</p>
                    <p>{{ __('As soon as you are “outside” our websites due to clicking on a banner or an advertised websitelink of one of our advertisers, you are no longer surfing under our “house rules”.') }}<br>
                        We will be no longer reponsible for the contents you may encounter.</p>
                    <p>{{ __('Article 3. Copyright') }}</p>
                    <p>{{ __('All images (still or moving), being a part of the lay-out of the website(s) and all images advertised are copyrighted.') }}<br>
                        For the use of images and or texts available on our websites, there is ALWAYS written permission needed by the author or artist.</p>
                    <p>{{ __('You can apply for a written permission via our contact page.') }}</p>
                    <p>{{ __('We from Oldandyoungtimer, Classics24, CCFB or other sistersites will always protect our copyright in court and we will always advise our advertisers to do the same, they make the choice theirselves.') }}</p>
                    <p>{{ __('Article 4. Spam / Misuse of personal data') }}</p>
                    <p>{{ __('It is not allowed to use our advertisers´ contact information for anything else than the original use, advertising on our websites. Collecting data of our advertisers will be taken serious and appropriate action will be taken.') }} </p>
                    <p>{{ __('Article 5. Liability: the purchased item / used service') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB are not responsible for the textual content of the advertisements and/or the service offered.') }}<br>
                        Oldandyoungtimer, Classics24, CCFB are not responsible for the general state of maintenance of the offered articles and/or the service offered.</p>
                    <p>{{ __('Article 6. Liability: the use of the sites') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB are not responsible for the reactions that arise on the advertisement(s) you have placed.') }}<br>
                        Oldandyoungtimer, Classics24, CCFB are therefore protected from any form of claims that may arise from the advertisement(s) or service placed by you or other advertisers, which may or may not have been developed in accordance with the agreement.</p>
                    <p>{{ __('Article 7. Liability.') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB applies Dutch law on its terms. Any legal disputes will be submitted by our lawyer to the judge in Amsterdam.') }}</p>
                    <p>{{ __('Article 8. Updating the sites.') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB will continually update its sites, to promote its ease of use through the growing technique and to increase the security against outside abusers.') }}</p>
                    <p>{{ __('Article 9. Advertisements.') }}</p>
                    <p>{{ __('The advertiser is solely responsible for the content of the advertisement text, and the overall state of maintenance of the offered article or service.') }}<br>
                        The advertiser gives as complete picture of the item(s) to be sold or the offered service.<br>
                        The description of the item and/or service should correspond to the actual state of maintenance of the advertised item.<br>
                        The advertiser places the advertisement text himself, and Oldandyoungtimer, Classics24, CCFB are therefore never liable for the content of the advertiser´s text.<br>
                        Oldandyoungtimer, Classics24, CCFB are at all times authorized to amend or remove texts/ advertisements, if we feel the need or very good reason to do so.</p>
                    <p>{{ __('Guidelines advertisements:') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB do not have to provide a reason for change or removal, but we give a few guidelines:') }}</p>
                    <p>1. advertisements with explicit pornographic and/or racist content, or which simply do not fit into the thinking of every right-minded person.</p>
                    <p>2. If there is a suspicion that illegal copies are offered in the advertisements (copyright-protected items, such as photographs, books, photography) or that stolen goods are offered.</p>
                    <p>{{ __('Article 10. Payment') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB charges private and business advertisers for placing advertising ads, the rates can be found here http://www.ccfb.biz/rates/') }}</p>
                    <p>{{ __('Advertising is free of charge in the categories Car Clubs and Events') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB can block ads when we have doubts, we will always consult the advertiser.') }}<br>
                        Payment is done through iDeal or Paypal in advance. You´ll receive a digital payment receipt.<br>
                        Companies receive an invoice with VAT.<br>
                        The advertisements are shown after receiving the payment.</p>
                    <p>{{ __('Article 11. Exclusion') }}</p>
                    <p>{{ __('Oldandyoungtimer, Classics24, CCFB have the possibility to remove or refuse your advertisement and exclude you from further use of our websites, if you can not agree with the aforementioned conditions.') }}</p>
                    <p>(last update 2017-11-23)</p>
                    </div>
            </div>
            <div id="sidebar" class="col-lg-3 sidebar-right last extendright">

            </div>
        </div>
    </div>
@stop

