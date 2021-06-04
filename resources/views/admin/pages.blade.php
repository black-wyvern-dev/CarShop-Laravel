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

    <div class="wrapper pages">
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
            <div class="content ">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> {{ __('Pages Table') }}</h4>
                                <div class="button create">
                                    <a href="{{ route('admin.pages.edit', ['id' => 'new']) }}" class="btn btn-primary">{{ __('create') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive ps">
                                    <table class="table tablesorter" id="usersTable">
                                        <thead class="text-primary">
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Description
                                            </th>
                                            <th>
                                                Order
                                            </th>
                                            <th>
                                                Enabled
                                            </th>
                                            <th class="text-center">
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pages as $page)
                                            <tr>
                                                <td valign="top">
                                                    <a href="{{ route('pages', ['name' => $page['name']]) }}" target="_blank">{{$page['name']}}</a>
                                                </td>
                                                <td valign="top">
                                                    <a href="{{ route('pages', ['name' => $page['name']]) }}" target="_blank">{{$page['title']}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages', ['name' => $page['name']]) }}" target="_blank">
                                                    @php
                                                        $content = preg_replace('/(\s|\r|\n)+/', ' ', strip_tags($page['description']));
                                                        if (480 < strlen($content)) {
                                                            $content = substr($content, 0, 477) . '...';
                                                        }
                                                    @endphp
                                                        {{ $content }}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages', ['name' => $page['name']]) }}" target="_blank">
                                                        {{$page['sequence']}}</a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('pages', ['name' => $page['name']]) }}" target="_blank">
                                                        {{$page['enabled'] ? 'yes' : 'no'}}</a>
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{action('AdminController@editPage',['pageID' => $page['id']])}}" class="btn-info btn-sm btn">{{ __('Edit') }}</a>
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

