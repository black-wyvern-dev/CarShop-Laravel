@extends('layouts.generic')

@section('styles')
@endsection

@section('scripts')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{asset('js/dataTables.bootstrap4.min.js')}}"></script>

<script type = "text/javascript">
    $(function(){
        $('#listingsTable').DataTable({
            oLanguage: {
                oPaginate: {
                    sNext: '<span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                    sPrevious: '<span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                },
            },
            "aoColumns": [
                { "bSortable": false },
                { "bSortable": true },
                { "bSortable": true },
                { "bSortable": true },
                { "bSortable": true },
                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": false },
                { "bSortable": true }
            ],
            "order": [[ 2, "asc" ]],

            columnDefs: [
                {
                    targets: [ 2 ],
                    orderData: [ 2,3,4 ]
                }, 
                {
                    targets: [ 3 ],
                    orderData: [ 2, 3, 4 ]
                }, 
                {
                    targets: [ 4 ],
                    orderData: [ 2, 3, 4 ]
                } 
            ],

            "pageLength": 50,
            "width" : "1px",
        });
    });
</script>
@endsection
@section('content')
    <script src="{{asset('js/pages/specialists.js')}}"></script>

    <style type="text/css">
        .dropdown-menu{color:#ccc !important;}
    </style>
    <div class="flex-center position-ref full-height container card paddedContainer bg-darker text-white">
        <div class="content">
             <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="background-color: #303133;">
                            <div class="card-header" style="border: 0px;">
                                <h4 class="card-title" style="border: 0px;">{{ __('my listings') }}</h4>
                            </div>

                            <div class="card-body" style="padding:0px;">
                                <div class="table-responsive ps" style="border: 0px;">
                                    <table class="table tablesorter " id="listingsTable" style="border: 0px;">
                                        <thead class="text-primary" style="border: 0px;">
                                        <tr style="color: #ccc;">
                                            <th class="text-center" >

                                            </th>
                                            <th class="text-center" style="padding-left: 0px;">
                                                year
                                            </th>
                                            <th class="text-left" style="padding-left: 0px;">
                                                make
                                            </th>
                                            <th class="text-left">
                                                model
                                            </th>
                                            <th class="text-left">
                                                model type
                                            </th>
                                            <th class="text-right">
                                                price
                                            </th>
                                            <th class="text-center">
                                                action
                                            </th>
                                            <th class="text-center">
                                                pump up
                                            </th>
                                            <th class="text-center">
                                                views
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody style="font-size : 14px">
                                        @foreach($listings as $listing)
                                            <tr>
                                                <td>
                                                    <img src="{{Helper::getListingMainImage($listing['listingPhotos'])}}" width="100" style = "width : 70px; height : 40px"/>
                                                </td>
                                                <td style="text-align: right; vertical-align: middle; padding-left: 0px">
                                                    {{Helper::formatItemName($listing['year'])}}
                                                </td>
                                                <td style="text-align: left; vertical-align: middle; padding-left: 0px">
                                                    {{Helper::formatItemName($listing['make'])}}
                                                </td>
                                                <td style="text-align: left; vertical-align: middle;">
                                                   {{Helper::formatItemName($listing['model'])}}
                                                </td>
                                                <td style="text-align: left; vertical-align: middle;">
                                                   {{Helper::formatItemName($listing['modelType'])}}
                                                </td> 
                                                <td style="text-align: right; vertical-align: middle;">
                                                    @if($listing['price']) {{$listing['user']['currency']}} {{$listing['price']}} @else @endif
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <a href="{{action('ListingsController@editListing', ['id' => $listing['listingID']])}}" class="fas fa-pencil-alt"></a> &nbsp;
                                                    <a href="{{action('ListingsController@deleteListing', ['id' => $listing['listingID']])}}" class=" fas fa-trash-alt" onclick=" return confirm('Are you sure want to delete record?');"></a>
                                                </td>
                                                <input type="hidden"  id="appUrl" value="{{url('')}}">
                                                <td style="text-align: center; vertical-align: middle;">
                                                    @if(Helper::formatItemName($listing['move_up'])==1)
                                                        @php
                                                            $car_created_date='';
                                                            $car_created_date = $listing['created_at'];
                                                        @endphp
                                                        <input type="hidden"  id="car_created_date_{{Helper::formatItemName($listing['listingID'])}}" value="{{$car_created_date}}">
                                                        <a href="javascript:;" onclick="fnSetPumpUp({{Helper::formatItemName($listing['listingID'])}},0);">
                                                            <img src="{{asset('img/pump_up.png')}}" alt="Move Up" style="margin : -40px;height: 60px;">
                                                        </a>
                                                    @else
                                                    <a href="javascript:;" onclick="fnSetPumpUp({{Helper::formatItemName($listing['listingID'])}},1);">
                                                        <div id="aPumpupLink_{{Helper::formatItemName($listing['listingID'])}}" style="display: block;">{{ __('Page 1') }}</div></a>
                                                    @endif
                                                </td>

                                                <td style="text-align: center; vertical-align: middle;">
                                                    {{Helper::formatItemName($listing['views'])}}
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

    <script type="text/javascript">
        function fnSetPumpUp(pid,moveup){
            created_at = $('#car_created_date_'+pid).val();
            $.ajax({
            type: "POST",
            url: $('#appUrl').val()+'/'+'setPumpUp',
            data: {pid:pid,move_up:moveup,created_at:created_at}
        }).done(function(data){
            location.reload(true);
        });

        }
    </script>
@stop

