@section('scripts')
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset('css/ads.css')}}">
@endsection

@php
    $adUnitSlots = [
        2550981535,
        9457695883,
        9192960249,
        9684200247,
        6866465214,
        5361811854,
        3857158497,
        6100178459,
        3090871739,
        1147234677,
        6207989666,
    ];

    $index        = $index      ?? 0;
    $width        = "100%";
    $height       = $height     ?? 250;
    $responsive   = true;
    $index        = $responsive  ? 0 : (1 + ($index % (count($adUnitSlots) - 1)));
    $maxWidth     = $maxWidth   ?? null;
    $maxHeight    = $maxHeight  ?? null;
@endphp

<!-- Ad: {{ $index }}, responsive: {{ var_export($responsive, 1) }} -->
<div id="google-ad-{{ $index }}" class="ads ads_after" style = "width : 100% !important">
    @if(App::environment('local'))
        <img class="placeholder" style="z-index:3;" src="https://via.placeholder.com/{!! urlencode($width) !!}x{!! urlencode($height) !!}?text=Google+Ad+{!! urlencode($index ?: 'Responsive') !!}">
        <img style="position:absolute; z-index:2;" src="http://picsum.photos/{!! urlencode($width) !!}/{!! urlencode($height) !!}?{!! random_int(1, PHP_INT_MAX) !!}">
        <script>
            var resizeAds = [];
            resizeAds[{!! json_encode($index) !!}] = function () {
                var $ad  = $('#google-ad-{{ $index }}');
                var $img = $ad.find('>img');
                $img.width($img.parent().width());
            };
            $(document).ready(function() {
                resizeAds[{!! json_encode($index) !!}]();
            });
            $(window).resize(resizeAds[{!! json_encode($index) !!}]);
        </script>
    @endif
    <ins class="adsbygoogle"
            @if($responsive)
            style="display:block; width:100%; @if($maxHeight) max-height: {{ $maxHeight }}px; @endif "
            data-ad-format="auto"
            data-full-width-responsive="true"
            @else
            style="display:inline-block;width:100%;height:{{ $height }}px"
            @endif
            @if(!app()->environment('production'))
            data-adtest = 'on'
            @endif
            data-ad-slot="{{ $adUnitSlots[$index] }}"
            data-ad-client="ca-pub-4193431005629062"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>                        <!-- Sidebar 1 -->
</div>
