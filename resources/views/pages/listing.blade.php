@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/lightslider.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/stm-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/specialists.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/listing.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
</head>
    <style type="text/css">
        .morecontent span {
            display: none;
        }
        .morelink {
            display: block;
            color:
            #fff;
            background-color:
            #28a745;
            border-color:
            #28a745;

            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid
            transparent;
                border-top-color: transparent;
                border-right-color: transparent;
                border-bottom-color: transparent;
                border-left-color: transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        }
        .video-container {
            overflow: hidden;
            position: relative;
            width:100%;
        }

        .video-container::after {
            padding-top: 56.25%;
            display: block;
            content: '';
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        #email_formModal {
            padding : 15px !important;
            color : white;
            background-image : url("{{asset('img/formBg.jpg')}}");
        }

        .form_header {
            border-bottom : 1px solid lightgray
        }

        #email-Send-Form{
            background-image : url("{{asset('img/formBg-inside.jpg')}}");
        }
        .swal2-title {
            color: white !important;
        }
        .swal2-popup .swal2-content{
            color : white !important;
        }
    </style>
@endsection

@section('scripts')
        <script src="https://www.google.com/recaptcha/api.js?&sitekey=6LdOhs0UAAAAANHhBAzJsA94RurCqvngVIll6Pi_" async defer></script>
        <script src="{{asset('js/lightslider.min.js')}}"></script>
        <script src="{{asset('js/pages/listing.js')}}"></script>
        <script src="{{asset('js/pages/specialists.js')}}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // Configure/customize these variables.
                var showChar = 850;  // How many characters are shown by default
                var ellipsestext = "...";
                var moretext = "read more >>>";
                var lesstext = "<<< read less";


                $('.more').each(function() {
                    var content = $(this).html();

                    if(content.length > showChar) {

                        var c = content.substr(0, showChar);
                        var h = content.substr(showChar, content.length - showChar);

                        var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                        $(this).html(html);
                    }
                });

                $(".morelink").click(function(){
                    if($(this).hasClass("less")) {
                        $(this).removeClass("less");
                        $(this).html(moretext);
                    } else {
                        $(this).addClass("less");
                        $(this).html(lesstext);
                    }
                    $(this).parent().prev().toggle();
                    $(this).prev().toggle();
                    return false;
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                mfValid.init('#email-Send-Form');
                $('#email-Send-Form').submit(function(){
                    $.ajax({
                        url:'{{route('send-email-to-seller')}}',
                        type:'POST',
                        dataType: "json",
                        data: $("#email-Send-Form").serialize(),
                        success:function(data){
                            if(data.status == 1){
                                swal({
                                    title : "Email Sent!",
                                    html: 'Thank you for contacting this seller.<br><br> With classical regards,<br><br> The OldandYoungtimer / Classics24 team	',
                                    width: 500,
                                    padding: 50,
                                    background: '#fff url("{{asset('img/formBg-inside.jpg')}}")',
                                })
                                $("#sendMail-form .close").click();
                            }
                            else if(data.status == 0) {
                                swal({
                                    title : "Something wrong!",
                                    text : data.errors,
                                    width: 500,
                                    background: '#fff url("{{asset('img/formBg-inside.jpg')}}")',
                                    padding: 50,
                                })
                            }
                        },
                        error: function (data) {
                            swal({
                                title : "Something wrong!",
                                text : data.errors,
                                width: 500,
                                padding: 50,
                                background: '#fff url("{{asset('img/formBg-inside.jpg')}}")',
                            })
                            $('#sendMail-form').modal('toggle');
                        }
                    });
                })

                var telInput = $("#phone"),
                errorMsg = $("#error-msg"),
                validMsg = $("#valid-msg");

                // initialise plugin
                telInput.intlTelInput({
                    allowExtensions: true,
                    formatOnDisplay: true,
                    autoFormat: true,
                    autoHideDialCode: true,
                    autoPlaceholder: true,
                    defaultCountry: "auto",
                    ipinfoToken: "yolo",

                    nationalMode: false,
                    numberType: "MOBILE",
                    //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
                    preferredCountries: ['sa', 'ae', 'qa','om','bh','kw','ma'],
                    preventInvalidNumbers: true,
                    separateDialCode: true,
                    initialCountry: "auto",
                    geoIpLookup: function(callback) {
                    $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                    });
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
                });

                var reset = function() {
                    telInput.removeClass("error");
                    errorMsg.addClass("hide");
                    validMsg.addClass("hide");
                };

                // on blur: validate
                telInput.blur(function() {
                    reset();
                    if ($.trim(telInput.val())) {
                        if (telInput.intlTelInput("isValidNumber")) {
                            validMsg.removeClass("hide");
                        } else {
                            telInput.addClass("error");
                            errorMsg.removeClass("hide");
                        }
                    }
                });

                // on keyup / change flag: reset
                telInput.on("keyup change", reset);
                $('.intl-tel-input').css('width','100%')
            });
        </script>
@endsection
@section('content')
    <div id="page-wrapper" class="wrapper" style=" border:0px solid red;">
        <div class="row" style="padding-top: 20px;background-color: #1f1f1f;">
            <div  class="col-lg-9 text-white"  style="border: 0px solid green;">

                <div class="row">
                    <div class="list_car_name" style="margin-left:10px;"><h2>{{Helper::formatItemName($listing['year'])}} {{str_replace(" ","-",ucwords(Helper::formatItemName($listing['make'],' ')))}} {{str_replace(" ","-",ucwords(Helper::formatItemName($listing['model'])))}} {{Helper::formatItemName($listing['modelType'])}}</h2></div>
                    @if($listing['price'])
                    <div class="pull-right"><h2><span class="badge badge-pill badge-success">{{$listing['user']['currency']}} {{$listing['price']}}</span></h2></div>
                    @endif
                </div>
                <ul id="image-gallery" class="gallery list-unstyled">
                    @if($listing['listingPhotos'])
                        @foreach($listing['listingPhotos'] as $photo)
                        <li data-thumb="{{asset('uploads/listings/photos/'.$photo['name'])}}">
                            <img class="listingPreview" src="{{asset('uploads/listings/photos/'.$photo['name'])}}" class="rounded mx-auto d-block screen" />
                        </li>
                        @endforeach
                    @endif
                </ul>

                <div class="row" style="margin-top:30px;">

                    <div class="col-lg-12">
                        <div class="stm-single-car-listing-data">
                            <div class="row stm-table-main">
                                @php
                                    $dataAttributes = [
                                        ['label' => __('Body'),           'value' =>   $listing['bodyType'],                              'icon' => '<img class="car-icon" src="' . asset('img/car-icon.svg') . '">'],
                                        ['label' => __('Odometer'),       'value' => "{$listing['odometer']} {$listing['odometerType']}", 'icon' => 'fas fa-road'],
                                        ['label' => __('Fuel type'),      'value' =>   $listing['fuelType'],                              'icon' => 'fas fa-gas-pump'],
                                        ['label' => __('Engine'),         'value' =>   $listing['engine'],                                'icon' => 'stm-icon-engine_fill'],
                                        ['label' => __('Transmission'),   'value' =>   $listing['transmission'],                          'icon' => '<img class="transmission-icon" src="' . asset('img/transmission.png') . '"">'],
                                        ['label' => __('Exterior Color'), 'value' => $listing['exteriorColor'],                         'icon' => '<img class="exterior-color-icon" src="' . asset('img/exterior-color.png') . '">'],
                                        ['label' => __('Interior Color'), 'value' => $listing['interiorColor'],                         'icon' => 'fas fa-palette'],
                                        ['label' => __('Upholstery'),     'value' => $listing['upholstery'], 'icon' => '<img class="car-seat-icon" src="' . asset('img/car-seat.png') . '">'],
                                        ['label' => __('Steering'),       'value' => $listing['steering'], 'icon' => '<img class="steering-icon" src="' . asset('img/steering-icon.png') . '">'],
                                        ['label' => __('VIN'),            'value' => $listing['vin'], 'icon' => '<img class="car-seat-icon" src="' . asset('img/car-seat.png') . '">'],
                                    ];
                                @endphp
                                @foreach ($dataAttributes as $da)
                                    @if('' != $da['value'])
                                <div class="col-sm-6 col-md-4">
                                    <table class="inner-table">
                                        <tbody>
                                        <tr>
                                            <td class="icon">
                                                @if('<' === substr($da['icon'], 0, 1))
                                                {!! $da['icon'] !!}
                                                @else
                                                    <i class="{{ $da['icon'] }}"></i>
                                                @endif
                                            </td>
                                            <td class="label-td" title="{{ $da['label'] }}">
                                                {{ $da['label'] }}
                                            </td>
                                            <td class="heading-font" title="{{ $da['value'] }}">
                                                {{ $da['value'] }}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row" style="margin-top:10px; padding: 10px">
                    <div class="col-12">
                        {{-- @JDS removed as in https://trello.com/c/dtPM0aO7/9-003-mobiel-zijwaarts-swipen
                        <h6>{{ __('Description') }}</h6>
                        --}}
                        <span class="more">
                            {!! nl2br($listing['description'])  !!}
                        </span>
                    </div>
                </div>
                @if($listing['video'])
                @php($video_id = substr($listing['video'], strrpos($listing['video'], '/') + 1))
                  <div class="row" style="margin-top:10px; padding: 10px">
                    <div class="col-12">
                        <h6>{{ __('video') }}</h6>
                        <div  class="video-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video_id }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    </div>
                </div>
                @endif
            </div>
            <div id="sidebar" class="col-lg-3 sidebar-right last extendright" style="border: 0px solid yellow;">
                {{-- @TODO move to template --}}
                <a href="{{ route('specialist', ['userId' => $listing['userID'], 'name' => trim(preg_replace(["/[\"']+/", '/[^\pL\pN]+/'], ['', '-'], $listing['user']['businessName']), '-')]) }}">
                    <img @if($listing['user']['logo']) src="{{asset('uploads/users/logos/'.$listing['user']['logo'])}}" @else src="{{asset('uploads/user/logos/no-logo.png')}}" @endif class="img-responsive"></a>
                <hr>
                <div class="dealer-contacts">
                    <div class="dealer-contact-unit phone">
                        <i class="stm-service-icon-phone_2"></i>
                        <div class="phone heading-font" style="font-size : 17px">{!! substr($listing['user']['businessName'], 0, 25) !!}</div>
                    </div><hr>
                    <div class="dealer-contact-unit address" style="font-size : 17px">
                        <i class="stm-service-icon-pin_2"></i>
                        @php($specialist = $listing['user'])
                        @include('elements.specialist-list-address', ['no_pin' => true])
                    </div> <hr>
                        <div style = "color : orange">
                            <i class= "fas fa-phone"></i> &nbsp;
                            @include('elements.specialist-phonenumbers')
                        </div>
                    <hr>

                    <div class="dealer-contact-unit mail">
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#sendMail-form">
                            {{ __('Email seller') }}
                        </button>
                        <!-- <a href="mailto:{{$listing['user']['email']}}" data-toggle="modal" data-target="#sendMail-form">{{ __('Email seller') }}</a> -->
                    </div>
                </div>
                <br />
                <!-- <img src="https://i.imgur.com/v6iONEJ.jpg" style="width: 100%" />
                <img src="https://i.imgur.com/d2tWyHm.jpg" style="width: 100%" /> -->
            </div>
            {{-- @JDS hidden as in https://trello.com/c/RMrv6uBz/18-007-transport-banner
            <div class="row" style="margin:30px;">
                <div class="col-12">
                    <a href="https://www.dutchcarconnection.com/" target="_blank"><img src="https://i.imgur.com/v6iONEJ.jpg" /></a>
                    <a href="https://www.dutchcarconnection.com/" target="_blank"><img src="https://i.imgur.com/d2tWyHm.jpg" /></a>
                    <!--  <img src="https://i.imgur.com/v6iONEJ.jpg" />-->
                </div>
            </div>
            --}}
        </div>
    </div>

    
    <div class="modal fade" id="sendMail-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style = "color : black">
        <div class="modal-dialog modal-dialog-centered"role="document">
            <div class="modal-content"  id ="email_formModal" >
                <div class="modal-header form_header">
                    <h5 class="modal-title">
                        <i class="fas fa-phone" style="color:white"></i>&nbsp;
                        Call
                        <a href="tel:'+data.phoneNumber+'" style="color:orange">{{$listing['user']['phoneNumber']}}</a>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity:1">
                        <span aria-hidden="true" style="color:white; font-size : 30px">&times;</span>
                    </button>
                </div>
                <div class="modal-header form_header">
                    <h5 class="modal-title">
                        {{Helper::formatItemName($listing['year'])}} {{str_replace(" ","-",ucwords(Helper::formatItemName($listing['make'],' ')))}} {{str_replace(" ","-",ucwords(Helper::formatItemName($listing['model'])))}} {{Helper::formatItemName($listing['modelType'])}} 
                        @if($listing['price'])
                            {{$listing['user']['currency']}} {{$listing['price']}}
                        @endif
                    </h5>
                </div>
                <div class="modal-body">
                    <form id="email-Send-Form" style="color:white;" validate>
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input required type="name" name = "name" class="form-control" id="name" aria-describedby="NameHelp" placeholder="Enter name">
                            </div>
                            <input hidden name="userid" value = "{{$listing->user->userID}}">
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input required type="email" name = "email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone number *</label><br>
                                <input id="phone" type="tel" required type="phoneNumber" name="phoneNumber" class="form-control"  aria-describedby="phoneNumberHelp" style="width:100%">
                            </div>

                            <div class="form-group">
                                <label for="Message">Your messsage *</label>
                                <textarea required type="Message" class="form-control" name = "message" id="Message" aria-describedby="MessageHelp" placeholder="Enter message" style="height : 100px; text-align:left">
                                
                                
                                
                                {{url()->current()}} </textarea>
                            </div>

                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" name="checkBox" class="form-check-input" id="acceptPrivateTerms">
                                    <label class="form-check-label" for="exampleCheck1">Remember my details</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <p>
                                    For security reasons, do not select <strong style="font-weight : bold">"Remember my details"</strong> if you are using a shared computer.
                                </p>
                                <p>Please see our
                                <a href="/page/terms-and-conditions">{{ __('terms and privacy') }}</a>find out more.</p>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-group">
                                        <div class="g-recaptcha{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}"
                                                data-sitekey="{{ config('recaptcha.sitekey') }}">
                                        </div>
                                        <small class="text-danger" id="recapture">{{ $errors->first('g-recaptcha-response') }}</small>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

