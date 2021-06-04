
@if($type == 'private')
<div class="col-lg-4">
    <div class="card mb-5 mb-lg-0">
        <div class="card-body">
            <h5 class="card-title text-muted text-uppercase text-center">{{$pack['name']}}</h5>
            <h6 class="card-price text-center">€{{$pack['value']}}<span class="period"></span></h6>
            <hr>
            <ul class="fa-ul">
                <li><span class="fa-li"><i class="fas fa-check"></i></span>{{ __('One advert') }}</li>
                <li><span class="fa-li"><i class="fas fa-check"></i></span>{{$pack['period']}} months</li>
            </ul>
            <a href="{{action('PaymentsController@packageConfirm',['type' => 'private','packID' => $packID])}}" class="btn btn-block btn-primary text-uppercase">{{ __('Purchase') }}</a>
        </div>
    </div>
</div>
    @elseif($type == 'company')
    <!-- Free Tier -->
    <div class="col-lg-2-xl">
        <div class="card mb-5 mb-lg-0">
            <div class="card-body">
                <h5 class="card-title text-muted text-uppercase text-center">{{$pack['name']}}</h5>
                <h6 class="card-price text-center">€{{$pack['value']}}</h6>
                <hr>
                <ul class="fa-ul">
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>{{$pack['period']}} months</li>
                    <li><span class="fa-li"><i class="fas fa-check"></i></span>{{$pack['adverts']}} adverts</li>
                </ul>
                <a href="{{action('PaymentsController@packageConfirm',['type' => 'company','packID' => $packID])}}" class="btn btn-block btn-primary text-uppercase">{{ __('Purchase') }}</a>
            </div>
        </div>
    </div>
@endif