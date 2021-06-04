@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/packages.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/pages/packages.js')}}"></script>
    <script src="//www.paypalobjects.com/api/checkout.js" async></script>
@endsection

@section('content')

    <div class="container card bg-darker text-white" style="margin-top:20px;margin-bottom:20px;padding:20px;">
        <h3>{{ __('Chose the right package') }}</h3>

        <!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
        @if(Auth::user()->status == 1)
            <section class="pricing py-5">
                <div class="container">
                    <div class="row">
                        <!-- Free Tier -->
                        @foreach(config('cc-app.depositPackages.private') as $packID => $pack)
                            @include('elements.package-box',['type'  => 'private',  'package' => $pack, 'packID' => $packID])
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <section class="pricing py-5 companyPricing">
                <div class="container">
                    <div class="row">

                        @foreach(config('cc-app.depositPackages.company') as $packID => $pack)
                            @include('elements.package-box',['type'  => 'company',  'package' => $pack, 'packID' => $packID])
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
    </div>

@stop

