<?php

namespace App\Http\Controllers;

use App\AttributeList;
use App\Listing;
use App\ListingPhoto;
use App\Taxonomy;
use App\User;
use DB;
use Auth;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('pages.advertise.index');
    }

    public function create(Request $request)
    {
        $dealer_details = User::find(Auth::user()->userID);
        $dealer_details = $dealer_details['country'];
        session(['itemPhotos' => array()]);
        $type = $request->route('type');
        $data['makes'] = DB::table('taxonomies')->where('taxonomy', '=', 'make')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get ();
        $data['models'] = DB::table('taxonomies')->where('taxonomy', '=', 'serie')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['years'] = DB::table('taxonomies')->where('taxonomy', '=', 'ca-year')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['bodies'] = DB::table('taxonomies')->where('taxonomy', '=', 'body')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('sequence', 'asc')->get();
        $data['transmissions'] = DB::table('taxonomies')->where('taxonomy', '=', 'transmission')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $data['upholsteries'] = DB::table('taxonomies')->where('taxonomy', '=', 'upholstery')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['interiorColors'] = DB::table('taxonomies')->where('taxonomy', '=', 'interior-color')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['exteriorColors'] = DB::table('taxonomies')->where('taxonomy', '=', 'exterior-color')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['fuelTypes'] = DB::table('taxonomies')->where('taxonomy', '=', 'fuel')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $data['userCountry'] = trim(strtok($dealer_details, '('));
        return view('pages.advertise.create.'.$type, $data);
    }

    public function getMakeModels(Request $request){
        if($request->input('slug') !== 'all-classics')
            $data['models'] = DB::table('termMeta')->where('value', '=', $request->input('slug'))->join('term', 'termMeta.termID', '=', 'term.termID')->select('term.slug','term.name')->orderBy('name')->get();
        else
            $data['models'] = DB::table('taxonomies')->where('taxonomy', '=', 'serie')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.slug','term.name')->orderBy('name')->get();


        return response()->json(['models'=>$data['models']]);
    }

    public function saveAdvertise(Request $request){
        $name = $request->input('make').' '.$request->input('model').' '.$request->input('modelType').' '.$request->input('year');
        $data =  ['name' => $name, 'userID' => Auth::user()->userID, 'type' => 'Car', 'list_order_at' => date("Y-m-d H:i:s")];

        $data = array_merge($data, $request->input());
        $listing = Listing::create($data);
        $photos = session('itemPhotos');
        foreach ($photos as $photo){
            ListingPhoto::create(['listingID' => $listing['listingID'], 'name' => $photo]);
        }

        if(!$request->input('modelType'))
            $name = $request->input('make').' '.$request->input('model').' '.'A'.' '.$request->input('year');

        return response()->json(url('listings/cars/'.$listing['listingID'].'/'.urlencode(str_replace(' ','-',$name))));
    }

    public function photoUpload(Request $request)
    {

        // Validation rules for each file asset type
        $files = $request->file('photos');
        $allowedfileExtension=['jpg','png','jpeg','bmp'];
        foreach($files as $index => $file) {
            $extension = $file->getClientOriginalExtension();
            $check=in_array($extension,$allowedfileExtension);
            $photo[$index] = $this->uploadGallery($check, $file);
        }
        return ['total' => count(session('itemPhotos')), 'photos' => $photo];
    }

    public function uploadGallery($check, $file){
        // Validating the rules
        if ($check) {
            $gallery = session('itemPhotos');
            if(!session('itemPhotos'))
                $gallery = array();

            $destinationPath ='uploads/listings/photos';
            $extension = $file->getClientOriginalExtension();
            if(count($gallery)<20){
                $fileName = rand(1,9999).'-'.rand(1,9999).'.'.$extension;
                $oldAvatar = 'uploads/listings/photos/'.$fileName;
                if (file_exists($oldAvatar))
                {
                    unlink($oldAvatar);
                }
                $upload_success = $file->move($destinationPath, $fileName);
                if ($upload_success) {
                    array_push($gallery, $fileName);
                    $key = array_search ($fileName, $gallery);
                    session(['itemPhotos' => $gallery]);
                    return  ['fileName'=>asset('uploads/listings/photos/'.$fileName), 'key'=>$key];
                }
            }
        } else {
            return ['errors' => 'The photo must be a file of type: jpeg, jpg, png.'];
        }
    }

    public function deletePhoto(Request $request){
        $photos = session('itemPhotos');
        $photo = 'uploads/items/listings/'.$photos[$request->input('index')];
        if (file_exists($photo))
        {
            unlink($photo);
        }
        unset($photos[$request->input('index')]);
        session(['itemPhotos' => $photos]);
        return count($photos);
    }

}
