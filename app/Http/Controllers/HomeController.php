<?php

namespace App\Http\Controllers;

use App\Listing;
use App\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners = Banners::inRandomOrder()->where('page', 3)->get();
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

        $listings = Listing::orderBy('list_order_at', 'desc')->paginate(24);
        return view('pages.home',['listings' => $listings,'banners' => $banners, 'makes' => $makes, 'models' => $models, 'bodies' => $bodies,'type' => 'Car', 'url' => $url, 'years' => $years, 'users_countries' => $users_countries]);
    }

    public function getCars()
    {
        $makes = DB::table('taxonomies')->where('taxonomy', '=', 'make')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get ();
        $models = DB::table('taxonomies')->where('taxonomy', '=', 'serie')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $bodies = DB::table('taxonomies')->where('taxonomy', '=', 'body')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(25)->get();
        return view('pages.category',['listings' => $listings, 'makes' => $makes, 'models' => $models, 'bodies' => $bodies, 'category' => 'Cars', 'type' => 1]);
    }
    public function getCountryMakesModels(Request $request){
        $getRequestedCountry = $request->input('slug');
        if($getRequestedCountry == 'All')
        {
            $data['makes'] = DB::select("SELECT make as name FROM listing where make!='' group by make");
            $data['models'] = DB::select("SELECT model as name FROM listing where model!='' group by model");
        }
        else
        {
            $data['makes'] = DB::select("SELECT make as name FROM listing WHERE make!='' AND userCountry = :country group by make", ['country' => $getRequestedCountry]);
            $data['models'] = DB::select("SELECT model as name FROM listing WHERE model!='' AND userCountry = :country group by model", ['country' => $getRequestedCountry]);
        }
        return response()->json(['makes'=>$data['makes'],'models'=>$data['models']]);
    }
    public function getMakeModels(Request $request){
        $getRequestedCountry = $request->input('strCountry');
        $getRequestedMake = $request->input('strMake');
        if($getRequestedMake == 'All' && $getRequestedCountry != 'All')
        {
            $data['models'] = DB::select("SELECT model as name FROM listing where model!='' AND userCountry = :country group by model", ['country' => $getRequestedCountry]);
        }
        else if($getRequestedCountry == 'All' && $getRequestedMake == 'All')
        {
            $data['models'] = DB::select("SELECT model as name FROM listing where model!='' group by model");
        }
        else if($getRequestedCountry == 'All' && $getRequestedMake != 'All')
        {
            $data['models'] = DB::select("SELECT model as name FROM listing where model!='' AND make = :make group by model", ['make' => $getRequestedMake]);
        }
        else
        {
            $data['models'] = DB::select("SELECT model as name FROM listing WHERE model!='' AND make = :make AND userCountry = :country group by model", ['country' => $getRequestedCountry, 'make' => $getRequestedMake]);
        }
        return response()->json(['models'=>$data['models']]);
    }
    public function getSearch()
    {
        $makes = DB::table('taxonomies')->where('taxonomy', '=', 'make')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get ();
        $models = DB::table('taxonomies')->where('taxonomy', '=', 'serie')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $bodies = DB::table('taxonomies')->where('taxonomy', '=', 'body')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(16)->get();
        return view('pages.category',['listings' => $listings, 'makes' => $makes, 'models' => $models, 'bodies' => $bodies, 'category' => 'Cars', 'type' => 1]);
    }
    public function getMotorbikes()
    {
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(16)->get();
        return view('pages.category',['listings'=>$listings, 'category' => 'Motorbikes', 'type' => 2]);
    }
    public function getBoats()
    {
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(16)->get();
        return view('pages.category',['listings'=>$listings, 'category' => 'Boats', 'type' => 3]);
    }
    public function getMopeds()
    {
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(16)->get();
        return view('pages.category',['listings'=>$listings, 'category' => 'Mopeds', 'type' => 4]);
    }

    public function getAutomobila()
    {
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(16)->get();
        return view('pages.category',['listings'=>$listings, 'category' => 'Automobila', 'type' => 5]);
    }

    public function getParts()
    {
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(16)->get();
        return view('pages.category',['listings'=>$listings, 'category' => 'Parts', 'type' => 6]);
    }

    public function getSpecialists()
    {
        $listings = Listing::with(['listingPhotos'])->orderBy('created_at', 'desc')->limit(16)->get();
        return view('pages.category',['listings'=>$listings, 'category' => 'Specialists', 'type' => 7]);
    }
}
