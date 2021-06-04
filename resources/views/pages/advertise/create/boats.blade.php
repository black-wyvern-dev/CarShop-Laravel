@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/cars.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-sortable.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('js/pages/cars.js')}}"></script>
@endsection

@section('content')
    <div class="flex-center position-ref full-height container card paddedContainer bg-darker text-white">
        <div class="content">
            <h3>{{ __('Create a new car advertise') }}</h3>
            <form id="addCarForm" role="form" autocomplete="off">
                @csrf
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="mfv-errorBox"></div></div>

                    <div class="form-group importantFields row">
                        <div class="col-md-3">
                            <label for="firstName" class="col-form-label text-md-right">{{ __('Make') }}*</label>
                            <select id="makeSelector" class="custom-select" name="make" mfv-placeholder="{{ __('Make') }}" mfv-checks="required:true;">
                                <option selected>{{ __('Select Make') }}</option>
                                @foreach($makes as $make)
                                    <option value="{{str_replace(chr(194)," ",$make->slug)}}">{{str_replace(chr(194)," ",$make->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="lname" class="col-form-label text-md-right">{{ __('Model') }}*</label>
                            <select id="modelSelector" class="custom-select" name="model" mfv-placeholder="{{ __('Model') }}" mfv-checks="required:true;">
                                <option selected>{{ __('Select Model') }}</option>
                                @foreach($models as $model)
                                    <option value="{{str_replace(chr(194)," ",$model->slug)}}">{{str_replace(chr(194)," ",$model->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Model type') }}*</label>
                            <input id="email" type="text" class="form-control" name="modelType" mfv-placeholder="{{ __('Model type') }}"  mfv-checks="required:true;">
                        </div>
                        <div class="col-md-3">
                            <label for="lname" class="col-form-label text-md-right">{{ __('Year') }}*</label>
                            <select class="custom-select" name="currency" mfv-placeholder="{{ __('Year') }}"  mfv-checks="required:true;numeric:true">
                                <option selected>{{ __('Select Year') }}</option>
                                @foreach($years as $year)
                                    <option value="{{$year->slug}}">{{$year->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="email" class="col-form-label text-md-right"><i class="fa fa-car-side"></i> {{ __('Body type') }}</label>
                            <select class="custom-select" name="currency" mfv-checks="required:true;">
                                <option selected>{{ __('Select Body') }}</option>
                                @foreach($bodies as $body)
                                    <option value="{{$body->slug}}">{{$body->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="col-form-label text-md-right"><i class="fas fa-road"></i> {{ __('Odometer') }}</label>
                            <input id="email" type="text" class="form-control" name="email" mfv-placeholder="{{ __('Email address') }}"  mfv-checks="required:true;numeric:true;max:12">
                        </div>
                        <div class="col-md-4">
                            <label for="email" style="padding-left: 15px;" class="col-form-label row text-md-right"><i class="fas fa-tachometer-alt"></i> {{ __('Miles/kms') }}</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="miles/kms" id="milesCheck" value="miles">
                                <label class="form-check-label" for="milesCheck">{{ __('miles') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="miles/kms" id="kmsCheck" value="kms">
                                <label class="form-check-label" for="miles/kms">{{ __('kms') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="email" class="col-form-label text-md-right"><i class="fas fa-gas-pump"></i> {{ __('Fuel type') }}</label>
                            <select class="custom-select" name="currency">
                                <option selected>{{ __('Select Fuel Type') }}</option>
                                @foreach($fuelTypes as $fuelType)
                                    <option value="{{$fuelType->slug}}">{{$fuelType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="col-form-label text-md-right"><i class="fas fa-cogs"></i> {{ __('Transmission') }}</label>
                            <select class="custom-select" name="currency">
                                <option selected>{{ __('Select Transmission') }}</option>
                                @foreach($transmissions as $transmission)
                                    <option value="{{$transmission->slug}}">{{$transmission->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="email" class="col-form-label text-md-right"><i class="fa fa-align-center"></i> {{ __('Upholstery') }}</label>
                            <select class="custom-select" name="currency">
                                <option selected>{{ __('Select Upholstery') }}</option>
                                @foreach($upholsteries as $upholstery)
                                    <option value="{{$upholstery->slug}}">{{$upholstery->name}}</option>
                                @endforeach
                            </select>                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right"><i class="fas fa-brush"></i> {{ __('Exterior color') }}</label>
                            <select class="custom-select" name="currency">
                                <option selected>{{ __('Select Exterior Color') }}</option>
                                @foreach($exteriorColors as $exteriorColor)
                                    <option value="{{$exteriorColor->name}}">{{$exteriorColor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right"><i class="fas fa-palette"></i> {{ __('Interior color') }}</label>
                            <select class="custom-select" name="currency">
                                <option selected>{{ __('Select Interior Color') }}</option>
                                @foreach($interiorColors as $interiorColor)
                                    <option value="{{$interiorColor->name}}">{{$interiorColor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="vin" class="col-form-label text-md-right"><i class="fas fa-clipboard-check"></i> {{ __('VIN') }}</label>
                            <input id="vin" type="text" class="form-control" name="vin" mfv-placeholder="{{ __('VIN') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="email" style="padding-left: 15px;" class="col-form-label row text-md-right">
                                <img class="steering-icon steering-icon-nohover"  src="{{asset('img/steering-icon.png')}}">
                                <img class="steering-icon steering-icon-hover" src="{{asset('img/steering-hover.png')}}"> <span style="margin-top: 4px;">{{ __('Steering') }}</span>
                            </label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="steering" id="LhdCheck" value="Lhd">
                                <label class="form-check-label">{{ __('Lhd') }}</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="steering" id="RhdCheck" value="Rhd">
                                <label class="form-check-label">{{ __('Rhd') }}</label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="phoneNumber" class="col-form-label text-md-right">{{ __('Price') }}* ({{Auth::user()->currency}})</label>
                        <input id="phoneNumber" type="text" class="form-control" name="phoneNumber" mfv-placeholder="{{ __('Phone number') }}"  mfv-checks="numeric:true;max:50;">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 form-group">
                        <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                        <textarea class="form-control" name="description" rows="7"></textarea>
                    </div>
                </div>
            </form>
            <div class="row form-group">
                <div class="col-md-8">
                    <label class="col-md-12" for="photosUpForm" style="padding-left: 0px;">{{ __('Photos') }}</label>
                    <div class="col-md-12" style="padding: 0px;">
                        <form role="form" autocomplete="off" id="photosUpForm" enctype="multipart/form-data">
                            <input type="file" multiple="multiple" class="form-control-file filestyle" name="photos" id="file_cars">
                            <div class="selectedPhotoContent"></div>
                            <i class="fas fa-camera"></i>
                        </form>
                    </div>
                </div>
                <div class="col-md-4" id="multiUploadFormError">
                    <div class="mfv-errorBox"></div>
                    <br>
                    <span>{{ __('Recommended image resolution: 800 x 470 px or higher.') }}</span>
                    <br>
                    <br>
                    <span>{{ __('The first image will be put on the cover') }}</span>
                </div>
            </div>
            <div class="col-md-8 row form-group">
                <div id="gallery" class="gallery col-md-12 row">
                    <div class="redMultiLoader col-md-3">
                        <img src="{{asset('img/loading.gif')}}"/>
                    </div>
                </div>
            </div>
            <form>
                <div class="col-md-5 row form-group">
                    <label class="col-md-12" for="photosUpForm" style="padding-left: 0px;">{{ __('Video link') }}</label>
                    <input id="video" type="text" class="form-control col-md-10" name="video" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" mfv-placeholder="{{ __('YouTube URL') }}" mfv-checks="required:true;">
                    <button class="btn btn-danger col-md-2"><i class="fa fa-plus"></i> </button>
                </div>
                <div class="col-md-6" id="multiUploadFormError">
                    <div class="mfv-errorBox"></div>
                </div>
            </form>
            <div class="form-group row">
                <div class="row h-100 pull-right">
                    <button type="submit" class="btn btn-danger" onClick="$('#addCarForm').submit();">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>

        </div>
    </div>
@stop
