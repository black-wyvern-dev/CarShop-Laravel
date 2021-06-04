<?php

namespace App\Http\Controllers;

use App\Listing;
use App\ListingPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListingsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userListings()
    {
        $listings = Listing::where('userID', Auth::user()->userID)
                    ->with(['listingPhotos'])
                    ->orderBy('make')
                    ->get();
        return view('pages.user-listings',['listings' => $listings]);
    }
    public function editListing(Request $request)
    {
        $data['makes'] = DB::table('taxonomies')->where('taxonomy', '=', 'make')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get ();
        $data['models'] = DB::table('taxonomies')->where('taxonomy', '=', 'serie')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['years'] = DB::table('taxonomies')->where('taxonomy', '=', 'ca-year')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['bodies'] = DB::table('taxonomies')->where('taxonomy', '=', 'body')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $data['transmissions'] = DB::table('taxonomies')->where('taxonomy', '=', 'transmission')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $data['upholsteries'] = DB::table('taxonomies')->where('taxonomy', '=', 'upholstery')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['interiorColors'] = DB::table('taxonomies')->where('taxonomy', '=', 'interior-color')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['exteriorColors'] = DB::table('taxonomies')->where('taxonomy', '=', 'exterior-color')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['fuelTypes'] = DB::table('taxonomies')->where('taxonomy', '=', 'fuel')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $data['listing'] = Listing::where('listingID', $request->route('id'))->where('userID', Auth::user()->userID)->with(['listingPhotos'])->first();
        $photos = array();
        foreach ($data['listing']['listingPhotos'] as $photo){
            array_push($photos, $photo['name']);
        }
        $photos = array_unique($photos);
        session(['itemPhotos' => $photos]);
        return view('pages.edit-listing', $data);
    }

    public function saveListing(Request $request){
        $title = $request->input('make').' '.$request->input('model').' '.$request->input('modelType').' '.$request->input('year');
        $values =  [
            'name' => $title,
            'type' => 'Car',
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'modelType'  => $request->input('modelType'),
            'year'  => $request->input('year'),
            'bodyType'  => $request->input('bodyType'),
            'odometer'  => $request->input('odometer'),
            'odometerType' => $request->input('odometerType'),
            'fuelType'  => $request->input('fuelType'),
            'engine' => $request->input('engine'),
            'transmission' => $request->input('transmission'),
            'exteriorColor' => $request->input('exteriorColor'),
            'interiorColor' => $request->input('interiorColor'),
            'upholstery' => $request->input('upholstery'),
            'steering' => $request->input('steering'),
            'vin' => $request->input('vin'),
            'price' => $request->input('price'),
            'customlabel' => $request->input('customlabel'),
            'description' => $request->input('description'),
            'video' => $request->input('videoYoutube'),
        ];
        $listing = Listing::where('listingID', $request->input('id'))->where('userID', Auth::user()->userID)->first();
        $listing->update($values);
        $photos = session('itemPhotos');
        if(count($photos)){
            $oldPhotos = ListingPhoto::where('listingID', $listing['listingID'])->get();
            foreach ($oldPhotos as $oldPhoto){
                $oldPhoto->delete();
            }
            for ($k=0;$k<=count($photos)-1; $k++){
                if($photos[$k]){
                    ListingPhoto::create(['listingID' => $listing['listingID'], 'name' => $photos[$k]]);
                }
            }
        }
        return response()->json(url('listings/cars/'.$listing['listingID']));
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
            $gallery = (array)session('itemPhotos');
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

    public function listing(Request $request){
         $id = $request->route('id');
         $listing = Listing::where('listingID', $id)->with(['listingPhotos'])->first();

        ////// Updating Veiws /////////
         $values =  [
            'views' => $listing['views']+1,
        ];
        $listing1 = Listing::where('listingID', $id);
        $listing1->update($values);
        ////// End Updating Veiws /////////

         return view('pages.listing',['listing' => $listing]);

    }
     public function deleteListing(Request $request){
        $res= Listing::where(['listingID' => $request->route('listingID')])->delete();
        return redirect('user/listings');
    }
    public function setPumpUp(Request $request){
        $pid = $request->input('pid');
        $move_up = $request->input('move_up');
        $created_at = $request->input('created_at');
        $current_date = date('Y-m-d H:i:s');
        if($move_up==1)
        {
          $values =  [
            'move_up' => 1,
            'list_order_at' => $current_date, //  2019-02-23 11:42:09
            ];
        }
        else
        {
            $values =  [
            'move_up' => 0,
            'list_order_at' => $created_at,
            ];
        }
        $listing = Listing::where('listingID', $pid);
        $listing->update($values);
        return response()->json(['pid'=>$pid]);
    }
}
