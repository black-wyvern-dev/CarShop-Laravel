@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/stm-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/pages/specialists.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/pages/specialists.js')}}"></script>
@endsection

@section('content')

     <div class="homeHeader specialists">


    <div class="container card bg-darker text-white" style="margin-top:20px;margin-bottom:20px;padding:20px;">
        <h4>{{ __('Specialists') }}</h4>

        @php($specialists->onEachSide(1))
        {{ $specialists->links('elements.pager') }}

        <div class="dealer-search-results">
        @foreach($specialists as $specialist)
            <div class="row stm-single-dealer animated fadeIn">
                <div class="col-xs-12 col-sm-4 col-md-2 image">
{{-- @TODO move to template --}}
                    <a href="{{ route('specialist', ['userId' => $specialist['userID'], 'name' => trim(preg_replace(["/[\"']+/", '/[^\pL\pN]+/'], ['', '-'], $specialist['businessName']), '-')]) }}">
                        <img @if($specialist['logo']) src="{{asset('uploads/users/logos/'.$specialist['logo'])}}" @else src="{{asset('uploads/user/logos/no-logo.png')}}" @endif class="img-responsive">
                    </a>
                </div>

                <div class="col-xs-12 col-sm-4 col-md-2 dealer-info">
                    <div class="title">
{{-- @TODO move to template --}}
                        <a class="h5" href="{{ route('specialist', ['userId' => $specialist['userID'], 'name' => trim(preg_replace(["/[\"']+/", '/[^\pL\pN]+/'], ['', '-'], $specialist['businessName']), '-')]) }}">{{ $specialist['businessName'] }}</a>
                    </div>
                    <div class="rating">
                        <div class="dealer-rating">
                            <div class="stm-rate-unit">
                                <div class="stm-rate-inner">
                                    <div class="stm-rate-not-filled"></div>
                                    <div class="stm-rate-filled" style="width:0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-2 col-sm-4 col-md-2 dealer-cars">
                    <div class="inner">
                        <div class="dealer-labels heading-font">
                            {{count($specialist['listings'])}}
                        </div>
                        <div class="dealer-labels heading-font">
                            <img class="car-icon" src="{{asset('img/car-icon.svg')}}">
                        </div>
                        <div class="dealer-labels dealer-cars-count">{{ __('Cars in stock') }}</div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-4 col-md-2 dealer-phone">
                    <div class="inner">
                        <i class="fa fa-phone"></i>
                        @include('elements.specialist-phonenumbers')
                    </div>
                </div>

                @include('elements.specialist-list-address')
            </div>
        @endforeach
        </div>
        {{ $specialists->links('elements.pager') }}
    </div>


@stop

