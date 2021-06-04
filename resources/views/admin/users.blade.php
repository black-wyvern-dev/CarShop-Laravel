@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<style>
    #usersTable tr td{
        height : 30px;
        padding : 0px;
        white-space: nowrap;
    }

    #usersTable tr th {
        text-transform : capitalize;
        white-space: nowrap;
    }

    
    #usersTable tr th.sorting_asc:after {
        color : orange;
        opacity : 1;
    }
    #usersTable tr th.sorting_asc:before {
        color : orange;
        opacity : 1;
    }
    #usersTable tr th.sorting_asc:after {
        color : orange;
        opacity : 1;
    }
    #usersTable tr th.sorting_asc:before {
        color : orange;
        opacity : 1;
    }

    #usersTable tr th:after {
        color : orange;
        opacity : 0.6;
    }
    #usersTable tr th:before {
        color : orange;
        opacity : 0.6;
    }
    .custom-select.custom-select-sm.form-control.form-control-sm {
        border-color : orange;
    }
</style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script>
        $(function(){
            $('#usersTable').DataTable({
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    },
                },
                "fnDrawCallback": function() {
                    $('.row-4-type').change(function() {
                        $.ajax({
                            url:'{{route('admin-change-user-type')}}',
                            type:'POST',
                            dataType: "json",
                            data: {
                                id : $(this).attr('data-id'),
                                type : $(this).val()
                            },
                            success:function(data){
                                if(data.status == 1){
                                    swal({
                                        html: 'Successfully changed',
                                        width: 300,
                                        padding: 20,
                                    })
                                }
                                else if(data.status == 0) {
                                    swal({
                                        html: 'Successfully changed',
                                        width: 300,
                                        padding: 20,
                                    })
                                }
                            },
                            error : function (data) {
                                swal({
                                    html: 'Something wrong on server!',
                                    width: 300,
                                    padding: 20,
                                })
                            }
                        });
                    });
                },
                "pageLength": 50,
                "width" : "1px",
            });
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $('.row-4-type').change(function() {
                $.ajax({
                    url:'{{route('admin-change-user-type')}}',
                    type:'POST',
                    dataType: "json",
                    data: {
                        id : $(this).attr('data-id'),
                        type : $(this).val()
                    },
                    success:function(data){
                        if(data.status == 1){
                            swal({
                                html: 'Successfully changed',
                                width: 300,
                                padding: 20,
                            })
                        }
                        else if(data.status == 0) {
                            swal({
                                html: 'Successfully changed',
                                width: 300,
                                padding: 20,
                            })
                        }
                    },
                    error : function (data) {
                        swal({
                            html: 'Something wrong on server!',
                            width: 300,
                            padding: 20,
                        })
                    }
                });
            });

        });
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
                        <div class="card ">
                            <div class="card-header">
                                <h4 class="card-title"> {{ __('Users Table') }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ps" style= "width : fit-content">
                                    <table class="table tablesorter " id="usersTable" style= "width : 1px">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Created</th>
                                                <th>Login</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr style = "height : 15px !important">
                                                <td>
                                                    {{$loop->index + 1}}
                                                </td>

                                                <td>
                                                    {{$user['businessName']}} &nbsp;&nbsp;
                                                </td>
                                                <!-- <td>
                                                    {{$user['businessName']}} &nbsp; :: &nbsp;&nbsp;  {{$user['firstName'] . ' ' . $user['lastName']}}
                                                </td> -->
                                                <!-- <td>
                                                    Business : {{$user['businessName']}}<br>
                                                    UserName : {{$user['firstName'] . ' ' . $user['lastName']}}
                                                </td> -->

                                                <td>
                                                    {{$user['email']}}
                                                </td>

                                                <td style="padding-right : 30px">
                                                    <select class="form-control row-4-type" name="type" value = "{{$user['type']}}" style = "width : 60px; height : 30px" data-id="{{$user['userID']}}">
                                                        <option value="1" {{$user['type'] == 1 ? 'selected' : ''}}>
                                                            1
                                                        </option>
                                                        <option value="2" {{$user['type'] == 2 ? 'selected' : ''}}>
                                                            2
                                                        </option>
                                                        <option value="0" {{$user['type'] == 0 ? 'selected' : ''}}>
                                                            0
                                                        </option>
                                                    </select>
                                                </td>

                                                <td>
                                                    {{ $user['created_at'] ? date('Y:m:d', strtotime($user['created_at'])) : "2020:01:01"}}
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{action('AdminController@loginAs', ['userID' => $user['userID']])}}" style = "color:orange">{{ __('Login') }}</a>
                                                    <!-- <a href="{{action('AdminController@editUsers',['userID' => $user['userID']])}}" class="btn-info btn-sm btn">{{ __('Edit') }}</a> -->
                                                    <!-- <a href="{{action('AdminController@deleteUsers',['userID' => $user['userID']])}}" class="btn-danger btn-sm btn" onclick=" return confirm('Are you sure want to delete record?');">{{ __('Delete') }}</a> -->
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

