@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/pages/cars.css')}}">
    <link rel="stylesheet" href="{{asset('css/selectize.css')}}">
    <link rel="stylesheet" href="{{asset('css/stm-icons.css')}}">
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.3.2/tinymce.min.js"></script>
    <script src="{{asset('js/jquery-sortable.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
    <script src="{{asset('js/microevent.js')}}"></script>
    <script>
        $(function() {
            $.ajaxPrefilter(function (options, originalOptions, xhr) {
                var token = '{{ csrf_token() }}';
                if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            });
            tinymce.init({
                selector:'#addCarForm textarea[name="description"]',
                images_upload_url: {!! json_encode(route('admin.pages.upload'), JSON_UNESCAPED_SLASHES) !!},
                images_reuse_filename: true,
                images_upload_credentials: true,
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'table emoticons template paste help'
                ],
                toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image | print preview media fullpage | ' +
                    'forecolor backcolor emoticons | help',
                /** Image upload handler partially copied from 5.4.1 tinymce.js */
                images_upload_handler: function (blobInfo, success, failure, progress) {
                    var token = {!! json_encode(csrf_token()) !!};
                    var xhr   = new XMLHttpRequest();
                    var url   = {!! json_encode(route('admin.pages.upload'), JSON_UNESCAPED_SLASHES) !!};
                    xhr.open('POST', url);
                    xhr.setRequestHeader('X-CSRF-Token', token);
                    xhr.withCredentials = true;
                    xhr.upload.onprogress = function (e) {
                        progress(e.loaded / e.total * 100);
                    };
                    xhr.onerror = function () {
                        failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                    };
                    xhr.onload = function () {
                        if (xhr.status < 200 || xhr.status >= 300) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }
                        var json = JSON.parse(xhr.responseText);
                        if (!json || typeof json.location !== 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        success(json.location);
                    };
                    var formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    xhr.send(formData);
                },
            });
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

            editPage: function(){

                values = $('#addCarForm').serializeArray();
                $.ajax({
                    url:'editPage',
                    type:'POST',
                    data: values,
                    success:function(data){
                     mfValid.launchSuccessMessage('#addCarForm', 'Success! Your record has been updated!');
                     window.location.href = '../../pages';
                    },
                    error: function(data){
                        var errors = 'Failed to create or update page';
                        if (data.errors) {
                            errors = data.errors;
                        } else if (data.responseJSON) {
                            errors = data.responseJSON.message;
                        } else if (data.responseText) {
                            errors = data.responseText;
                        }
                        mfValid.launchCustomError('#addCarForm', errors);
                    }
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
                        <div class="card">
                            <div class="card-header">
                                <div class="back">
                                    <a href="{{ route('admin.pages') }}" onclick="return confirm('Are you sure you want to leave this page?')">&lt;&lt;</a>
                                </div>
                                <h3>{{ __('Edit Page') }}</h3>
                                @if(!$new)
                                <div class="preview">
                                    <a href="{{ route('pages', ['name' => $pages['name']]) }}" target="_blank">{{ __('Preview') }}</a>
                                </div>
                                @endif
            <form id="addCarForm" role="form" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input class="hiddenBtn" name="id" value="{{ $new ? 'new' : $pages->id }}">

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="mfv-errorBox"></div></div>

                    <div class="form-group importantFields row">
                        <div class="col-md-3">
                            <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                            <input name="name" type="text" class="form-control" value="{{ $pages->name }}" mfv-placeholder="{{ __('Name') }}" minlength="3" placeholder="{{ __('Name with only letters, digits or dash...') }}">
                        </div>

                        <div class="col-md-3">
                            <label for="title" class="col-form-label text-md-right">{{ __('Title') }}</label>
                            <input name="title" type="text" class="form-control" value="{{ $pages->title }}" mfv-placeholder="{{ __('Title') }}" placeholder="{{ __('Title of the page...') }}">
                        </div>

                        <div class="col-md-3">
                            <label for="email" class="col-form-label text-md-right">{{ __('Order') }}</label>
                                <select class="form-control" name="sequence" id="">
                                    @php($max = \App\Pages::max('id'))
                                    @for($i = 1; $i <= $max; ++$i)
                                    <option @if($pages['sequence']== $i)selected @endif value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                    @if($new)
                                    <option selected value="{{ 1 + $max }}">{{ __('last') }}</option>
                                    @endif
                                </select>
                        </div>

                        <div class="col-md-3">
                            <label for="enabled" class="col-form-label text-md-right">{{ __('Enabled') }}</label>
                            <input name="enabled" type="checkbox" class="form-control" value="1" mfv-placeholder="{{ __('Enabled') }}" @if($pages->enabled) checked="checked" @endif>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="modelType" class="col-form-label text-md-right">{{ __('Description') }}</label>
                        <textarea class="form-control" id="description" mfv-placeholder="{{ __('Description') }}" name="description" cols="800" rows="25" placeholder="{{ __('Content of the page...') }}">{!! strip_tags($pages->description) === $pages->description ? nl2br($pages->description) : $pages->description !!}</textarea>
                    </div>

                </div>
                <button type="submit" id="submitFirstButton" class="hiddenBtn" mfv-action="cars.editPage()"></button>
            </form>
            <button type="submit" class="btn pull-right btn-success" onClick="$('#submitFirstButton').click();">
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
                        </script> {{ __('Classic Cars') }} <i class="tim-icons icon-heart-2"></i>
                    </div>
                </div>
            </footer>
    </div>
@stop
