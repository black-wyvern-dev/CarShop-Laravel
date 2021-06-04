@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/cars.css')}}">
    <link rel="stylesheet" href="{{asset('css/selectize.css')}}">
    <link rel="stylesheet" href="{{asset('css/stm-icons.css')}}">
@endsection

@section('scripts')
    <script src="{{asset('js/jquery-sortable.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
@endsection

@section('content')
    <style>
        .bootstrap-filestyle>span {
            position: absolute;
            z-index: 1;
            margin-top: 30%!important;
            left: 40%!important;
        }
    </style>
    <script>
        $(function() {
            mfValid.init('#addBannerForm');
            if($('#imageInput').val()){
                $('.bootstrap-filestyle>input').hide();
                $('.bootstrap-filestyle>.group-span-filestyle').hide();
            }
            $(":file").filestyle('btnClass', 'btn-danger');
            $( "#file_cars" ).change(function() {
                var data = new FormData();
                $.each($("#file_cars")[0].files, function(i, file) {
                    data.append('image', file);
                    $('#imageInput').val(file.name);
                });
                $.ajax({
                    type: 'POST',
                    url: 'bannerUpload',
                    data: data,
                    dataType:'json',
                    processData: false,
                    contentType: false,
                    success: function(results){
                            image = results.image;
                            if(results.errors){
                                mfValid.launchCustomError('#addBannerForm', results.errors);
                            }else{
                                $('#photosUpForm>.selectedPhotoContent').html('<img class="selectedPhoto" src="'+image+'">');
                                $('.fa-camera').addClass('selected');
                                $('.bootstrap-filestyle>input').hide();
                                $('.bootstrap-filestyle>.group-span-filestyle').hide();
                            }
                    },
                });
            });
            $( "#photosUpForm>.selectedPhotoContent, #photosUpForm>.fa-camera" ).click(function(){
                $('#photosUpForm>input').click();
            });
        });
        banner = {

            addBanner: function(){
                values = $('#addBannerForm').serializeArray();
                $.ajax({
                    url:'addBanner',
                    type:'POST',
                    data: values,
                    success:function(data){
                        mfValid.launchSuccessMessage('#addBannerForm', 'Success! Your banner has been created!');
                        window.location.href = '../banners';
                    },
                });

            },
            editBanner: function(){
                values = $('#addBannerForm').serializeArray();
                $.ajax({
                    url:'editBanner',
                    type:'POST',
                    data: values,
                    success:function(data){
                        mfValid.launchSuccessMessage('#addBannerForm', 'Success! Your banner has been edited!');
                        window.location.href = '../../banners';
                    },
                });

            }
        }
    </script>
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
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="title">{{ __('Add new banner') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="addBannerForm" role="form" autocomplete="off">
                                            <div class="mfv-errorBox"></div>
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-group importantFields row">
                                                    <div class="col-md-6">
                                                        <label for="firstName" class="col-form-label text-md-right">{{ __('Name') }}</label>
                                                        <input id="email" @if(isset($banner['name'])) value="{{$banner['name']}}" @endif type="text" class="form-control" name="name" mfv-placeholder="{{ __('Name') }}"  mfv-checks="max:64">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="lname" class="col-form-label text-md-right">{{ __('Link') }}*</label>
                                                        <input id="email" @if(isset($banner['link'])) value="{{$banner['link']}}" @endif type="text" class="form-control" name="link" mfv-placeholder="{{ __('Link') }}"  mfv-checks="required;max:64">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="modelType" class="col-form-label text-md-right">{{ __('Page') }}</label>
                                                        <select class="form-control" name="page">
                                                            <option selected value="1">{{ __('Cars page') }}</option>
                                                            <option value="3">{{ __('Home page') }}</option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <input hidden="true" @if(isset($banner['image'])) value="{{$banner['image']}}" @endif name="image" id="imageInput">
                                            @if(isset($banner['bannerID']))
                                                <input hidden="true" value="{{$banner['bannerID']}}" name="bannerID">
                                            @endif
                                            <button type="submit" id="submitFirstButton" class="hiddenBtn" @if(isset($banner['bannerID'])) mfv-action="banner.editBanner()" @else mfv-action="banner.addBanner()" @endif></button>
                                        </form>
                                        <label class="col-md-12" for="photosUpForm" style="padding-left: 0px;">{{ __('Image') }}</label>
                                        <div class="col-md-12" style="padding: 0px;">
                                            <form role="form" autocomplete="off" id="photosUpForm" enctype="multipart/form-data">
                                                <input type="file" class="form-control-file filestyle" name="image" id="file_cars">
                                                <div class="selectedPhotoContent">
                                                    @isset($banner['image'])
                                                        <img class="selectedPhoto" src="{{asset('uploads/banners/'.$banner['image'])}}">
                                                    @endisset
                                                </div>
                                                <i @isset($banner['image']) class="fas fa-camera selected" @else class="fas fa-camera" @endisset></i>
                                            </form>
                                        </div>
                                        <button class="btn btn-success pull-right" onclick="$('#submitFirstButton').click();">{{ __('Save') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    </div>
@stop

