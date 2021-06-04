<?php

namespace App\Http\Controllers;

use App\Banners;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * @var SearchService
     */
    protected $searchService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getSearch(Request $request)
    {
        $data = $this->searchService->searchFromRequest($request);
        $data['banners'] = Banners::inRandomOrder()->where('page', 3)->get();

        return view('pages.category', $data);
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
    /**
     * Maps the input filter tags names with database's
     *
     * @param $request
     * @return array
     */
    public function mapTermsToFields($request){
        $data = [
            'country' => $request->get('country'),
            'make' => $request->get('make'),
            'model' => $request->get('model'),
            'yearFrom' => $request->get('yearFrom'),
            'yearTo' => $request->get('yearTo'),
            'search' => $request->get('search'),
        ];
        return $data;
    }
}
