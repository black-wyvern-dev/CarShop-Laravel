<?php
/**
 * Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 * Proprietary and confidential.
 */

namespace App\Services;

use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SearchService
{
    /**
     * @param  Request  $request
     * @return array
     */
    public function searchFromRequest(Request $request): array
    {
        $country = $request->route('country');
        $make = $request->route('make');
        $model = $request->route('model');
        $body = $request->route('body');
        $yearFrom = (int)$request->route('yearFrom');
        $yearTo = (int)$request->route('yearTo');
        $userId = $request->route('userId');
        $search = '';
        if($request->route('search')){
            $search = $request->route('search');
        }

        //echo 'Country: '.$country.'    /make: '.$make.'    /model: '.$model.'    /body: '.$body.'    /yearFrom: '.$yearFrom.'    /yearTo: '.$yearTo.'    /search: '.$search.'<br>';
        $serachFlag = false;
        if (strpos(url()->full(), 'search/cars') == false) {
            $serachFlag = true;
        }
        //exit;
        $category = 'cars';
        $url = url('');

        $makes = DB::table('listing')
            ->select('make')
            ->whereNotNull('make')
            ->orderBy('make', 'asc')
            ->groupBy('make')
            ->get();
        $models = DB::table('listing')
            ->select('model')
            ->whereNotNull('model')
            ->orderBy('model', 'asc')
            ->groupBy('model')
            ->get();
        $bodies = DB::table('listing')
            ->select('bodyType')
            ->whereNotNull('bodyType')
            ->orderBy('bodyType', 'asc')
            ->groupBy('bodyType')
            ->get();
        $years = DB::table('listing')
            ->select('year')
            ->orderBy('year', 'asc')
            ->groupBy('year')
            ->get();
        $users_countries = DB::table('listing')
            ->select('userCountry')
            ->whereNotNull('userCountry')
            ->orderBy('userCountry', 'asc')
            ->groupBy('userCountry')
            ->get();

        //$searchStatistics = ListingSearchStatistic::orderBy('created_at', 'desc')->get();

        if($serachFlag) {

            $listings = Listing::searchForListings([
                'country'  => $country,
                'make'     => $make,
                'model'    => $model,
                'yearFrom' => $yearFrom,
                'yearTo'   => $yearTo,
                'body'     => $body,
                'search'   => $search,
                'userId'   => $userId,
            ]);
        } elseif ($userId) {
            $listings = Listing::where('userID', $userId)->orderBy('list_order_at', 'desc')->paginate(24);
        } else {
            $listings = Listing::orderBy('list_order_at', 'desc')->paginate(24);
        }

        $selectedOptions = ['country' => $country, 'make' => $make, 'model' => $model, 'yearFrom' => $yearFrom, 'yearTo' => $yearTo, 'body' => $body, 'search' => $search];
        $viewData = [
            'listings' => $listings,
            'makes' => $makes,
            'models' => $models,
            'bodies' => $bodies,
            'category' => $category,
            'type' => 'Car',
            'url' => $url,
            'selectedOption' => $selectedOptions,
            'years' => $years,
            //'searchStatistics' => $searchStatistics,
            'users_countries' => $users_countries,
        ];

        return $viewData;
    }
}
