@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/advertise.css')}}">
@endsection

@section('content')

    <div class="flex-center position-ref full-height container card paddedContainer bg-dark text-white">
        <div class="content">
            <h3>{{ __('Advertise') }}</h3>

            <div class="row">
                <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto adCategory">
                    <a href="{{action('AdvertiseController@create',['type' => 'cars'])}}" class="card  shadow-lg  bg-success">
                        <div class="card-body d-flex align-items-end flex-column text-right text-white">
                            <h4>{{ __('Cars') }}</h4>
                            <p class="w-75">{{ __('Category description') }}</p>
                            <i class="fa fa-pencil-ruler"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto adCategory">
                    <a href="{{action('AdvertiseController@create',['type' => 'car-parts'])}}" class="card  shadow-lg  bg-warning">
                        <div class="card-body d-flex align-items-end flex-column text-right text-white">
                            <h4>{{ __('Car parts') }}</h4>
                            <p class="w-75">{{ __('Category description') }}</p>

                            <i class="fa fa-code"></i>
                        </div>
                    </a>
                </div>


                <div class="col-lg-4 col-md-8 mx-auto adCategory">
                    <a href="{{action('AdvertiseController@create',['type' => 'motorbikes'])}}" class="card shadow-lg  bg-success">
                        <div class="card-body d-flex align-items-end flex-column text-right text-white">
                            <h4>{{ __('Motorbikes') }}</h4>
                            <p class="w-75">{{ __('Category description') }}</p>

                            <i class="fa fa-book"></i>
                        </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto adCategory">
                    <a href="{{action('AdvertiseController@create',['type' => 'mopeds'])}}" class="card  shadow-lg bg-info">
                        <div class="card-body d-flex align-items-end flex-column text-right text-white">
                            <h4>{{ __('Mopeds') }}</h4>
                            <p class="w-75">{{ __('Category description') }}</p>

                            <i class="fa fa-pencil-ruler"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-8 mb-5 mb-lg-0 mx-auto adCategory">
                    <a href="{{action('AdvertiseController@create',['type' => 'boats'])}}" class="card  shadow-lg bg-primary">
                        <div class="card-body d-flex align-items-end flex-column text-right text-white">
                            <h4>{{ __('Boats') }}</h4>
                            <p class="w-75">{{ __('Category description') }}</p>

                            <i class="fa fa-code"></i>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-8 mx-auto adCategory">
                    <a href="{{action('AdvertiseController@create',['type' => 'automobilia'])}}" class="card shadow-lg bg-dark">
                        <div class="card-body d-flex align-items-end flex-column text-right text-white">
                            <h4>{{ __('Automobilia') }}</h4>
                            <p class="w-75">{{ __('Category description') }}</p>

                            <i class="fa fa-book"></i>
                        </div>
                    </a>
                </div>

            </div>

        </div>
    </div>


@stop

