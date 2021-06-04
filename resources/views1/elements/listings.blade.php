{{--
  - Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
  - Unauthorized copying of this file, via any medium is strictly prohibited.
  - Proprietary and confidential.
 --}}
    @if($listings && !$listings->isEmpty())
        <div class="listings">
            @php($listings->onEachSide(1))
            <div class="row">
                {{ $listings->links('elements.pager') }}
            </div>
            <div class="row listing-list">
            @foreach($listings as $listing)
                <div class="itemListing">
                    @include('elements.listing-box') {{-- , $listing)  --}}
                </div>
            @endforeach
            </div>
            <div class="row">
                {{ $listings->links('elements.pager') }}
            </div>
        </div>
    @else
        <div>
            <h5>{{ __('Looks like there are no listings here yet.') }}</h5>
        </div>
    @endif
