@extends('layouts.admin')

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
    <script>
        $(function() {
            mfValid.init('#addCarForm');
            mfValid.init('#photosUpForm');
            mfValid.init('#addVideoLink');
            if($('#photoCount').val() > 0){
                $('.bootstrap-filestyle>input').hide();
                $('.bootstrap-filestyle>.group-span-filestyle').hide();
            }
            cars.initSelection();

            selectMake = $("#makeSelector").selectize();
            selectModel = $("#modelSelector").selectize();
            if($('#makeSelector').val()){
                // var result = [];
                selectize = selectModel[0].selectize;
                selectize.clearOptions();
                $.ajax({
                    type: 'POST',
                    url: '../getMakeModels',
                    data: {slug:$('#makeSelector').val()},
                    dataType: 'json',
                    success: function (data) {
                        $('#modelSelector').html('<option></option>');
                        $.each(data['models'], function(i, value ) {
                            if(value.name == $('#modelSelector').attr('data-value')){
                                $('#modelSelector').append('<option selected value='+value.name+'>'+value.name+'</option>');
                            }else{
                                $('#modelSelector').append('<option value='+value.name+'>'+value.name+'</option>');
                            }
                            selectize.addOption({value:value.name, text:value.name});
                            selectModel[0].selectize.refreshOptions();
                        });
                    },
                });
            }

            selectMake.on('change', function() {
                // selectModel[0].selectize.clear();
                selectize = selectModel[0].selectize;
                selectize.clearOptions();
                if($(this).val() !== 'Select Make') {
                    // var result = [];
                    $.ajax({
                        type: 'POST',
                        url: '../getMakeModels',
                        data: {slug:$(this).val()},
                        dataType: 'json',
                        success: function (data) {
                            $('#modelSelector').html('<option></option>');
                            $.each(data['models'], function(i, value ) {
                                $('#modelSelector').append('<option value='+value.name+'>'+value.name+'</option>');
                                selectize.addOption({value:value.name, text:value.name});
                            });
                            selectModel[0].selectize.refreshOptions();
                        },
                    });
                }
            });
            $("#yearSelector").selectize();
            $("#bodySelector").selectize();
            $("#fuelSelector").selectize();
            $("#transmissionSelector").selectize();
            $("#interiorColorSelector").selectize();
            $("#exteriorColorSelector").selectize();
            $("#upholsterySelector").selectize();

            $(":file").filestyle('btnClass', 'btn-danger');
            $( "#file_cars" ).change(function() {
                var data = new FormData();
                $.each($("#file_cars")[0].files, function(i, file) {
                    data.append('photos[]', file);
                });
                $.ajax({
                    type: 'POST',
                    url: '../photoUpload',
                    data: data,
                    dataType:'json',
                    beforeSend: function(){
                        // Showing loading swirl
                        $('.redMultiLoader').show();
                    },
                    processData: false,
                    contentType: false,
                    success: function(results){
                        $('.redMultiLoader').hide();
                        photos = results.photos;
                        // $('#multiUploadFormError').html('');
                        $.each(photos, function(i, photo ) {
                            if(photo.errors){
                                $('#multiUploadFormError').html('<div class="mfv-errorBox"></div>');
                                mfValid.launchCustomError('#multiUploadFormError', photo.errors);
                            }else{
                                $('#photosUpForm>.selectedPhotoContent').html('<img class="selectedPhoto" src="'+photo.fileName+'">');
                                $('.fa-camera').addClass('selected');
                                $('.bootstrap-filestyle>input').hide();
                                $('.bootstrap-filestyle>.group-span-filestyle').hide();
                                if($('.photo-selected').length){
                                    $('.photo-selected').removeClass('photo-selected');
                                }
                                if(results.total < 20){
                                    $('#gallery>.redMultiLoader').before('<div class="col-md-3 photoList photoGallery-'+photo.fileName+'" data-index="'+photo.key+'">\n' +
                                        '<img class="photo-gallery photo-selected" src="'+photo.fileName+'">\n' +
                                        '<button class="photo-close" data-toggle="tooltip" title="Delete" onclick="cars.deletePhoto('+photo.key+')"></button>\n' +
                                        '</div>');
                                }
                            }
                        });

                        cars.initSelection();
                    },
                });
            });
            $( "#photosUpForm>.selectedPhotoContent, #photosUpForm>.fa-camera" ).click(function(){
                $('#photosUpForm>input').click();
            });

        });
        cars = {
            initSelection: function(){
                $( "#gallery>.col-md-3" ).click(function(){
                    if($('.photo-selected').length){
                        $('.photo-selected').removeClass('photo-selected');
                    }
                    $(this).find('.photo-gallery').addClass('photo-selected');
                    $('.selectedPhoto').attr('src', $(this).find('.photo-gallery').attr('src'));
                });
            },
            getMakeModels: function(slug){
                $.ajax({
                    type: 'POST',
                    url: 'getMakeModels',
                    data: {slug:slug},
                    dataType: 'json',
                    success: function (data) {
                        $('#modelSelector').html('<option></option>');
                        $.each(data['models'], function(i, value ) {
                            $('#modelSelector').append('<option value='+value.slug+'>'+value.name+'</option>');
                        });
                    },

                });
            },
            deletePhoto(index){
                $('.photoList[data-index='+index+']').fadeOut();
                $.ajax({
                    url:'../deleteListing',
                    type:'POST',
                    data: {index:index},
                    success:function(data){
                        if(data == 0){
                            $('#photosUpForm>.selectedPhotoContent').html('');
                            $('.fa-camera').removeClass('selected');
                            $('.bootstrap-filestyle>input').show();
                            $('.bootstrap-filestyle>.group-span-filestyle').show();
                        }
                    },
                });
            },
            editAdvertise: function(){
                values = $.merge($('#addCarForm').serializeArray(), $('#addVideoLink').serializeArray());
                $.ajax({
                    url:'../editListing',
                    type:'POST',
                    data: values,
                    success:function(data){
                       mfValid.launchSuccessMessage('#addCarForm', 'Success! Your car advertise has been updated!');
                    },
                });

            }


        };
    </script>
@endsection

@section('content')

    <div class="wrapper">
        <div class="sidebar">
            <!--
              Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
          -->
            <div class="sidebar-wrapper ps">
                @include('admin.leftside')

                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
        <div class="main-panel ps">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle d-inline">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:void(0)">
                            <div class="logo">
                                <a href="javascript:void(0)" class="simple-text logo-mini">
                                    <img style="width: 140px;margin-left: 33px;" src="{{asset('/img/classics-specialists-logo-001.png')}}">
                                </a>
                            </div>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col-12">
                            <div class="row">
                                <div  class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="title">{{ __('Edit: :make', ['make' => Helper::formatItemName($listing['make'])]) }} {{Helper::formatItemName($listing['model'])}}</h5>
                                        </div>
                                        <div class="card-body">
                                            <form id="addCarForm" role="form" autocomplete="off">
                                                <div class="mfv-errorBox"></div>
                                                <input class="hiddenBtn" name="listingID" value="{{$listing['listingID']}}">
                                                @csrf
                                                <div class="form-group">
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="firstName" class="col-form-label text-md-right">{{ __('Make') }}*</label>
                                                            <select id="makeSelector" name="make" placeholder="{{ __('Select Make') }}" mfv-placeholder="{{ __('Make') }}" mfv-checks="required:true;" class="form-control">
                                                                <option></option>
                                                                @foreach($makes as $make)
                                                                    <option @if($listing['make'] == str_replace(chr(194)," ",$make->slug)) selected @endif value="{{str_replace(chr(194)," ",$make->slug)}}">{{str_replace(chr(194)," ",$make->name)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                       <div class="col-md-3">
                                                            <label for="firstName" class="col-form-label text-md-right">{{ __('Model') }}*</label>
                                                            <select id="modelSelector" name="model" placeholder="{{ __('Select Model') }}" mfv-placeholder="{{ __('Model') }}" class="form-control">
                                                            <option></option>
                                                            @foreach($models as $model)
                                                                    <option @if($listing['model'] == str_replace(chr(194)," ",$model->slug)) selected @endif value="{{str_replace(chr(194)," ",$model->slug)}}">{{str_replace(chr(194)," ",$model->name)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="modelType" class="col-form-label text-md-right">{{ __('Model type') }}</label>
                                                            <input id="modelType" type="text" class="form-control" value="{{$listing['modelType']}}" name="modelType" mfv-placeholder="{{ __('Model Type') }}"  mfv-checks="max:64">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label for="lname" class="col-form-label text-md-right">{{ __('Year') }}*</label>
                                                            <select id="yearSelector" name="year" placeholder="{{ __('Select Year') }}" mfv-placeholder="{{ __('Year') }}"  mfv-checks="required:true;numeric:true" class="form-control">
                                                                <option></option>
                                                                @foreach($years as $year)
                                                                    <option @if($listing['year'] == $year->slug) selected @endif value="{{$year->slug}}">{{$year->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="email" class="col-form-label text-md-right">
                                                                <img class="car-icon car-icon-nohover" src="{{asset('img/car-icon.svg')}}">
                                                                <img class="car-icon car-icon-hover" src="{{asset('img/car-icon-hover.svg')}}">
                                                                {{ __('Body type') }}*</label>
                                                            <select id="bodySelector" name="bodyType" placeholder="{{ __('Select Body') }}" mfv-placeholder="{{ __('Body type') }}" mfv-checks="required:true;" class="form-control">
                                                                @foreach($bodies as $body)
                                                                    <option @if($listing['bodyType'] == str_replace(chr(194)," ",$body->slug)) selected @endif value="{{$body->slug}}">{{$body->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="odometer" class="col-form-label text-md-right"><i class="fas fa-road"></i> {{ __('Odometer') }}</label>
                                                            <input id="odometer" type="text" class="form-control" name="odometer" value="{{$listing['odometer']}}" mfv-placeholder="{{ __('Odometer') }}"  mfv-checks="numeric:true;max:12">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email" style="padding-left: 15px;" class="col-form-label row text-md-right"><i class="fas fa-tachometer-alt"></i> {{ __('Miles/kms') }}</label>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input class="custom-control-input" type="radio" name="miles/kms" id="milesCheck" value="miles">
                                                                <label class="custom-control-label" for="milesCheck">{{ __('miles') }}</label>
                                                            </div>
                                                            <div class="custom-control custom-radio custom-control-inline">
                                                                <input class="custom-control-input" type="radio" name="miles/kms" id="kmsCheck" value="kms">
                                                                <label class="custom-control-label" for="kmsCheck">{{ __('kms') }}</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-3">
                                                            <label for="fuelSelector" class="col-form-label text-md-right"><i class="fas fa-gas-pump"></i> {{ __('Fuel type') }}*</label>
                                                            <select id="fuelSelector" name="fuelType" placeholder="{{ __('Select Fuel type') }}" mfv-placeholder="{{ __('Fuel type') }}" mfv-checks="required:true;">
                                                                <option @if($listing['fuelType']) selected value="{{$listing['fuelType']}}" >{{$listing['fuelType']}} @else > @endif</option>
                                                                @foreach($fuelTypes as $fuelType)
                                                                    <option @if($listing['fuelType'] == str_replace(chr(194)," ",$fuelType->slug)) selected @endif value="{{$fuelType->name}}">{{$fuelType->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="engine" class="col-form-label text-md-right"><i class="stm-icon-engine_fill"></i> {{ __('Engine') }}</label>
                                                            <input id="engine" type="text" class="form-control" name="engine" value="{{$listing['engine']}}" mfv-placeholder="{{ __('Engine') }}"  mfv-checks="max:64">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="email" class="col-form-label text-md-right">
                                                                <img class="transmission-icon transmission-icon-nohover" src="{{asset('img/transmission.png')}}">
                                                                <img class="transmission-icon transmission-icon-hover" src="{{asset('img/transmission-hover.png')}}"> <span style="margin-top: 4px;">{{ __('Transmission') }}*</span>
                                                            </label>
                                                            <select id="transmissionSelector" name="transmission" placeholder="{{ __('Select Transmission') }}" mfv-placeholder="{{ __('Transmission') }}" mfv-checks="required:true;" class="form-control">
                                                            <option @if($listing['transmission']) selected value="{{$listing['transmission']}}" >{{$listing['transmission']}} @else > @endif</option>
                                                            @foreach($transmissions as $transmission)
                                                                    <option @if($listing['transmission'] == str_replace(chr(194)," ",$transmission->slug)) selected @endif value="{{$transmission->name}}">{{$transmission->name}}</option>
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
                                                            <select id="exteriorColorSelector" placeholder="{{ __('Select Exterior Color') }}" name="exteriorColor" mfv-placeholder="{{ __('Exterior color') }}" mfv-checks="required:true;" class="form-control">
                                                            <option @if($listing['exteriorColor']) selected value="{{$listing['exteriorColor']}}" >{{$listing['exteriorColor']}} @else > @endif</option>
                                                            @foreach($exteriorColors as $exteriorColor)
                                                                    <option @if($listing['exteriorColor'] == str_replace(chr(194)," ",$exteriorColor->slug)) selected @endif value="{{$exteriorColor->name}}">{{$exteriorColor->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="email" class="col-form-label text-md-right"><i class="fas fa-palette"></i> {{ __('Interior color') }}*</label>
                                                            <select id="interiorColorSelector"  name="interiorColor" placeholder="{{ __('Select Interior Color') }}" mfv-placeholder="{{ __('Interior color') }}" mfv-checks="required:true;" class="form-control">
                                                            <option @if($listing['interiorColor']) selected value="{{$listing['interiorColor']}}" >{{$listing['interiorColor']}} @else > @endif</option>
                                                            @foreach($interiorColors as $interiorColor)
                                                                    <option @if($listing['interiorColor'] == str_replace(chr(194)," ",$interiorColor->slug)) selected @endif value="{{$interiorColor->name}}">{{$interiorColor->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label for="email" class="col-form-label text-md-right">
                                                                <img class="car-seat-icon car-seat-icon-nohover"  src="{{asset('img/car-seat.png')}}">
                                                                <img class="car-seat-icon car-seat-icon-hover" src="{{asset('img/car-seat-hover.png')}}"> <span style="margin-top: 4px;">{{ __('Upholstery') }}*</span>
                                                            </label>
                                                            <select id="upholsterySelector" name="upholstery" placeholder="{{ __('Select Upholstery') }}" mfv-placeholder="{{ __('Upholstery') }}" mfv-checks="required:true;" class="form-control">
                                                            <option @if($listing['upholstery']) selected value="{{$listing['upholstery']}}" >{{$listing['upholstery']}} @else > @endif</option>
                                                            @foreach($upholsteries as $upholstery)
                                                                    <option @if($listing['upholstery'] == str_replace(chr(194)," ",$upholstery->slug)) selected @endif value="{{$upholstery->name}}">{{$upholstery->name}}</option>
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
                                                            <input class="custom-control-input" type="radio" name="steering" id="LhdCheck" value="Lhd">
                                                            <label class="custom-control-label" for="LhdCheck">{{ __('Lhd') }}</label>
                                                        </div>
                                                        <div class="custom-control custom-radio custom-control-inline">
                                                            <input class="custom-control-input" type="radio" name="steering" id="RhdCheck" value="Rhd">
                                                            <label class="custom-control-label" for="RhdCheck">{{ __('Rhd') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="vin" class="col-form-label text-md-right"><i class="fas fa-clipboard-check"></i> {{ __('VIN') }}</label>
                                                        <input id="vin" type="text" class="form-control" value="{{$listing['vin']}}" name="vin" mfv-placeholder="{{ __('VIN') }}">
                                                    </div>
                                                </div>
                                                <button type="submit" id="submitFirstButton" class="hiddenBtn" mfv-action="cars.editAdvertise()"></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <form id="addVideoLink" role="form" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="title">{{ __('Listing details') }}</h5>
                            </div>
                            <div class="card-body">
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="price" class="col-form-label text-md-right">{{ __('Price') }}* ({{$listing['currency']}})</label>
                                    <input id="price" type="text" class="form-control" name="price" value="{{$listing['price']}}" mfv-placeholder="{{ __('Phone number') }}"  mfv-checks="max:32;">
                                </div>
                                <div class="priceSeparator">
                                    <span>{{ __('or') }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label for="customLabel" class="col-form-label text-md-right">{{ __('Custom label') }}*</label>
                                    <input id="customLabel" type="text" class="form-control" name="customLabel" mfv-placeholder="{{ __('Phone number') }}"  mfv-checks="max:52;">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 form-group">
                                    <label for="exampleFormControlTextarea1">{{ __('Description') }}</label>
                                    <textarea class="form-control" name="description" rows="7">{!!$listing['description']!!}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label id="videoYoutubeLabel" for="photosUpForm" style="cursor:pointer;padding-left: 0px;">
                                        <img style="width: 28px;margin-right: 5px;" src="{{asset('img/social/youtube.png')}}"> {{ __('Video/ Youtube') }}</label>
                                    <input id="video" type="text" style="margin-right: 10px;" class="form-control" value="{{$listing['video']}}" name="video" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" mfv-placeholder="{{ __('YouTube URL') }}" mfv-checks="required:true;">
                                </div>
                            </div>
                        </div>
                        </div>
                        </form>

                    </div>
                    <div class="col-12">
                         <div class="card card-user">
                                        <div class="card-header">
                                            <h5 class="title">{{ __('Listing photos') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <form role="form" autocomplete="off" id="photosUpForm" enctype="multipart/form-data">
                                                <input id="photoCount" value="{{count(session('itemPhotos'))}}" class="hiddenBtn">
                                                <input type="file" multiple="multiple" class="form-control-file filestyle" name="photos" id="file_cars">
                                                <div class="selectedPhotoContent">
                                                    @isset($listing['listingPhotos'][0]['name'])
                                                        <img class="selectedPhoto" src="{{asset('uploads/listings/photos/'.$listing['listingPhotos'][0]['name'])}}">
                                                    @endisset
                                                </div>
                                                <i @isset($listing['listingPhotos'][0]['name']) class="fas fa-camera selected" @else class="fas fa-camera" @endisset></i>
                                            </form>
                                        </div>
                                        <div class="card-footer">
                                            <div id="gallery" class="gallery col-md-12 row">
                                                @isset($listing['listingPhotos'][0]['name'])
                                                    @foreach(session('itemPhotos') as $k => $photo)
                                                    <div class="col-md-3 photoList photoGallery-'{{$photo}}'" data-index="{{$k}}">
                                                        <img class="photo-gallery photo-selected" src="{{asset('uploads/listings/photos/'.$photo)}}">
                                                        <button class="photo-close" data-toggle="tooltip" title="Delete" onclick="cars.deletePhoto({{$k}})"></button>
                                                    </div>
                                                 @endforeach
                                                @endisset
                                                <div class="redMultiLoader col-md-3">
                                                    <img src="{{asset('img/loading.gif')}}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <button type="submit" class="btn pull-right btn-success" onClick="$('#submitFirstButton').click();">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> {{ __('Classic Cars') }} <i class="tim-icons icon-heart-2"></i>
                    </div>
                </div>
            </footer>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    </div>
@stop

