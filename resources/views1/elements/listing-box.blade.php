<div class="card border-0 shadow bg-dark">
    <a href="{{action('ListingsController@listing',['id'=>$listing['listingID'], 'category'=>$listing['type'], 'make' => $listing['make'], 'model' => str_replace('/','',$listing['model'])])}}">
        <img  src="{{Helper::getListingMainImage($listing['listingPhotos'])}}"  class="rounded mx-auto d-block" class="card-img-top" alt="..." style="width:265px;height:168px"></a>
    <div class="card-body text-white" style="border: 0px solid red;">
        <div class="line">
            <h6 class="card-title mb-0 left" style="width: 100%; font-size: 14px;">
                <span class="name">
                @php
                    $product_full_name = '';
                    if($listing['year'])
                        $product_full_name = Helper::formatItemName($listing['year']);
                    if($listing['make'])
                        $product_full_name .= " ".str_replace(" ","-",ucwords(Helper::formatItemName($listing['make'],' ')));
                    if($listing['model'])
                        $product_full_name .= " ".ucwords(Helper::formatItemName($listing['model']));
                    if($listing['modelType'])
                        $product_full_name .= " ".Helper::formatItemName($listing['modelType']);
                    if(strlen($product_full_name)>32)
                    {
                        $product_full_name = substr($product_full_name, 0,32);
                        $product_full_name .='.';
                    }
                @endphp
                {{ $product_full_name }}
                </span>
                @if($listing['user']['country'])
                <div class="badge-pill right">
                    <img class="transmission-icon" src="{{Helper::getCountryFlag($listing['user']['country'])}}" style="width:17px"></div>
                @endif
            </h6>
        </div>

        <div class="line">
            <h6 class="card-title mb-0 left" style="width: 100%; font-size: 14px; padding-top: 8px">
                @if($listing['odometer']){{$listing['odometer']}}&nbsp;@endif
                @if($listing['engine'])<img class="transmission-icon" src="{{asset('img/engine.png')}}" style="width:17px">&nbsp; &nbsp;{{$listing['engine']}} @endif
                @if($listing['transmission'])&nbsp;<img class="transmission-icon" src="{{asset('img/transmission.png')}}" style="width:17px">&nbsp;&nbsp;{{$listing['transmission']}} @endif
                </a>
            </h6>
        </div>

        <div class="line">
            <h6 class="card-title mb-0 left" style="font-size: 14px; padding-top: 8px">
                <span class="business name">
                @php
                    $product_full_vendor_name = $listing['user']['businessName'];
                    if(strlen($listing['user']['businessName'])>27)
                    {
                        $product_full_vendor_name = substr($listing['user']['businessName'], 0,27);
                        $product_full_vendor_name .='.';
                    }
                @endphp
                {{ $product_full_vendor_name }}
                </span>

                @if($listing['price'])
                    <!-- <div class="price badge-pill bg-success right">{{$listing['user']['currency']}} {{$listing['price']}}</div> -->
                    @php
                        $symbol = $listing['user']['currency'];
                    @endphp


                    <div class="price badge-pill bg-success right">
                        
                        {{$listing['user']['currency']}} {{$listing['price']}}
                    </div>
                @endif
            </h6>
        </div>
    </div>
</div>
