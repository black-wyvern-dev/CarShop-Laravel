@extends('layouts.admin')

@section('styles')
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#usersTable').DataTable({
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    },
                },
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{ __('Banner Table') }}</h4>
                                <a class="btn btn-success" href="{{action('AdminController@addBanner')}}">{{ __('Add new banner') }}</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ps">
                                    <table class="table tablesorter " id="usersTable">
                                        <thead class="text-primary">
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Image
                                            </th>
                                            <th>
                                                Link
                                            </th>
                                            <th>
                                                Page
                                            </th>
                                            <th>
                                                Created at
                                            </th>
                                            <th class="text-center">
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($banners as $banner)
                                            <tr>
                                                <td>
                                                    {{$banner['name']}}
                                                </td>
                                                <td>
                                                    <img style="width: 100px;" src="{{asset('uploads/banners/'.$banner['image'])}}" alt="{{$banner['name']}}">
                                                </td>
                                                <td>
                                                    {{$banner['link']}}
                                                </td>
                                                <td>
                                                   @if($banner['page'] == 1) Cars page @else Home page @endif
                                                </td>
                                                <td>
                                                    {{$banner['created_at']}}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{action('AdminController@editBanner', ['bannerID' => $banner['bannerID']])}}" class="btn-info btn-sm btn">{{ __('Edit') }}</a>
                                                     <a href="{{action('AdminController@deleteBanners',['bannerID' => $banner['bannerID']])}}" class="btn-danger btn-sm btn" onclick=" return confirm('Are you sure want to delete record?');">{{ __('Delete') }}</a>
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
    </div>
@stop

