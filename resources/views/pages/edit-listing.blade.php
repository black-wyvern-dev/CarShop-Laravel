@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/cars.css')}}">
    <link rel="stylesheet" href="{{asset('css/selectize.css')}}">
    <link rel="stylesheet" href="{{asset('css/stm-icons.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-sortable.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('js/microevent.js')}}"></script>
    <script src="{{asset('js/selectize.js')}}"></script>
    <script src="{{asset('js/pages/cars.js')}}"></script>
@endsection

@section('content')
    <div class="flex-center position-ref full-height container card paddedContainer bg-darker text-white">
        <div class="content">
            <h3>{{ __('Edit your advertisement') }}</h3>
            <form id="addCarForm" role="form" autocomplete="off">
                @csrf
                <input hidden name="id" value="{{$listing['listingID']}}">
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="mfv-errorBox"></div></div>
                    <div class="form-group importantFields row">
                        <div class="col-md-3">
                            <label for="firstName" class="col-form-label text-md-right">{{ __('Make') }}*</label>
                            <select id="makeSelector" name="make" placeholder="{{ __('Select Make') }}" mfv-placeholder="{{ __('Make') }}" mfv-checks="required:true;">
                                <option></option>
                                @foreach($makes as $make)
                                    <option @if(str_replace(" ","-",$make->name) == $listing['make']) selected @endif value="{{str_replace(" ","-",$make->name)}}">{{str_replace(chr(194)," ",$make->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="lname" class="col-form-label text-md-right">{{ __('Model') }}*</label>
                            <select id="modelSelector" name="model" placeholder="{{ __('Select Model') }}" mfv-placeholder="{{ __('Model') }}" mfv-checks="required:true;">
                                <option></option>
                                @php
                                    $_model_selected = false;
                                @endphp
                                @foreach($models as $model)
                                    @php
                                        /** @var object $model */
                                        $_isSelected = !$_model_selected && str_replace(chr(194)," ",$model->name) == $listing['model'];
                                        if ($_isSelected) {
                                            $_model_selected = true;
                                        }
                                    @endphp
                                    <option @if($_isSelected) selected @endif value="{{str_replace(chr(194)," ",$model->name)}}">{{str_replace(chr(194)," ",$model->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Model type') }}</label>
                            <input id="email" type="text" class="form-control" value="{{$listing['modelType']}}" name="modelType" mfv-placeholder="{{ __('Model type') }}"  mfv-checks="max:64">
                        </div>
                        <div class="col-md-2">
                            <label for="lname" class="col-form-label text-md-right">{{ __('Year') }}*</label>
                            <select id="yearSelector" name="year" placeholder="{{ __('Select Year') }}" mfv-placeholder="{{ __('Year') }}"  mfv-checks="required:true;">
                                <option></option>
                                @foreach($years as $year)
                                    <option @if($year->slug == $listing['year']) selected @endif value="{{$year->slug}}">{{$year->name}}</option>
                                @endforeach
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right">
                                <img class="car-icon car-icon-nohover" src="{{asset('img/car-icon.svg')}}">
                                <img class="car-icon car-icon-hover" src="{{asset('img/car-icon-hover.svg')}}">
                                {{ __('Body type') }}*</label>
                            <select id="bodySelector" name="bodyType" placeholder="{{ __('Select Body') }}" mfv-placeholder="{{ __('Body type') }}" mfv-checks="required:true;">
                                <option></option>
                                @foreach($bodies as $body)
                                    <option @if($body->name == $listing['bodyType']) selected @endif value="{{$body->name}}">{{$body->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="odometer" class="col-form-label text-md-right"><i class="fas fa-road"></i> {{ __('Odometer') }}</label>
                            <input id="odometer" type="text" class="form-control" value="{{$listing['odometer']}}" name="odometer" mfv-placeholder="{{ __('Odometer') }}"  mfv-checks="numeric:true;max:12">
                        </div>
                        <div class="col-md-4">
                            <label for="email" style="padding-left: 15px;" class="col-form-label row text-md-right"><i class="fas fa-tachometer-alt"></i> {{ __('Miles/kms') }}</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" @if($listing['odometerType'] == 'miles') checked @endif name="odometerType" id="milesCheck" value="miles">
                                <label class="custom-control-label" for="milesCheck">{{ __('miles') }}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" @if($listing['odometerType'] == 'kms') checked @endif name="odometerType" id="kmsCheck" value="kms">
                                <label class="custom-control-label" for="kmsCheck">{{ __('kms') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="fuelSelector" class="col-form-label text-md-right"><i class="fas fa-gas-pump"></i> {{ __('Fuel type') }}*</label>
                            <select id="fuelSelector" name="fuelType" placeholder="{{ __('Select Fuel type') }}" mfv-placeholder="{{ __('Fuel type') }}" mfv-checks="required:true;">
                                <option></option>
                                @foreach($fuelTypes as $fuelType)
                                    <option @if($fuelType->name == $listing['fuelType']) selected @endif value="{{$fuelType->name}}">{{$fuelType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="engine" class="col-form-label text-md-right"><i class="stm-icon-engine_fill"></i> {{ __('Engine') }}</label>
                            <input id="engine" type="text" class="form-control" value="{{$listing['engine']}}" name="engine" mfv-placeholder="{{ __('Engine') }}"  mfv-checks="max:64">
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right">
                                <img class="transmission-icon transmission-icon-nohover" src="{{asset('img/transmission.png')}}">
                                <img class="transmission-icon transmission-icon-hover" src="{{asset('img/transmission-hover.png')}}"> <span style="margin-top: 4px;">{{ __('Transmission') }}*</span>
                            </label>
                            <select id="transmissionSelector" name="transmission" placeholder="{{ __('Select Transmission') }}" mfv-placeholder="{{ __('Transmission') }}" mfv-checks="required:true;">
                                <option></option>
                                @foreach($transmissions as $transmission)
                                    <option @if($transmission->name == $listing['transmission']) selected @endif value="{{$transmission->name}}">{{$transmission->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right">
                                <img class="exterior-color-icon exterior-color-nohover"  src="{{asset('img/exterior-color.png')}}">
                                <img class="exterior-color-icon exterior-color-hover" src="{{asset('img/exterior-color-hover.png')}}"> <span style="margin-top: 4px;">{{ __('Exterior color') }}*</span>
                            </label>
                            <select id="exteriorColorSelector" placeholder="{{ __('Select Exterior Color') }}" name="exteriorColor" mfv-placeholder="{{ __('Exterior color') }}" mfv-checks="required:true;">
                                <option></option>
                                @foreach($exteriorColors as $exteriorColor)
                                    <option @if($exteriorColor->name == $listing['exteriorColor']) selected @endif value="{{$exteriorColor->name}}">{{$exteriorColor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right"><i class="fas fa-palette"></i> {{ __('Interior color') }}*</label>
                            <select id="interiorColorSelector"  name="interiorColor" placeholder="{{ __('Select Interior Color') }}" mfv-placeholder="{{ __('Interior color') }}" mfv-checks="required:true;">
                                <option></option>
                                @foreach($interiorColors as $interiorColor)
                                    <option @if($interiorColor->name == $listing['interiorColor']) selected @endif value="{{$interiorColor->name}}">{{$interiorColor->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right">
                                <img class="car-seat-icon car-seat-icon-nohover"  src="{{asset('img/car-seat.png')}}">
                                <img class="car-seat-icon car-seat-icon-hover" src="{{asset('img/car-seat-hover.png')}}"> <span style="margin-top: 4px;">{{ __('Upholstery') }}*</span>
                            </label>
                            <select id="upholsterySelector" name="upholstery" placeholder="{{ __('Select Upholstery') }}" mfv-placeholder="{{ __('Upholstery') }}" mfv-checks="required:true;">
                                <option></option>
                                @foreach($upholsteries as $upholstery)
                                    <option @if($upholstery->name == $listing['upholstery']) selected @endif value="{{$upholstery->name}}">{{$upholstery->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2" style="margin-right: 16px;">
                        <label for="email" style="padding-left: 15px;" class="col-form-label row text-md-right">
                            <img class="steering-icon steering-icon-nohover"  src="{{asset('img/steering-icon.png')}}">
                            <img class="steering-icon steering-icon-hover" src="{{asset('img/steering-hover.png')}}"> <span style="margin-top: 4px;">{{ __('Steering') }}</span>
                        </label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="steering" @if($listing['steering'] == 'Lhd') checked @endif id="LhdCheck" value="Lhd">
                            <label class="custom-control-label" for="LhdCheck">{{ __('Lhd') }}</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="custom-control-input" type="radio" name="steering" @if($listing['steering'] == 'Rhd') checked @endif id="RhdCheck" value="Rhd">
                            <label class="custom-control-label" for="RhdCheck">{{ __('Rhd') }}</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="vin" class="col-form-label text-md-right"><i class="fas fa-clipboard-check"></i> {{ __('VIN') }}</label>
                        <input id="vin" type="text" class="form-control" name="vin" value="{{$listing['vin']}}" mfv-placeholder="{{ __('VIN') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="price" class="col-form-label text-md-right">{{ __('Price') }}* ({{Auth::user()->currency}})</label>
                        <input id="price" type="text" class="form-control" name="price" @if($listing['price']) value="{{$listing['price']}}" @endif mfv-placeholder="{{ __('Price') }}"  mfv-checks="max:32;">
                    </div>
                    <div class="priceSeparator">
                        <span>{{ __('or') }}</span>
                    </div>

                    <div class="col-md-3">
                        <label for="customlabel" class="col-form-label text-md-right">{{ __('Custom label') }}*</label>
                        <input id="customlabel" type="text" class="form-control" name="customlabel" @if($listing['customlabel']) value="{{$listing['customlabel']}}" @endif mfv-placeholder="{{ __('Custom label') }}"  mfv-checks="max:52;">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-12 form-group">
                        <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                        <textarea class="form-control" name="description" rows="7">{{$listing['description']}}</textarea>
                    </div>
                </div>
                <button type="submit" id="submitFirstButton" class="hiddenBtn" mfv-action="cars.editAdvertise()"></button>
            </form>
            <div class="row form-group">
                <div class="col-md-8">
                    <label class="col-md-12" for="photosUpForm" style="padding-left: 0px;">{{ __('Photos') }}</label>
                    <div class="col-md-12" style="padding: 0px;">
                        <form role="form" autocomplete="off" id="photosUpForm" enctype="multipart/form-data">
                            <input id="photoCount" value="{{count(session('itemPhotos'))}}" class="hiddenBtn">
                            <input type="file" multiple="multiple" class="form-control-file filestyle" name="photos" id="file_cars">
                            <div class="selectedPhotoContent">@if(count(session('itemPhotos'))) <img class="selectedPhoto" src="{{Helper::getListingMainImage($listing['listingPhotos'])}}"> @endif</div>
                            <i class="fas fa-camera"></i>
                        </form>
                    </div>
                </div>
                <div class="col-md-4" id="multiUploadFormError">
                    <label class="col-md-12"></label>
                    <div class="mfv-errorBox"></div>
                    <br>
                    <span>{{ __('Recommended image resolution: 800 x 470 px or higher.') }}</span>
                    <br>
                    <br>
                    <span>{{ __('The first image will be put on the cover') }}</span>
                </div>
            </div>
            <div class="col-md-8 form-group">
                <div id="gallery" class="gallery col-md-12 row">
                    @if(count(session('itemPhotos')))
                        @foreach(session('itemPhotos') as $k => $photo)
                            <div class="col-md-3 photoList photoGallery-{{$photo}}" data-index="{{$k}}">
                                <img class="photo-gallery photo-selected" src="{{asset('uploads/listings/photos/'.$photo)}}">
                                <button class="photo-close" data-toggle="tooltip" title="Delete" onclick="cars.deletePhoto({{$k}})"></button>
                            </div>
                        @endforeach
                    @endif
                    <div class="redMultiLoader col-md-3">
                        <img src="{{asset('img/loading.gif')}}"/>
                    </div>
                </div>
            </div>
            <form id="addVideoLink" role="form" autocomplete="off">
                <div class="col-md-5 row form-group">
                    <label class="col-md-12" id="videoYoutubeLabel" for="photosUpForm" style="cursor:pointer;padding-left: 0px;"><img style="width: 28px;margin-right: 5px;" src="{{asset('img/social/youtube.png')}}"> {{ __('Video/ Youtube') }}</label>
                    <input id="video" type="text" style="margin-right: 10px;" class="form-control col-md-10" value="{{$listing['video']}}" name="video" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" mfv-placeholder="{{ __('YouTube URL') }}" mfv-checks="required:true;">
                </div>
                <div class="moreVideoLinks"></div>
            </form>
            <div class="form-group row">
                <div class="row h-100 pull-right">
                    <button type="submit" class="btn btn-success" onClick="$('#submitFirstButton').click();">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>

        </div>
    </div>
@stop
