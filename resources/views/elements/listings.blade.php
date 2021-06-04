{{--
  - Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
  - Unauthorized copying of this file, via any medium is strictly prohibited.
  - Proprietary and confidential.
 --}}

<style>
    .head-toolkits {
        display : flex;
        justify-content : space-between;
        flex-wrap:wrap;
        width : 100%;
        align-items:center;
        padding : 0px 10px;
        margin-bottom:10px;
        margin-top:10px;
    }
    #wp-advanced-search label{
        margin-top: 10px;
    }
    @media only screen and (max-width: 768px) {
        #topPagination {
            display:none;
        }
        .head-toolkits {
            justify-content : center;
        }
    }
</style>

@if($listings && !$listings->isEmpty())
    <div class="listings">
        @php($listings->onEachSide(1))
        <div class = "head-toolkits">
            <div id="tdp_car_search-3" class="widget widget_tdp_car_search" style = 'width :235px ;'>
                <h3 class="widget-title" style = "margin:0px; background: #010101;"><span>{{ __('Search') }}</span></h3>
                <div class="search-form-widget" style = "background-image: url(https://www.classics.nl/img/formBg-inside.jpg); color:white">
                    <form id="wp-advanced-search" name="wp-advanced-search" role="form" autocomplete="off" class="wp-advanced-search" >
                        <div id="wpas-html-1" class="wpas-html-1 wpas-html-field  wpas-field"></div>
                        <div id="wpas-tax_car_location" class="wpas-tax_car_location wpas-generic-field  wpas-field">
                            <div ><label>{{ __('Country:') }}</label></div>
                            <select id="countrySelector" name="tax_car_location"   class="custom-select"  onchange="fnCountryChange(this)">
                                <option selected value="All">{{ __('All') }}</option>
                                @if($users_countries)
                                    @foreach($users_countries as $country)
                                    <option value="{{$country->userCountry}}">{{strtok($country->userCountry, '(')}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div id="wpas-tax_car_location" class="wpas-tax_car_location wpas-generic-field  wpas-field">
                            <div class="label-container"><label for="main_cat">{{ __('Car make:') }}</label></div>
                            <select id="makeSelector" name="main_cat"   class="custom-select"  onchange="fnMakeChange(this)">
                                <option selected value="All">{{ __('All') }}</option>
                                @foreach($makes as $make)
                                    <option value="{{$make->make}}">{{$make->make}}</option>
                                @endforeach
                            </select>
                            </div>
                        <div id="wpas-tax_car_location" class="wpas-tax_car_location wpas-generic-field  wpas-field">
                            <div class="label-container"><label for="tax_car_model">{{ __('Car model:') }}</label></div>
                            <select id="modelSelector"  class="custom-select">
                                <option selected value="All">{{ __('All') }}</option>
                                @foreach($models as $model)
                                    <option value="{{$model->model}}">{{$model->model}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="wpas-tax_car_from_year">
                            <div class="label-container"><label for="tax_car_from_year">{{ __('Year:') }}</label></div>
                            <div style="display:flex">
                                <select id="yearFrom" name="tax_car_from_year"  class="custom-select" >
                                    <option value="All">{{ __('From') }}</option>
                                    @foreach($years as $year)
                                        <option value="{{$year->year}}">{{$year->year}}</option>
                                    @endforeach
                                </select>
                                <select id="yearTo"  name="tax_car_to_year"  class="custom-select" >
                                    <option value="All">{{ __('To') }}</option>
                                    @foreach($years as $year)
                                        <option value="{{$year->year}}">{{$year->year}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="wpas-tax_car_body" class="wpas-tax_car_body wpas-generic-field  wpas-field">
                            <div class="label-container"><label for="tax_car_body">{{ __('Body:') }}</label></div>
                            <select id="bodySelector" name="tax_car_body"  class="custom-select" >
                                <option selected value="All">{{ __('All') }}</option>
                                @foreach($bodies as $body)
                                    <option value="{{$body->bodyType}}">{{$body->bodyType}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="wpas-tax_car_body" class="wpas-tax_car_body wpas-generic-field  wpas-field">
                            <div class="label-container"><label for="tax_car_body">{{ __('Seach:') }}</label></div>
                            <input id="tax_car_body"  class="search-term" name="tax_car_body" style="color : #292027">
                        </div>
                        <input type="hidden" id="category" class="hidden" value="">
                        <input type="hidden"  id="appUrl" value="{{$url}}">
                        <center>
                            <button id="search-term" type="button" class="btn"  onclick="searchListings()" style="background: white;">{{ __('Filter Cars') }}</button>
                        </center>
                    </form>
                </div>
            </div>
            <div id = "topPagination">
                {{ $listings->links('elements.pager') }}
            </div>
        </div>
        <div style = "
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around"
        >
        @foreach($listings as $listing)
            <div class="itemListing">
                @include('elements.listing-box') {{-- , $listing)  --}}
            </div>
        @endforeach
        </div>

        <div style = "display : flex; justify-content : space-between; width : 100%; align-items:center; padding : 0px 20px; margin-bottom:10px; margin-top:10px;">
            {{ $listings->links('elements.pager') }}
        </div>
    </div>

@else
    <div>
        <h5>{{ __('Looks like there are no listings here yet.') }}</h5>
    </div>
@endif
