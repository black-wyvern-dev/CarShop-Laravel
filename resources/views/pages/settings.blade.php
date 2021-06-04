@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/settings.css')}}">
    <link rel="stylesheet" href="{{asset('css/countrySelector.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/pages/settings.js')}}"></script>
    <script src="{{asset('/js/countrySelect.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
@endsection
@section('content')

    <div class="flex-center position-ref full-height container card paddedContainer bg-darker text-white">
        <div class="content">
            <h3>{{ __('User settings') }}</h3>
        </div>
        @if(Auth::user()->type == 2)
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item custom-tabs">
                <a class="nav-link  active" id="pills-home-tab" data-toggle="tab" data-tab-history="true" data-tab-history-changer="push" data-tab-history-update-url="true" href="#account"  aria-controls="account">{{ __('Account') }}</a>
            </li>
            <li class="nav-item custom-tabs">
                <a class="nav-link" id="pills-company-tab" data-toggle="tab" data-tab-history="true" data-tab-history-changer="push" data-tab-history-update-url="true" href="#profile" aria-controls="profile">{{ __('Profile') }}</a>
            </li>
        </ul>
        @endif
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane active" id="account" role="tabpanel" aria-labelledby="pills-account-tab">
                <form id="settingsForm" role="form" autocomplete="off">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="mfv-errorBox"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="firstName" class="col-form-label text-md-right">{{ __('First name') }}</label>
                            <input id="firstName" type="text" mfv-placeholder="{{ __('First name') }}" class="form-control" name="firstName" value="{{ Auth::user()->firstName}}" mfv-checks="required:true;max:50;min:3">

                        </div>
                        <div class="col-md-6">
                            <label for="lname" class="col-form-label text-md-right">{{ __('Last name') }}</label>
                            <input id="lname" type="text" mfv-placeholder="{{ __('Last name') }}" class="form-control" name="lastName" value="{{  Auth::user()->lastName }}" mfv-checks="required:true;max:50;min:3">
                        </div>
                        @if(Auth::user()->type == 2)
                            <div class="col-md-6">
                                <label for="bname" class="col-form-label text-md-right">{{ __('Business name') }}</label>
                                <input id="bname" type="text" class="form-control" name="businessName" mfv-placeholder="{{ __('Business name') }}" value="{{  Auth::user()->businessName }}" mfv-checks="max:50;">
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label for="phoneNumber" class="col-form-label text-md-right">{{ __('Phone number') }}</label>
                            <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" mfv-placeholder="{{ __('Phone number') }}" value="{{  Auth::user()->phoneNumber }}" mfv-checks="numeric:true;max:50;">
                        </div>
                        @if(Auth::user()->type == 2)
                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{ __('Mobile number') }}</label>
                                <input id="email" type="text" class="form-control" name="mobileNumber" mfv-placeholder="{{ __('Mobile number') }}" value="{{  Auth::user()->mobileNumber }}"  mfv-checks="numeric:true;max:50;">
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label for="email" class="col-form-label text-md-right">{{ __('Email address') }}</label>
                            <input id="email" type="text" class="form-control" name="email" mfv-placeholder="{{ __('Email address') }}" value="{{  Auth::user()->email }}" mfv-checks="required:true;email:true">
                        </div>
                        @if(Auth::user()->type == 2)
                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                <input type="text" id="country_company_selector" class="form-control" name="country" value="{{  Auth::user()->country }}" mfv-placeholder="{{ __('Country') }}" mfv-checks="required:true;max:50;">
                                <label for="country_company_selector" style="display:none;">{{ __('Select a country here...') }}</label>
                            </div>
                            <div class="col-md-3">
                                <label for="street" class="col-form-label text-md-right">{{ __('Street') }}</label>
                                <input id="street" type="text" class="form-control" name="street" mfv-placeholder="{{ __('Street') }}" value="{{  Auth::user()->street }}" mfv-checks="max:50;">
                            </div>
                            <div class="col-md-3">
                                <label for="street2" class="col-form-label text-md-right">{{ __('Street 2') }}</label>
                                <input id="street2" type="text" class="form-control" name="street2" mfv-placeholder="{{ __('Street 2') }}" value="{{  Auth::user()->street2 }}" mfv-checks="max:50;">
                            </div>
                            <div class="col-md-3">
                                <label for="town" class="col-form-label text-md-right">{{ __('Town') }}</label>
                                <input id="town" type="text" class="form-control" name="town" mfv-placeholder="{{ __('Town') }}" value="{{  Auth::user()->town }}" mfv-checks="max:50;">
                            </div>
                            <div class="col-md-6">
                                <label for="postCode" class="col-form-label text-md-right">{{ __('Postcode') }}</label>
                                <input id="postCode" type="text" class="form-control" name="postCode" value="{{  Auth::user()->postCode }}" mfv-placeholder="{{ __('Postcode') }}" mfv-checks="max:50;">
                            </div>
                            <div class="col-md-6">
                                <label for="vatNumber" class="col-form-label text-md-right">{{ __('VAT Number') }}</label>
                                <input id="vatNumber" type="text" class="form-control" name="vatNumber" value="{{  Auth::user()->vatNumber }}" mfv-placeholder="{{ __('VAT Number') }}" mfv-checks="numeric:true;max:50;">
                            </div>
                            <div class="col-md-6">
                                <label for="website" class="col-form-label text-md-right">{{ __('Website') }}</label>
                                <input id="website" type="text" class="form-control" name="website" value="{{  Auth::user()->website }}" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" mfv-placeholder="{{ __('Website') }}" mfv-checks="required:true;">
                            </div>
                        @else
                            <div class="col-md-6">
                                <label for="postCode" class="col-form-label text-md-right">{{ __('Postcode') }}</label>
                                <input id="postCode" type="text" class="form-control" name="postCode" value="{{  Auth::user()->postCode }}" mfv-placeholder="{{ __('Postcode') }}" mfv-checks="max:50;">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                <input id="country_private_selector" type="text" class="form-control" name="country" value="{{  Auth::user()->country }}" mfv-placeholder="{{ __('Country') }}" mfv-checks="required:true;max:50;">
                                <label for="country_private_selector" style="display:none;">{{ __('Select a country here...') }}</label>
                            </div>
                        @endif
                        <div class="col-md-6">
                            <label for="email" class="col-form-label text-md-right">{{ __('Currency') }}</label>
                            <select class="custom-select" name="currency">
                                @foreach(config('cc-app.currencyList') as $currency)
                                    <option @if($currency == Auth::user()->currency) selected @endif value="{{$currency}}">{{$currency}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        @if(Auth::user()->type == 2)
                        <div id="weSpeakForm" class="form-group row">
                                 <label for="specialism" class="col-md-2" style="margin:0px;">{{ __('We speak') }}</label>
                                 @foreach(config('cc-app.weSpeakList') as $k => $language)
                                         <div class="form-check col-md-3">
                                             <input @if(isset($weSpeak))@if(array_key_exists($language, $weSpeak)) checked @endif @endif class="form-check-input" type="checkbox" id="{{$language}}-checkBox" value="{{$language}}">
                                             <label class="form-check-label" for="{{$language}}-checkBox">{{$language}}</label>
                                         </div>
                                         @if(($k+1)%3==0)
                                             <div class="col-md-2"></div>
                                         @endif
                                 @endforeach
                        </div>
                        <div id="specialismForm" class="form-group row">
                                <label for="specialism" class="col-md-2" style="margin:0px;">{{ __('Specialism') }}</label>
                                @foreach(config('cc-app.specialistsList') as $k => $specialism)
                                        <div class="form-check col-md-3">
                                            <input @if(isset($specialists))@if(array_key_exists($specialism['value'], $specialists)) checked @endif @endif class="form-check-input" type="checkbox" id="{{$specialism['value']}}-checkBox" value="{{$specialism['value']}}">
                                            <label class="form-check-label" for="{{$specialism['value']}}-checkBox">{{$specialism['name']}}</label>
                                        </div>
                                       @if(($k+1)%3==0)
                                           <div class="col-md-2"></div>
                                       @endif
                                @endforeach
                        </div>
                    @endif
                    <div class="form-group row">
                        <div class="row h-100 pull-right">
                            <button type="submit" class="btn btn-danger" mfv-action="settings.saveSettings();">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @if(Auth::user()->type == 2)
            <div class="tab-pane" id="profile" role="tabpanel">
                <div class="form-group row">
                    <div class="col-md-5 row form-group">
                        <div class="col-md-3" id="logo_labels" style="padding-right: 0px">
                            <label for="exampleFormControlFile1">{{ __('Logo') }}</label>
                            <img class="logo-settings" src="{{asset('uploads/users/logos/'.Auth::user()->logo)}}">
                            <div class="redLoader">
                                <img src="{{asset('img/loading.gif')}}"/>
                            </div>
                        </div>
                        <div class="file-holder col-md-8" id="logo_holder">
                            <form role="form" autocomplete="off" id="logoUpForm" enctype="multipart/form-data">
                                <input type="file" id="file_logo" class="filestyle" name="logo">
                            </form>
                            <div class="margin-bt-5"></div>
                            <small><span class="redBoy">&bull; </span>250x250(max) <span class="redBoy">&bull; </span>1mb <span class="redBoy">&bull; </span>{{ __('JPG,JPEG,PNG') }}</small>
                        </div>
                    </div>
                    <div id="logoUpFormError" class="col-md-6">
                        <div class="mfv-errorBox"></div>
                    </div>
                    <div class="col-md-5 row form-group">
                        <label class="col-md-12" for="photosUpForm">{{ __('Business photos (5)') }}</label>
                        <div class="col-md-12" style="padding-right: 0px;">
                            <form role="form" autocomplete="off" id="photosUpForm" enctype="multipart/form-data">
                                <input type="file" multiple="multiple" class="form-control-file filestyle" name="photos" id="file_business">
                            </form>
                        </div>
                        <small class="col-md-12"><span class="redBoy">&bull; </span>250x250(max) <span class="redBoy">&bull; </span>1mb <span class="redBoy">&bull; </span>{{ __('JPG,JPEG,PNG') }}</small>
                    </div>
                    <div class="col-md-6" id="multiUploadFormError">
                        <div class="mfv-errorBox"></div>
                    </div>
                </div>
                <div id="gallery" class="gallery row">
                    @if($gallery)
                        @foreach($gallery as $k => $photo)
                            <div @if($loop->last && $k==4) id="lastPhoto" class="col-md-2 photoGallery-{{$photo['userGalleryID']}}" @else class="col-md-2 photoGallery-{{$photo['userGalleryID']}}" @endif>
                                <img class="photo-gallery" src="{{asset('uploads/users/photos/'.$photo['name'])}}">
                                <button class="photo-close" data-toggle="tooltip" title="Delete" onclick="settings.deletePhoto({{$photo['userGalleryID']}})"></button>
                            </div>
                        @endforeach
                    @endif
                    <div class="redMultiLoader col-md-2">
                        <img src="{{asset('img/loading.gif')}}"/>
                    </div>
                </div>
                <form id="descriptionForm" role="form" autocomplete="off">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="mfv-errorBox"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 form-group">
                            <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                            <textarea class="form-control" name="description" rows="3">{!! Auth::user()->description !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="facebook" class="col-form-label text-md-right"><img class="socialIcon" src="{{asset('img/social/facebook.png')}}">{{ __('Facebook') }}</label>
                            <input id="facebook" type="text" class="form-control" name="facebook" value="{{  Auth::user()->facebook }}" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$">
                        </div>
                        <div class="col-md-4">
                            <label for="twitter" class="col-form-label text-md-right"><img class="socialIcon" src="{{asset('img/social/twitter.png')}}">{{ __('Twitter') }}</label>
                            <input id="twitter" type="text" class="form-control" name="twitter" value="{{  Auth::user()->twitter }}">
                        </div>
                        <div class="col-md-4">
                            <label for="instagram" class="col-form-label text-md-right"><img class="socialIcon" src="{{asset('img/social/instagram.png')}}">{{ __('Instagram') }}</label>
                            <input id="instagram" type="text" class="form-control" name="instagram" value="{{  Auth::user()->instagram }}" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="row h-100 pull-right">
                            <button type="submit" class="btn btn-danger" mfv-action="settings.saveDescription();">
                                {{ __('Save') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>


    </div>


@stop

