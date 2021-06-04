{{--
  - Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
  - Unauthorized copying of this file, via any medium is strictly prohibited.
  - Proprietary and confidential.
 --}}
                        <div class="col-xs-5 col-sm-7 col-md-2 dealer-location">
                            <div class="dealer-location-label">
                                <div class="inner">
                                    @if(!isset($no_pin) || !$no_pin)
                                    <i class="fas fa-map-marker-alt"></i>
                                    @endif
                                    @if('' != $specialist['street'] || '' != $specialist['street2'] || '' != $specialist['town'] || '' != $specialist['country'])
                                        <span class="heading-font">
                                            {{ $specialist['street'] }}@if('' != $specialist['street'])<br />@endif
                                            {{ $specialist['street2'] }}@if('' != $specialist['street2'])<br />@endif
                                            @if('' != $specialist['country']  && in_array($specialist['country'], ['United Kingdom', 'United States']))
                                                {{ $specialist['town'] }}@if('' != $specialist['town'] && '' != $specialist['postCode'] && in_array($specialist['country'], ['United Kingdom']))<br />@endif
                                                {{ $specialist['postCode'] }}
                                            @else
                                                {{ $specialist['postCode'] }}
                                                {{ $specialist['town'] }}
                                            @endif
                                            @if('' != $specialist['country'])
                                                <br />
                                                {{ preg_replace('/\s+\(.*\)\s*$/', '', $specialist['country']) }}
                                            @endif
                                        </span>
                                    @else
                                        Unknown
                                    @endif
                                </div>
                            </div>
                        </div>
