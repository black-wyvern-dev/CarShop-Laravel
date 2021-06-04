{{--
  - Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
  - Unauthorized copying of this file, via any medium is strictly prohibited.
  - Proprietary and confidential.
 --}}
@php
    $postfix = $postfix ?? 't';
@endphp
    <div class="phone heading-font">
@if($specialist['phoneNumber'])
        <span id="phoneNumber-{{$specialist['userID']}}-{{ $postfix }}">
@php
    $phoneNumber = preg_replace('/[^+0-9]+/', '', $specialist['phoneNumber']);
    if ('+' === substr($phoneNumber, 0, 1)) {
        $countryCode = substr($phoneNumber, 1, 2);
    } elseif ('00' === substr($phoneNumber, 0, 2)) {
        $countryCode = substr($phoneNumber, 2, 2);
    } else {
        $countryCode = '';
    }

    if ($countryCode) {
        $countryCodeFirst = substr($countryCode, 0, 1);
        if ('1' === $countryCodeFirst || '7' === $countryCodeFirst) {
            $countryCode = $countryCodeFirst;
        }
        $countryCode = '+' . $countryCode;
    } else {
        $countryCode = substr($phoneNumber, 0, 2);
    }
@endphp
            {{ $countryCode }}*******
        </span>
    </div>
    <div id="showNumber-{{$specialist['userID']}}-{{ $postfix }}"
            onclick="specialists.showNumber('{{$specialist['userID']}}-{{ $postfix }}')"
            data-id="{{$specialist['userID']}}-{{ $postfix }}"
            class="stm-show-number" style="cursor: pointer">
            Show number
@else
            Unknown
@endif
    </div>
