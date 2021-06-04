@extends('layouts.admin')

@section('styles')
@endsection

@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?sitekey={{ urlencode(config('recaptcha.sitekey')) }}" async defer></script>
@endsection

@section('content')

    <div class="container admin">
        <div class="login row justify-content-center align-content-center" style="margin-top:20%">
            <div class="col-md-5 justify-content-center">

                <a href="{{ route('home') }}">
                    <img style="width:300px;margin:0 auto;display:table;margin-bottom:30px" src="{{asset('/img/classics-specialists-logo-001.png')}}"></a>

                <form id="loginForm" action="" class="form-horizontal" method="POST">
                    @csrf
                    @if(isset($loginErrors))
                        <div class="mfv-errorBox alert alert-danger">
                            <p>{{ __('Oups, you got some errors. Please  take care of them and try again.') }}</p>
                            <ul>
                            @foreach ($loginErrors as $field => $loginError)
                                <li>
                                    @if($field && is_array($loginError) && 1 < count($loginError))
                                        {{ $field }}:
                                        <ul>
                                            @foreach($loginError as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @elseif (is_array($loginError))
                                        {{ reset($loginError) }}
                                    @else
                                        {{ $loginError }}
                                    @endif
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" name="user" placeholder="{{ __('Username') }}" mfv-checks="required:true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="password" placeholder="{{ __('Password') }}" name="pass" class="form-control" mfv-checks="required:true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <div class="g-recaptcha{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}"
                                 data-sitekey="{{ config('recaptcha.sitekey') }}">
                            </div>
                            <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <button type="submit" href="#" class="btn btn-danger btn-login" style="width: 100%" mfv-action="document.getElementById('loginForm').submit();"><i class="glyphicon glyphicon-log-in"></i> {{ __('Login') }}</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-md-12">
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

