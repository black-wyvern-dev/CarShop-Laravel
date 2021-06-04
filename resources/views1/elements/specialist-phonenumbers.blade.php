{{--
  - Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
  - Unauthorized copying of this file, via any medium is strictly prohibited.
  - Proprietary and confidential.
 --}}
@if('' == $specialist['mobileNumber'] || '' != $specialist['phoneNumber'])
    <!-- @include('elements.specialist-phonenumber') -->
    <a href="tel:{{$specialist->phoneNumber}}" style="color : orange">{{$specialist->phoneNumber}}</a>
@endif

@if('' != $specialist['mobileNumber'])
    @php
        $__savePhoneNumber = $specialist->phoneNumber;
        try {
            $specialist->phoneNumber = $specialist->mobileNumber;
    @endphp
            <!-- @include('elements.specialist-phonenumber', ['postfix' => 'm', 'specialist' => $specialist->toArray()]) -->
            <a href="tel:{{$specialist->mobileNumber}}" style="color : orange">{{$specialist->mobileNumber}}</a>
    @php
        } finally {
            $specialist->phoneNumber = $__savePhoneNumber;
        }
    @endphp
@endif
