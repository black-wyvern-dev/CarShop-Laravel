@php
    $images = ['/img/1-145-1199x799.jpg','/img/big_IMG_6377-1109x739.jpg','/img/Victor-9229-August-22-2018-13.26-968x662.jpg'];
@endphp
<div class="col-xl-3 col-md-6 mb-4 itemListing">
    <div class="card border-0 shadow bg-dark">
        <a href="{{action('ListingsController@listing',['id'=>$listing['listingID'], 'category'=>$listing['type'], 'make' => $listing['make'], 'model' => $listing['model']])}}">
            <img  src="{{Helper::getListingMainImage($listing['listingPhotos'])}}" class="card-img-top" alt="..."></a>
        <div class="card-body text-white">

            <div class="line">
                <h5 class="card-title mb-0 left">
                    <a style="text-decoration: none;color:#fff;" href="{{action('ListingsController@listing',['id'=>$listing['listingID'], 'category'=>$listing['type'], 'make' => $listing['make'], 'model' => $listing['model']])}}">
                        {{Helper::formatItemName($listing['make'])}} {{Helper::formatItemName($listing['model'])}}
                    </a>
                </h5>
                <div class="badge-pill bg-success right">@if($listing['price']) {{$listing['user']['currency']}} {{$listing['price']}} @else @endif</div>
            </div>

            <div class="specs">
                <div class="line">
                    <span><a style="text-decoration: none;color:#fff;" href="{{action('ListingsController@editListing', ['id' => $listing['listingID']])}}"><i class="fa fa-edit"></i> {{ __('Edit') }}</a></span>  
                     <span><a style="text-decoration: none;color:#fff;" href="{{action('ListingsController@deleteListing', ['id' => $listing['listingID']])}}" onclick=" return confirm('Are you sure want to delete record?');"><i class="fa fa-edit"></i> {{ __('Delete') }}</a></span>

                </div>
            </div>

        </div>
    </div>
</div>
