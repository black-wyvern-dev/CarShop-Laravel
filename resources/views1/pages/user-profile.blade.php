@extends('layouts.generic')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/countrySelector.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
@endsection
@section('scripts')
    <script src="https://www.google.com/recaptcha/api.js?sitekey={{ urlencode(config('recaptcha.sitekey')) }}" async defer></script>
    <script src="{{asset('/js/countrySelect.min.js')}}"></script>
    <script src="{{asset('js/login-register.js')}}"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script>
        $(function() {
            mfValid.init('#addCarForm');
            if($('#imageInput').val()){
                $('.bootstrap-filestyle>input').hide();
                $('.bootstrap-filestyle>.group-span-filestyle').hide();
            }
            if ($(":file").filestyle) {
                $(":file").filestyle('btnClass', 'btn-danger');
            }

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

            $('#logoForm .logo').click(function(e) {
                var $input = $('#logoForm').find('input');
                $input.focus().click();
            });

            $('#logo').on('change', function() {
                var data = new FormData(document.getElementById('logoForm'));
                var $errorBox = $('.mfv-errorBox');
                var $spinner = $('#logoForm .spinner');
                data.append('logo', $(this).prop('files')[0]);
                $spinner.show();
                $errorBox.removeClass('alert alert-danger').html('');

                $.ajax({
                    type: 'POST',
                    url: '{{ route('user.logo.upload') }}',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var original  = data.filename;
                        var thumbnail = data.thumbnail;
                        var $image    = $('#logoForm .logo img');
                        var url       = {!! json_encode(url(\App\Http\Controllers\UserController::LOGO_DIR) . '/', JSON_UNESCAPED_SLASHES) !!} + original;

                        $image.one('load', function() {
                            $spinner.hide();
                        }).each(function () {
                            if ($(this).complete) {
                                $(this).load();
                            }
                        });
                        $image.attr('src', url);

                        $('#addCarForm input[name=logo]').val(thumbnail);
                    },
                    error: function(data) {
                        $('#logoForm .spinner').hide();
                        var html = '';
                        if (typeof(data.responseJSON) != undefined && typeof(data.responseJSON.errors) != undefined) {
                            $(data.responseJSON.errors).each(function (index, obj) {
                                html += '<li>';
                                for (var name in obj) {
                                    html += '<p>' + name + ':</p><ul>';
                                    $(obj[name]).each(function(index, error) {
                                        html += '<li>' + error + '</li>';
                                    })
                                    html += '</ul>';
                                };
                                html += '</li>';
                            });
                            html = '<ul>' + html + '</ul>';
                        } else {
                            html = data;
                        }

                        $errorBox.addClass('alert alert-danger');
                        $errorBox.html(html);
                    }
                });
            });

            $('#removeBtn').click(function(e) {
                // swal({
                //     text: "Are you sure you want to delete your account with your adverts?",
                //     width: 500,
                //     padding: 50,
                //     showCancelButton: true,
                //     confirmButtonClass: "btn-danger",
                //     confirmButtonText: "Remove",
                //     closeOnConfirm: false
                // }).then((result)=>{
                //     Swal.fire('Saved!', '', 'success')
                // }),

                swal({
                    text: "Are you sure you want to delete your account with your adverts?",
                    type: "warning",
                    confirmButtonText: "Remove",
                    showCancelButton: true
                })
                .then((result) => {
                    if (result.value) {
                        $.ajax({
                            url:'{{route('user.profile.remove')}}',
                            type:'POST',
                            dataType: "json",
                            data : {
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data){
                                if(data.status == 1){
                                    swal(
                                        'Removed!'
                                    )
                                }
                                else{
                                    swal({
                                        title : "Something wrong!",
                                        width: 500,
                                        padding: 50,
                                    })
                                }
                                document.location.reload();
                            },
                            error: function (data) {
                                swal({
                                    title : "Something wrong!",
                                    width: 500,
                                    padding: 50,
                                })
                            }
                        });
                    } else if (result.dismiss === 'cancel') {
                        swal(
                            'Cancelled',
                            'Your stay here :)',
                            'error'
                        )
                    }
                })
                
                // swal({
                //         text: "Are you sure you want to delete your account with your adverts?",
                //         type: "warning",
                //         showCancelButton: true,
                //         confirmButtonColor: "#DD6B55",
                //         confirmButtonText: "Remove",
                //         cancelButtonText: "Cancel",
                //         closeOnConfirm: false,
                //         closeOnCancel: false
                //     }, 
                // function(isConfirm){
                //     alert(';aa')
                //     if (isConfirmed) {
                        
                //     }
                // })
            });
        });

        cars = {
            editProfile: function() {
                values = $('#addCarForm').serializeArray();
                $.ajax({
                    url:'editProfile',
                    type:'POST',
                    data: values,
                    success:function(data){
                     mfValid.launchSuccessMessage('#addCarForm', 'Success! Your record has been updated!');
                     window.location.href = '/user/user-profile';
                    },
                });
            }
        }
    </script>
@endsection
@section('content')


    <div class="user-profile flex-center position-ref full-height container card paddedContainer bg-darker text-white">
        <div class="content">
            <h3>{{ __('My account') }}</h3>

            <form id="logoForm" role="form" autocomplete="off" method="post" enctype="multipart/form-data">
                <div class="form-group importantFields row">
                    <div class="col-12">
                        <label for="logo" class="col-form-label text-md-right">{{ __('Logo') }}</label>
                    </div>
                    <div class="col-12 logo">
                        <div class="spinner"><img src="{!! url('/img/loading.gif') !!}"></div>
                        @php
                            $logo = $users['logo'];
                            if (!empty($logo)) {
                                $logoOriginal     = preg_replace('/-[0-9]+x[0-9]+(\.(gif|jpe?g|png))$/', '$1', $logo);
                                $logoOriginalPath = \App\Http\Controllers\UserController::LOGO_DIR . '/' . $logoOriginal;

                                if (file_exists(public_path($logoOriginalPath))) {
                                    $logo = $logoOriginal;
                                }
                            }

                            if ('' == $logo || 'no-logo.png' == $logo) {
                                $logo = \App\Http\Controllers\UserController::NO_LOGO_DIR . '/no-logo.png';
                            } else {
                                $logo = \App\Http\Controllers\UserController::LOGO_DIR . '/' . $logo;
                            }
                        @endphp
                        <img src="{{ url($logo) }}">
                    </div>
                    <div class="col-xs-12 col-sd-6 col-md-4 col-lg-2">
                        <input type="file" id="logo" name="logo" accept="image/jpeg,image/png,image/gif,image/bmp,image/svg">
                    </div>
                </div>
            </form>

            <form id="addCarForm" role="form" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="logo">
                <input class="hiddenBtn" type="hidden" name="userID" value="{{$users['userID']}}">

                <div class="form-group importantFields row">
                    <div class="col-12 mfv-errorBox"></div>
                </div>

                <div class="form-group importantFields row">
                    <div class="col-xxs-6 col-sm-6 col-md-3">
                        <label for="firstName" class="col-form-label text-md-right">{{ __('First Name') }}</label>
                        <input id="firstName" name="firstName" type="text" class="form-control" value="{{ $users['firstName'] }}" placeholder="{{ __('First Name') }}" mfv-checks="required:true">
                    </div>
                    <div class="col-xxs-6 col-sm-6 col-md-3">
                        <label for="lastName" class="col-form-label text-md-right">{{ __('Last Name') }}</label>
                        <input id="lastName" name="lastName" type="text" class="form-control" value="{{ $users['lastName'] }}"  placeholder="{{ __('Last Name') }}" mfv-checks="required:true">
                    </div>
                    <div class="col-xxs-6 col-sm-6">
                        <label for="businessName" class="col-form-label text-md-right">{{ __('Business Name') }}</label>
                        <input id="businessName" name="businessName" type="text" class="form-control" value="{{ $users['businessName'] }}" placeholder="{{ __('Business Name') }}">
                    </div>
                    <div class="col-xxs-6 col-sm-6">
                        <label for="email" class="col-form-label text-md-right">{{ __('Email') }}</label>
                        <input id="email" name="email" type="text" class="form-control" value="{{ $users['email'] }}" placeholder="{{ __('Email') }}" mfv-checks="required:true;email:true">
                    </div>
                    <div class="col-xxs-6 col-sm-6 col-md-3">
                        <label for="phoneNumber" class="col-form-label text-md-right">{{ __('Phone Number') }}</label>
                        <input id="phoneNumber" name="phoneNumber" type="text" class="form-control" value="{{ $users['phoneNumber'] }}" placeholder="{{ __('Phone Number') }}">
                    </div>
                    <div class="col-xxs-6 col-sm-6 col-md-3">
                        <label for="mobileNumber" class="col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                        <input id="mobileNumber" name="mobileNumber" type="text" class="form-control" value="{{ $users['mobileNumber'] }}" placeholder="{{ __('Mobile Number') }}">
                    </div>
                    <div class="col-xxs-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="street" class="col-form-label text-md-right">{{ __('Street') }}</label>
                                <input id="street" name="street" type="text" class="form-control" value="{{ $users['street'] }}" placeholder="{{ __('Street') }}">
                            </div>
                            <div class="col-md-12">
                                <label for="street2" class="col-form-label text-md-right">{{ __('Street 2') }}</label>
                                <input id="street2" name="street2" type="text" class="form-control" value="{{ $users['street2'] }}" placeholder="{{ __('Street 2') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxs-6 col-sm-6">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="town" class="col-form-label text-md-right">{{ __('Town') }}</label>
                                <input id="town" name="town" type="text" class="form-control" value="{{ $users['town'] }}" placeholder="{{ __('Town') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="postCode" class="col-form-label text-md-right">{{ __('Post Code') }}</label>
                                <input id="postCode" name="postCode" type="text" class="form-control" value="{{ $users['postCode'] }}" placeholder="{{ __('Post Code') }}">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="country" class="col-form-label text-md-right">{{ __('Country') }}</label>
                                <input id="country_company_selector" name="country" type="text" value="{{ $users['country'] }}"  class="form-control" placeholder="{{ __('Country') }}" mfv-checks="required:true;">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxs-6 col-sm-12 col-md-6">
                        <label for="website" class="col-form-label text-md-right">{{ __('Website') }}</label>
                        <input id="website" name="website" type="text" pattern="^(https?:\/?\/)?[a-z-]+(\.[a-z-]+)+(|\/.*)$" class="form-control" value="{{ $users['website'] }}" placeholder="{{ __('Website URL') }}" mfv-checks="required:true;">
                    </div>
                    <div class="col-xxs-6 col-sm-6 col-md-3">
                        <label for="vatNumber" class="col-form-label text-md-right">{{ __('VAT Number') }}</label>
                        <input id="vatNumber" name="vatNumber" type="text" class="form-control" value="{{ $users['vatNumber'] }}" placeholder="{{ __('VAT Number') }}">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label for="email" class="col-form-label text-md-right">{{ __('Currency') }}</label>
                        <select class="form-control" name="currency" id="">
                                <option @if($users['currency'] == 'ˆ'  ) selected @endif value='ˆ'  >&euro;</option>
                                <option @if($users['currency'] == "$"  ) selected @endif value="$"  >$</option>
                                <option @if($users['currency'] == '?'  ) selected @endif value='?'  >&pound;</option>
                                <option @if($users['currency'] == "SEK") selected @endif value="SEK">{{ __('SEK') }}</option>
                                <option @if($users['currency'] == '?'  ) selected @endif value='?'  >&#8381;</option>
                                <option @if($users['currency'] == "NZ$") selected @endif value="NZ$">{{ __('NZ$') }}</option>
                         </select>
                    </div>
                    <div class="col-12">
                        <label for="description" class="col-form-label text-md-right">{{ __('Description') }}</label>
                        <textarea id="description" name="description" rows="5" type="text" class="form-control" placeholder="{{ __('Description') }}">{{ $users['description'] }}</textarea>
                    </div>
                    <div class="col-xxs-6 col-sm-6">
                        <label for="specialism" class="col-form-label text-md-right">{{ __('Specialism') }}</label>
                        <input id="specialism" name="specialism" type="text" class="form-control" value="{{ $users['specialism']}}" placeholder="{{ __('Specialism') }}">
                    </div>
                   <div class="col-xxs-6 col-sm-6">
                        <label for="weSpeak" class="col-form-label text-md-right">{{ __('We speak') }}</label>
                        <input id="weSpeak" name="weSpeak" type="text" class="form-control" value="{{ $users['weSpeak']}}" placeholder="{{ __('We speak') }}">
                    </div>
                   <div class="col-sm-12 col-md-4">
                        <label for="twitter" class="col-form-label text-md-right">{{ __('Twitter') }}</label>
                        <input id="twitter" name="twitter" type="text" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" class="form-control" value="{{ $users['twitter']}}" placeholder="{{ __('Twitter URL') }}">
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="facebook" class="col-form-label text-md-right">{{ __('Facebook') }}</label>
                        <input id="facebook" name="facebook" type="text" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" class="form-control" value="{{ $users['facebook']}}" placeholder="{{ __('Facebook URL') }}">
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <label for="instagram" class="col-form-label text-md-right">{{ __('Instagram') }}</label>
                        <input id="instagram" name="instagram" type="text" pattern="^(https?:\/?\/)?[0-9a-z-]+(\.[0-9a-z-]+)+(|\/.*)$" class="form-control" value="{{ $users['instagram']}}" placeholder="{{ __('Instagram URL') }}">
                    </div>
                </div>
                <button type="submit" id="submitFirstButton"  style="visibility: hidden;" mfv-action="cars.editProfile()"></button>
            </form>
            <div style = "display:flex; justify-content: space-between">
                <button class="btn btn-danger" id = "removeBtn"  style="width: 100px; float: right;" >{{ __('Remove') }}</button>
                <button type="submit" class="btn btn-success"  style="width: 100px; float: right;"  onClick="$('#submitFirstButton').click();">{{ __('Save') }}</button>
            </div>
        </div>
    </div>
@stop