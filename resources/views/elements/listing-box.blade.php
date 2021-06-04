<div class="card border-0 shadow bg-dark">
	@php
		$modalType = $listing['modelType'] ? $listing['modelType'] : 'A';
	@endphp
	<a href="{{action('ListingsController@listing',['id'=>$listing['listingID'], 'year' => $listing['year'], 'modelType'=>str_replace(' ','-',$modalType), 'category'=>$listing['type'], 'make' => $listing['make'], 'model' => str_replace('/','',$listing['model'])])}}">
        <style scoped>
            .imagecssfade { 
                height: 252px; 
                width: 400px;
	          background-size : 100% 100%;
            }
            .imagecssfade img {
                -webkit-transition: all ease 1s;
                -moz-transition: all ease 1s;
                -o-transition: all ease 1s;
                -ms-transition: all ease 1s;
                transition: all ease 1s;
            }
            .imagecssfade img:hover {
                opacity: 0;
            }
        </style>
        @php
            if ($listing['listingPhotos'] && count($listing['listingPhotos']) >= 2)
                $secondImage = asset('uploads/listings/photos/'.$listing['listingPhotos'][1]['name']);
            else
                $secondImage = "https://i.ibb.co/mBN3H5c/alt-Image-For-Advert.jpg";
        @endphp
        <div class = "imagecssfade" style="width:248px;height:168px; background-image: url({{$secondImage}});">
            <img  src="{{Helper::getListingMainImage($listing['listingPhotos'])}}"  class="rounded mx-auto d-block" class="card-img-top" alt="..." style="width:248px;height:168px">
        </div>
    </a>
    
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
                @endphp
                {{ $product_full_name }}
                </span>
            </h6>
        </div>

        <div class="line">
            <h6 class="card-title mb-0 left" style="width: 100%; font-size: 14px; padding-top: 8px">
                @if($listing['odometer']){{$listing['odometer']}} {{$listing['odometerType']}}&nbsp;@endif
                @if($listing['engine'])<img class="transmission-icon" src="{{asset('img/engine.png')}}" style="width:17px">&nbsp; &nbsp;{{$listing['engine']}} @endif
                @if($listing['transmission'])&nbsp;<img class="transmission-icon" src="{{asset('img/transmission.png')}}" style="width:17px">&nbsp;&nbsp;{{$listing['transmission']}} @endif
                </a>
            </h6>
        </div>

        <div class = "line" style="display: flex; margin-bottom: 0px; margin-top : 4px">
            @if($listing['price'])
                <div class="price badge-pill" style="padding : 0px">{{$listing['user']['currency']}} {{$listing['price']}}</div>
            @elseif($listing['customlabel'])
                <div class="price badge-pill" style="padding : 0px">{{$listing['customlabel']}}</div>
            @else
                <div class="price badge-pill" style="padding : 0px">Price on request</div>
            @endif
        </div>

        <div class="line" style="display: flex;">
            @if($listing['user']['country'])
                <div class="badge-pill" style="padding-left : 0px">
                <img class="transmission-icon" src="{{Helper::getCountryFlag($listing['user']['country'])}}" style="width:25px; margin-top: -2px"></div>
            @endif
            <h6 class="card-title mb-0 left" style="font-size: 14px; padding-top: 2px; display: flex; align-items:center; justify-content: space-between;">
                <span class="business name" style="font-size : 17px">
                @php
                    $product_full_vendor_name = $listing['user']['businessName'];
                    if(strlen($listing['user']['businessName'])>27)
                    {
                        $product_full_vendor_name = substr($listing['user']['businessName'], 0,27);
                        $product_full_vendor_name .='.';
                    }
                @endphp

                <a href="{{action('ListingsController@listing',['id'=>$listing['listingID'], 'year' => $listing['year'], 'modelType'=>str_replace(' ','-',$modalType), 'category'=>$listing['type'], 'make' => $listing['make'], 'model' => str_replace('/','',$listing['model'])])}}" style="color : white">
                {{ $product_full_vendor_name }}</a>
                </span>
            </h6>
        </div>
    </div>
</div>
