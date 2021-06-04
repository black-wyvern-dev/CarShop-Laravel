@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/countrySelector.css')}}">
@endsection
@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?sitekey={{ urlencode(config('recaptcha.sitekey')) }}" async defer></script>
    <script src="{{asset('/js/countrySelect.min.js')}}"></script>
    <script src="{{asset('js/login-register.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-darker text-white">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item custom-tabs">
                            <a class="nav-link success active" id="pills-company-tab" data-toggle="pill" href="#company" role="tab" aria-controls="pills-company" aria-selected="false">{{ __('Company') }}</a>
                        </li>
                        <li class="nav-item custom-tabs">
                            <a class="nav-link success" id="pills-home-tab" data-toggle="pill" href="#private" role="tab" aria-controls="pills-private" aria-selected="true">{{ __('Private') }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade" id="private" role="tabpanel" aria-labelledby="pills-private-tab">
                            <form id="registerPrivateForm" role="form" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mfv-errorBox"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="firstName" class="col-form-label text-md-right">{{ __('First name') }}</label>
                                            <input id="firstName" type="text" mfv-placeholder="{{ __('First name') }}" class="form-control{{ $errors->has('firstName') ? ' is-invalid' : '' }}" name="firstName" value="{{ old('firstName') }}" mfv-checks="required:true;max:50;min:3">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="col-form-label text-md-right">{{ __('Last name') }}</label>
                                            <input id="lastName" type="text" mfv-placeholder="{{ __('Last name') }}" class="form-control{{ $errors->has('lastName') ? ' is-invalid' : '' }}" name="lastName" value="{{ old('lastName') }}" mfv-checks="required:true;max:50;min:3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="postCode" class="col-form-label text-md-right">{{ __('Postcode') }}</label>
                                            <input id="postCode" type="text" mfv-placeholder="{{ __('Postcode') }}" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postCode" value="{{ old('postcode') }}"  mfv-checks="max:50;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                            <input id="country_private_selector" type="text" mfv-placeholder="{{ __('Country') }}" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ old('country') }}" mfv-checks="required:true;">
                                            <label for="country_private_selector" style="display:none;">{{ __('Select a country here...') }}</label>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="phoneNumber" class="col-form-label text-md-right">{{ __('Phone number') }}</label>
                                            <input id="phoneNumber" type="text" mfv-placeholder="{{ __('Phone number') }}" class="form-control{{ $errors->has('phoneNumber') ? ' is-invalid' : '' }}" name="phoneNumber" value="{{ old('phoneNumber') }}" mfv-checks="max:50;min:3">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="col-form-label text-md-right">{{ __('Email Address') }}</label>
                                            <input id="email" type="text" mfv-placeholder="{{ __('Mail address') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" mfv-checks="required:true;email:true">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="currency" class="col-form-label text-md-right">{{ __('Currency') }}</label>
                                            <select class="custom-select" name="currency" id="currency">
                                                <option selected value="€">€</option>
                                                <option value="$">$</option>
                                                <option value="£">£</option>
                                                <option value="SEK">{{ __('SEK') }}</option>
                                                <option value="₽">₽</option>
                                                <option value="NZ$">{{ __('NZ$') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                            <input id="passwordPrivate" type="password" mfv-placeholder="{{ __('Password') }}" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" mfv-checks="required:true;max:50;min:6">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" mfv-placeholder="{{ __('Confirm Password') }}" class="form-control" name="password_confirmation" mfv-checks="required:true;match:passwordPrivate">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="acceptPrivateTerms">
                                        <label class="form-check-label" for="exampleCheck1">{{ __('I have read the') }} <a href="#">{{ __('terms and privacy') }}</a> {{ __('statement and accept them') }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <div class="g-recaptcha{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}"
                                                 data-sitekey="{{ config('recaptcha.sitekey') }}">
                                            </div>
                                            <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="row h-100 pull-right">
                                        <button type="submit" class="btn btn-success" mfv-action="register.doPrivateRegister();">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade show active" id="company" role="tabpanel" aria-labelledby="pills-company-tab">
                            <form id="registerCompanyForm" role="form" autocomplete="off">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mfv-errorBox"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="fname" class="col-form-label text-md-right">{{ __('First name') }}</label>
                                            <input id="fname" type="text" class="form-control" name="firstName" mfv-placeholder="{{ __('First name') }}" mfv-checks="required:true;max:50;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lname" class="col-form-label text-md-right">{{ __('Last name') }}</label>
                                            <input id="lname" type="text" class="form-control" name="lastName" mfv-placeholder="{{ __('Last name') }}" mfv-checks="required:true;max:50;" >
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="bname" class="col-form-label text-md-right">{{ __('Business name') }}</label>
                                            <input id="bname" type="text" class="form-control" name="businessName" mfv-placeholder="{{ __('Business name') }}" mfv-checks="max:50;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="col-form-label text-md-right">{{ __('Phone number') }}</label>
                                            <input id="phone" type="text" class="form-control" name="phoneNumber" mfv-placeholder="{{ __('Phone number') }}" mfv-checks="max:50;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="mobileNumber" class="col-form-label text-md-right">{{ __('Mobile number') }}</label>
                                            <input id="mobileNumber" type="text" class="form-control" name="mobileNumber" mfv-placeholder="{{ __('Mobile number') }}" mfv-checks="max:50;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="col-form-label text-md-right">{{ __('Email Address') }}</label>
                                            <input id="email" type="text" class="form-control" name="email" mfv-placeholder="{{ __('Email address') }}" mfv-checks="required:true;email:true">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                            <input id="country_company_selector" type="text" class="form-control" name="country" mfv-placeholder="{{ __('Country') }}" mfv-checks="required:true;">
                                            <label for="country_company_selector" style="display:none;">{{ __('Select a country here...') }}</label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="town" class="col-form-label text-md-right">{{ __('Town') }}</label>
                                            <input id="town" type="text" class="form-control" name="town"  mfv-placeholder="{{ __('Town') }}" mfv-checks="max:50;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="street" class="col-form-label text-md-right">{{ __('Street') }}</label>
                                            <input id="street" type="text" class="form-control" name="street" mfv-placeholder="{{ __('Street') }}" mfv-checks="max:50;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="postCode" class="col-form-label text-md-right">{{ __('Postcode') }}</label>
                                            <input id="postCode" type="text" class="form-control" name="postCode" mfv-placeholder="{{ __('Postcode') }}" mfv-checks="max:50;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="street2" class="col-form-label text-md-right">{{ __('Street 2') }}</label>
                                            <input id="street2" type="text" class="form-control" name="street2" mfv-placeholder="{{ __('Street 2') }}" mfv-checks="max:50;">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="website" class="col-form-label text-md-right">{{ __('Website') }}</label>
                                            <input id="website" type="text" class="form-control" name="website" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" mfv-placeholder="{{ __('Website') }}" mfv-checks="required:true;">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="col-form-label text-md-right">{{ __('Currency') }}</label>
                                            <select class="custom-select" name="currency">
                                                <option selected value="€">€</option>
                                                <option value="$">$</option>
                                                <option value="£">£</option>
                                                <option value="SEK">{{ __('SEK') }}</option>
                                                <option value="₽">₽</option>
                                                <option value="NZ$">{{ __('NZ$') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                            <input id="passwordCompany" type="password" class="form-control" name="password" mfv-placeholder="{{ __('Password') }}"  mfv-checks="required:true;max:50;min:6" >
                                        </div>
                                        <div class="col-md-6">
                                            <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" mfv-placeholder="{{ __('Confirm Password') }}" mfv-checks="required:true;match:passwordCompany">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="acceptCompanyTerms">
                                        <label class="form-check-label" for="exampleCheck1">{{ __('I have read the') }} <a href="{{ route('pages', ['name' => 'terms-and-conditions']) }}" target="_blank">{{ __('terms and privacy') }}</a> {{ __('statement and accept them') }}</label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <div class="g-recaptcha{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}"
                                                 data-sitekey="{{ config('recaptcha.sitekey') }}">
                                            </div>
                                            <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="row h-100 pull-right">
                                        <button type="submit" class="btn btn-success" mfv-action="register.doCompanyRegister();">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
