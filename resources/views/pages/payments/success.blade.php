@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/packages.css')}}">
   
@endsection


@section('content')

    <div class="container card bg-darker text-white" style="margin-top:20px;margin-bottom:20px;padding:20px;">
        <h3>{{ __('Thanks for buying this package.') }}</h3>
        <hr>
      
        <a href="{{config('app.url')}}/user/advertise">{{ __('Continue advertise your classics!') }}</a>
        
    </div>
@stop

