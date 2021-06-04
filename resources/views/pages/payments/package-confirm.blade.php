@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/packages.css')}}">

@endsection

@section('scripts')
    <script src="{{asset('js/pages/packages.js')}}"></script>
    <script src="//www.paypalobjects.com/api/checkout.js" async></script>
    <style type="text/css">
        .paypal-button-tag-content{visibility: hidden;}
        .stripe-button-el { height: 27px; display: block;
}
        .stripe-button-el span {
          background: #28a0e5 !important;
          background-image:none !important;
          margin-top: -2px;
text-align: center;
font-size: 12px !important;
        }
    </style>
    <script>

        $(function(){
            paypal.checkout.setup('WLALSA9QP8DBQ', {
                environment: 'live',
                container: 'depositPack-1',
                buttons: [
                    {
                        container: 'depositPack-1',
                        type: 'checkout',
                        color: 'gold',
                        height: 'large',
                        size: 'large',
                        shape: 'rect'
                    }
                ]
            });
        })

    </script>

@endsection

@section('content')

    <div class="container card bg-darker text-white" style="margin-top:20px;margin-bottom:20px;padding:20px;">
        <h3>{{ __('Confirm your package') }}</h3>
        <hr>
        <h5>{{ __('You are about to order the following package:') }}</h5>
        <ul>
            <li>{{$pack['name']}}</li>
            <li>€{{$pack['value']}}</li>
            <li>{{ __('Adverts: :adverts', ['adverts' => $pack['adverts']]) }}</li>
            <li>{{ __('Period: :period months', ['period' => $pack['period']]) }}</li>
        </ul>
        <hr>

        <div class="pull-right" style="width: 335px;display: inherit;">

        <!-- Stripe Form Post -->
        <form action="{{route('payment.stripeDeposit')}}" method="POST">
          <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="pk_live_GkCnhmbLnGBavkh7WQBE6IGR00hvQdHFIM"
            data-amount="{{$pack['value']*100}}"
            @if(Auth::check())
            data-email="{{Auth::user()->email}}"
            @endif
            data-name="OldandYoungtimer"
            data-description="{{$pack['name']}} deposit pack"
            data-image="http://classics.nl/img/classics-specialists-logo-001.png"
            data-locale="auto"
            data-currency="gbp"
            data-label="Credit-Debit card"
            >
          </script>
          <input type="hidden" name="depositPack" value="{{$packID}}#{{$pack['value']}}#{{$pack['name']}}#{{Auth::user()->userID}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

        <!-- Paypal Form Post -->
        <form id="depositPack-1" method="post" action="https://www.paypal.com/cgi-bin/webscr">
            <input type="hidden" name="depositPack" value="1">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="paypal@oldandyoungtimer.com">
            <input type="hidden" name="item_name" value="{{$pack['name']}} deposit pack">
            <input type="hidden" name="item_number" value="1">
            <input type="hidden" name="amount" value="{{$pack['value']*100}}">
            <input type="hidden" name="return" value="{{route('payment.stripeDeposit')}}">
            <input type="hidden" name="no_shipping" value="0">
            <input type="hidden" name="no_note" value="1">
            <input type="hidden" name="currency_code" value="GBP">
        </form>
        </div>
    </div>
@stop

