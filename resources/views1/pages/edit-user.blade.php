@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/cars.css')}}">
    <link rel="stylesheet" href="{{asset('css/selectize.css')}}">
    <link rel="stylesheet" href="{{asset('css/stm-icons.css')}}">
        <link rel="stylesheet" href="{{asset('css/countrySelector.css')}}">

@endsection

@section('scripts')
    <script src="{{asset('js/jquery-sortable.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('js/microevent.js')}}"></script>
    <script src="{{asset('/js/countrySelect.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js?sitekey={{ urlencode(env('GOOGLE_RECAPTCHA_SITE_KEY')) }}" async defer></script>
    <script src="{{asset('/js/countrySelect.min.js')}}"></script>
    <script src="{{asset('js/login-register.js')}}"></script>
    <script>
        $(function() {
            mfValid.init('#addCarForm');
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
        cars = {

            editUser: function(){
                values = $('#addCarForm').serializeArray();
                $.ajax({
                    url:'editUser',
                    type:'POST',
                    data: values,
                    success:function(data){
                     mfValid.launchSuccessMessage('#addCarForm', 'Success! Your record has been updated!');
                     window.location.href = '../../users';
                    },
                });

            }
        }
    </script>


@endsection

@section('content')

    <div class="wrapper">
        <div class="sidebar">
            <!--
              Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
          -->
            <div class="sidebar-wrapper ps">
                <ul class="nav">
                    <li>
                        <a href="{{action('AdminController@homePage')}}">
                            <i class="fa fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li>
                        <a href="{{action('AdminController@users')}}">
                            <i class="fa fa-user"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{action('AdminController@banners')}}">
                            <i class="fa fa-flag" aria-hidden="true"></i>
                            <p>Banners</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{action('AdminController@makes')}}">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                            <p>Makes</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{action('AdminController@listings')}}">
                            <i class="fa fa-list"></i>
                            <p>Listings</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{action('AdminController@logOut')}}">
                            <i class="fa fa-power-off"></i>
                            <p>Log out</p>
                        </a>
                    </li>

                </ul>
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
                        <div class="card">
                            <div class="card-header">
            <h3>Edit User</h3>
            <form id="addCarForm" role="form" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input class="hiddenBtn" name="userID" value="{{$users['userID']}}">

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="mfv-errorBox"></div></div>
                  
                    <div class="form-group importantFields row">
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('First Name') }}</label>
                            <input name="firstName" type="text" class="form-control" value="{{$users['firstName']}}" name="modelType" mfv-placeholder="First Name">
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <input name="lastName" type="text" class="form-control" value="{{$users['lastName']}}"  mfv-placeholder="Last Name">
                            </div>
                           <div class="col-md-3">
                                <label for="modelType" class="col-form-label text-md-right">{{ __('Business Name') }}</label>
                                <input id="email" type="text" class="form-control" value="{{$users['businessName']}}" name="businessName" mfv-placeholder="Business Name">
                            </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                            <input id="email" type="text" class="form-control" value="{{$users['mobileNumber']}}" name="mobileNumber" mfv-placeholder="Mobile Number">
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <input id="email" type="text" class="form-control" value="{{$users['phoneNumber']}}" name="phoneNumber" mfv-placeholder="Phone Number">
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Email') }}</label>
                            <input id="email" type="text" class="form-control" value="{{$users['email']}}" name="email" mfv-placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group importantFields row">
                        <div class="col-md-3">
                            <label for="street" class="col-form-label text-md-right">{{ __('Street') }}</label>
                            <input id="street" type="text" class="form-control" value="{{$users['street']}}" name="street" mfv-placeholder="Street">
                        </div>
                        <div class="col-md-3">
                            <label for="street2" class="col-form-label text-md-right">{{ __('Street 2') }}</label>
                            <input id="street2" type="text" class="form-control" value="{{$users['street2']}}" name="street2" mfv-placeholder="Street 2">
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Town') }}</label>
                            <input id="town" type="text" class="form-control" value="{{$users['town']}}" name="town" mfv-placeholder="Town">
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Country') }}</label>
                            <input id="country_company_selector" type="text" value="{{$users['country']}}"  class="form-control  col-md-12" name="country" mfv-placeholder="Country" mfv-checks="required:true;">
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Post code') }}</label>
                            <input id="postCode" type="text" class="form-control" value="{{$users['postCode']}}" name="postCode" mfv-placeholder="Post code">
                        </div>
                    </div>
                    <div class="form-group importantFields row">
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('VAT Number') }}</label>
                            <input id="vatNumber" type="text" class="form-control" value="{{$users['vatNumber']}}" name="vatNumber" mfv-placeholder="VAT Number">
                        </div>
                       <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Website') }}</label>
                            <input id="website" type="text" class="form-control" value="{{$users['website']}}" name="website" mfv-placeholder="Website">
                        </div>
                        <div class="col-md-3">
                            


                            <label for="email" class="col-form-label text-md-right">{{ __('Currency') }}</label>
                                       
                            <select class="form-control" name="currency" id="">
                                <option @if($users['currency'] == "\u20AC"  ) selected @endif value="\u20AC"  >&euro;</option>
                                <option @if($users['currency'] == "$"  ) selected @endif value="$"  >$</option>
                                <option @if($users['currency'] == "\u00A3"  ) selected @endif value="\u00A3"  >&pound;</option>
                                <option @if($users['currency'] == "SEK") selected @endif value="SEK">{{ __('SEK') }}</option>
                                <option @if($users['currency'] == "\u20BD"  ) selected @endif value="\u20BD"  >&#8381;</option>
                                <option @if($users['currency'] == "NZ$") selected @endif value="NZ$">{{ __('NZ$') }}</option>
                            </select>


                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Description') }}</label>
                            <input id="description" type="text" class="form-control" value="{{$users['description']}}" name="description" mfv-placeholder="Description">
                        </div>
                    </div>   
                    <div class="form-group importantFields row">
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Specialism') }}</label>
                            <input id="specialism" type="text" class="form-control" value="{{$users['specialism']}}" name="specialism" mfv-placeholder="Specialism">
                        </div>
                       <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('We Speak') }}</label>
                            <input id="weSpeak" type="text" class="form-control" value="{{$users['weSpeak']}}" name="weSpeak" mfv-placeholder="We Speak">
                        </div>
                       <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Twitter') }}</label>
                            <input id="twitter" type="text" class="form-control" value="{{$users['twitter']}}" name="twitter" mfv-placeholder="Twitter">
                        </div>
                        <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Facebook') }}</label>
                            <input id="facebook" type="text" class="form-control" value="{{$users['facebook']}}" name="facebook" mfv-placeholder="Facebook">
                        </div>
                    </div>
                    <div class="form-group importantFields row">
                         <div class="col-md-3">
                            <label for="modelType" class="col-form-label text-md-right">{{ __('Instagram') }}</label>
                            <input id="instagram" type="text" class="form-control" value="{{$users['instagram']}}" name="instagram" mfv-placeholder="Instagram">
                        </div>
                    

                   <!--   <form role="form" autocomplete="off" id="photosUpForm" enctype="multipart/form-data">
                        <input type="file" class="form-control-file filestyle" name="image" id="file_cars">
                        <div class="selectedPhotoContent">
                           
                        </div>
                    </form>
 -->


                    </div>                                
                </div>
                         <button type="submit" id="submitFirstButton" class="hiddenBtn" mfv-action="cars.editUser()"></button> 
            </form>
            <button type="submit" class="btn pull-right btn-danger" onClick="$('#submitFirstButton').click();">
                            {{ __('Save') }}
                        </button>
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
                        </script> Classic Cars <i class="tim-icons icon-heart-2"></i>
                    </div>
                </div>
            </footer>
    </div>
@stop
