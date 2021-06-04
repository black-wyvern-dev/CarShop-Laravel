@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/home.css')}}">
    <style>
        .envelopeIcon{
            font-size: 182px;
            color: #0b090921;
            position: absolute;
            left: 32%;
        }
        .emailContent{
            height: 129px;
            text-align: center;
            margin-top: 70px;
        }
        .reSendBttn{
            margin-left: auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{asset('js/pages/help.js')}}"></script>
@endsection
@section('content')


    <div class="container card bg-darker col-md-3 text-white" style="margin-top:20px;margin-bottom:20px;padding:20px;">
        <div class="row">
            <div class="col-md-12 center">
                <h3 style="text-align: center">{{ __('Please confirm your email') }}</h3>
                <i class="fa fa-envelope-open envelopeIcon"></i>
                <div class="emailContent">
                    An email has been sent to <b>{{Auth::user()->email}}</b>. <br>{{ __('Please follow the link') }}<br>
                    in this email message to verify your account and complete registration.
                </div>
                <center>
                    <button onclick="help.sendConfirmationEmail()" style="" class="btn reSendBttn btn-success">{{ __('Re-send email verification') }}</button>
                </center>
            </div>
        </div>

    </div>


@stop

