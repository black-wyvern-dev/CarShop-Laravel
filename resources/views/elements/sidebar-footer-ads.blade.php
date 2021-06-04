<div id="sidebar" class="col-lg-3 sidebar-right last extendright bg-darker" style = "margin-top : 65px; margin-bottom:98px; margin-left:0px">

    <!--- Banner Code --->
    <div class="banners" style="width : 100% !important; ">
    {{-- Maximum 10 banners --}}
    @php
        $browser  = new \hisorange\BrowserDetect\Parser();
        $browser  = $browser->detect();
        $max      = $browser->isMobile() ? 15 : ($browser->isTablet() ? 13 : 11);
        $count    =  0;
        $adsCount = 0;
        /** @var \Illuminate\Support\Collection $banners */
    @endphp
	
    @php
	    $googleads = 0;
    @endphp

    @foreach(array_slice($banners->all(), 0, ceil($max / 2)) as $banner)
        @php
            $banner_img_path = asset('uploads/banners').'/'.$banner->image;
            $banner_link_path = $banner->link;
        @endphp
        <div>
            <a href="{{$banner_link_path}}" target="_blank">
                <img  src="{{$banner_img_path}}" style ="width:100%">
            </a>
        </div>
        @php
            $count += 1;
        @endphp

        @if($count < $max && $googleads < 2)
            <div>
                @include('elements.google-ad', ['index' => $adsCount++])
            </div>
            @php
		        $googleads += 1;
                $count += 1;
            @endphp
        @endif
    @endforeach
    <!--- End of Banner --->

    @for($i = count($banners); $i < ceil(($max - $count) / 2); ++$i)
        <div>
        @include('elements.google-ad', ['index' => $adsCount++])
        </div>
    @endfor
    </div>
</div>
<!-- End of sidebar -->
</div>

<div id="footer-ads" class="row">
</div>