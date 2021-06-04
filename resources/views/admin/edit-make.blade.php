@extends('layouts.admin')

@section('styles')
@endsection

@section('scripts')
    <script>
        $(function(){
            mfValid.init('#editMakeForm');
            mfValid.init('#addModelForm');
            $('#makeTable').DataTable({
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    },
                },
            });

        });
        make= {

            editMake:function () {
                values = $('#editMakeForm').serializeArray();
                $.ajax({
                    url:'editMake',
                    type:'POST',
                    data: values,
                    success:function(data){
                         window.location.href = '../../makes';
                    },
                });
            },
            addModel:function () {
                values = $('#addModelForm').serializeArray();
                $.ajax({
                    url:'addModel',
                    type:'POST',
                    data: values,
                    success:function(data){
                        mfValid.launchSuccessMessage('#addModelForm', 'Success! Your model has been created!');
                    },
                });
            },
            getModel:function (id, makeid) {
                //alert('href', makeid+'/delete/model/'+id);
                //return false;
                $('#deleteHardHref').attr('href', makeid+'/delete/model/'+id);
            }

        }
    </script>
@endsection

@section('content')
    <style>
        #editMakeForm, #addModelForm{
            background-color: #343a40!important;
            color: #ffff;
            font-size: 18px;
            margin: 5px;
            margin-bottom: 20px;
            padding: 40px;
        }
        .modal-footer{
            -webkit-justify-content: baseline!important;
            justify-content: baseline!important;
        }
    </style>
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
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="card-title"><a href="{{action('AdminController@makes')}}"><i class="fa fa-angle-left" style="font-size: 19px;" aria-hidden="true"></i></a>  <span>{{ __('Edit make ":make"', ['make' => $make['name']]) }}</span></h4>
                                    </div>
                                    <div class="col-6">
                                        <h4 class="card-title">{{ __('Models table') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <form id="editMakeForm" role="form" autocomplete="off">
                                            @csrf
                                            <div class="mfv-errorBox"></div>
                                            <div class="form-group">
                                                <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                                                <input id="name" type="text" class="form-control" value="{{$make['name']}}" name="name" mfv-placeholder="{{ __('Name') }}"  mfv-checks="required:true;max:64">
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="slug" class="col-form-label text-md-right">{{ __('Slug') }}</label>
                                                <input id="slug" type="text" class="form-control" value="{{$make['slug']}}" name="slug" mfv-placeholder="{{ __('Slug') }}"  mfv-checks="required:true;max:64">
                                            </div> -->
                                            <input type="hidden" name="term_slug" value="{{$make['slug']}}">


                                            <button type="submit" class="btn pull-right btn-success" mfv-action="make.editMake()">{{ __('Edit make') }}</button>
                                            <div class="clearfix"></div>
                                        </form>
                                        <h4 class="card-title">{{ __('Add model') }}</h4>
                                        <form id="addModelForm" role="form" autocomplete="off">
                                            @csrf
                                            <input hidden="true" value="{{$make['slug']}}" name="make">
                                            <div class="mfv-errorBox"></div>
                                            <div class="form-group">
                                                <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                                                <input id="name" type="text" class="form-control" name="name" mfv-placeholder="{{ __('Name') }}"  mfv-checks="required:true;max:64">
                                            </div>
                                            <div class="form-group">
                                                <label for="slug" class="col-form-label text-md-right">{{ __('Slug') }}</label>
                                                <input id="slug" type="text" class="form-control" name="slug" mfv-placeholder="{{ __('Slug') }}"  mfv-checks="required:true;max:64">
                                            </div>
                                            <button type="submit" class="btn pull-right btn-success" mfv-action="make.addModel()">{{ __('Add model') }}</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <div class="table-responsive ps">
                                            <table class="table tablesorter " id="makeTable">
                                                <thead class="text-primary">
                                                <tr>
                                                    <th>
                                                        Name
                                                    </th>
                                                    <th class="text-center">
                                                        Actions
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($models as $model)
                                                    <tr>
                                                        <td>
                                                            {{$model->name}}
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{action('AdminController@editMake', ['termID' => $model->termID])}}" class="btn-info btn-sm btn">{{ __('Edit Model') }}</a>
                                                            <button class="btn-danger btn-sm btn" onclick="make.getModel({{$model->termID}},{{$make['termID']}})" data-toggle="modal" data-target="#deleteModal">{{ __('Delete') }}</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
        <!-- Delete Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" id="deleteModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> {{ __('Are you sure?') }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body deleteBody">
                    </div>
                    <div class="modal-footer">
                        <a id="deleteHardHref" class="btn-danger btn pull-right">  {{ __('Delete') }}</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


@stop

