            <div id="sidebar" class="col-lg-3 sidebar-right last extendright bg-darker">
                <div id="tdp_car_search-3" class="widget widget_tdp_car_search">
                    <h3 class="widget-title"><span>{{ __('Search') }}</span></h3>
                    <div class="search-form-widget">

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
                                <select id="yearFrom" name="tax_car_from_year"  class="custom-select" >
                                    <option value="All">{{ __('From') }}</option>
                                    @foreach($years as $year)
                                        <option value="{{$year->year}}">{{$year->year}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="wpas-tax_car_to_year" class="wpas-tax_car_to_year wpas-generic-field  wpas-field">
                                <select id="yearTo"  name="tax_car_to_year"  class="custom-select" >
                                    <option value="All">{{ __('To') }}</option>
                                    @foreach($years as $year)
                                        <option value="{{$year->year}}">{{$year->year}}</option>
                                    @endforeach                        </select>
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
                                <input id="tax_car_body"  class="search-term" name="tax_car_body">
                            </div>
                            <input type="hidden" id="category" class="hidden" value="">
                            <input type="hidden"  id="appUrl" value="{{$url}}">
                            <center>
                                <button id="search-term" type="button" class="btn"  onclick="searchListings()">{{ __('Filter Cars »') }}</button></center>
                        </form>
                    </div>

                </div>

                <!--- Banner Code --->
                <div class="banners row">
                {{-- Maximum 10 banners --}}
                @php
                    $browser  = new \hisorange\BrowserDetect\Parser();
                    $browser  = $browser->detect();
                    $max      = $browser->isMobile() ? 15 : ($browser->isTablet() ? 13 : 11);
                    $count    =  0;
                    $adsCount = 0;
                    /** @var \Illuminate\Support\Collection $banners */
                @endphp
                @foreach(array_slice($banners->all(), 0, ceil($max / 2)) as $banner)
                    @php
                        $banner_img_path = asset('uploads/banners').'/'.$banner->image;
                        $banner_link_path = $banner->link;
                    @endphp
                    <div class="col-xs-12 col-md-6 col-lg-12">
                        <a href="{{$banner_link_path}}" target="_blank">
                            <img  src="{{$banner_img_path}}"></a>
                    </div>

                    @php
                        $count += 1;
                    @endphp
                    @if($count < $max)
                    <div class="col-xs-12 col-md-6 col-lg-12">
                        @include('elements.google-ad', ['index' => $adsCount++])
                    </div>
                    @php
                        $count += 1;
                    @endphp
                    @endif
                @endforeach
                <!--- End of Banner --->

                @for($i = count($banners); $i < ceil(($max - $count) / 2); ++$i)
                    <div class="col-xs-12 col-md-6 col-lg-12">
                    @include('elements.google-ad', ['index' => $adsCount++])
                    </div>
                @endfor
                </div>
            </div>
            <!-- End of sidebar -->
        </div>

        <div id="footer-ads" class="row">
            @include('elements.google-ad', ['responsive' => true, 'width' => 960, 'height' => 160])
        </div>

