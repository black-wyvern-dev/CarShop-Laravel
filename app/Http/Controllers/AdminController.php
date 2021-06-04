<?php

namespace App\Http\Controllers;

use App\Banners;
use App\Pages;
use App\Listing;
use App\ListingPhoto;
use App\Rules\ValidRecaptcha;
use App\Services\UploadService;
use App\Taxonomy;
use App\Term;
use App\TermMeta;
use App\User;
use App\Settings;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class AdminController extends Controller
{
    const UPLOAD_DIR = 'uploads/pages';

    /**
     * @var UploadService
     */
    protected $uploadService;

    /**
     * AdminController constructor.
     *
     * @param  UploadService  $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function loginPage()
    {
        return view('admin.login');
    }

    /**
     * Logout method
     *
     * @return \Illuminate\View\View
     */
    public function logOut()
    {
        Session::forget('isAdmin');
        return redirect('admin/login');
    }

    public function postLogin(Request $request)
    {
        $data      = $request->all();
        $validator = Validator::make($data, [
            'user'                 => ['required', 'string', 'min:8', 'max:64'],
            'pass'                 => ['required', 'string', 'min:8', 'max:64'],
            'g-recaptcha-response' => [ 'required', new ValidRecaptcha],
        ]);

        $loginErrors = ['Sorry, but the provided credentials are wrong.'];
        if (!$validator->fails()) {
            // if ($request->input('user') === env('AD_USERNAME') && $request->input('pass') === env('AD_PASSWORD')) {
            if ($request->input('user') == 'E-fhc38fw!' && $request->input('pass') == 'L2w2020yesfw!!') {
                session(['isAdmin' => 'true']);
                return redirect()->action('AdminController@homePage');
            }
        } else {
            $loginErrors = $validator->errors()->messages();
        }

        return view('admin.login', ['loginErrors'=> $loginErrors]);
    }

    public function homePage()
    {
        return view('admin.home');
    }

    public function loginAs(Request $request)
    {
        $user = User::where('userID',$request->route('userID'))->first();
        Auth::login($user, true);
        return redirect('/');
    }

    /**************************************************************************
     *  Makes
     */

    public function makes(){
        $makes = DB::table('taxonomies')->where('taxonomy', '=', 'make')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        return view('admin.makes',['makes' => $makes]);
    }
    public function addMake(Request $request){
        $term = Term::create(['name'=>$request->input('name'), 'slug' => $request->input('slug')]);
        $make = Taxonomy::create(['termID' => $term['termID'], 'taxonomy' => 'make', 'parent' => 0]);
        return response()->json(['status' => 1]);
    }
    public function editMake(Request $request){
        $make = Term::find($request->route('termID'));
        $models = DB::table('termMeta')->where('value', '=', $make['slug'])->join('term', 'termMeta.termID', '=', 'term.termID')->select('term.slug','term.name','term.created_at','term.termID')->orderBy('name')->get();
        return view('admin.edit-make', ['models' => $models, 'make'=>$make]);
    }
    public function getMakeModels(Request $request){
        if($request->input('slug') !== 'all-classics')
            $data['models'] = DB::table('termMeta')->where('value', '=', $request->input('slug'))->join('term', 'termMeta.termID', '=', 'term.termID')->select('term.slug','term.name')->orderBy('name')->get();
        else
            $data['models'] = DB::table('taxonomies')->where('taxonomy', '=', 'serie')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.slug','term.name')->orderBy('name')->get();

        return response()->json(['models'=>$data['models']]);
    }
    public function updateMake(Request $request){
        $term_slug = $request->input('term_slug');
        $name      = $request->input('name');
        Term::where(['slug' => $term_slug])->update(['name' => $name]);
    }
    public function addModel(Request $request){
        $term = Term::create(['name'=>$request->input('name'), 'slug'=>$request->input('slug')]);
        $termMeta =TermMeta::create(['termID'=>$term['termID'], 'name' =>'stm_parent', 'value'=>$request->input('make')]);
        return response()->json(['status' => 1]);
    }
    public function deleteMakeModel(Request $request){
        $term = Term::find($request->route('termID'));
        try {
            $term->delete();
        }
        catch(\Exception $e){
            print $e->getMessage();
            throw $e;
        }
        if($request->route('type')=='make')
            return redirect('admin/makes/');
        else
            return redirect('admin/makes/edit/'.$request->route('makeID'));
    }

    /**************************************************************************
     *  Pages
     */

    public function pages()
    {
        $pages = Pages::orderBy('sequence', 'desc')->get();
        return view('admin.pages',['pages' => $pages]);
    }

    public function editPage(Request $request)
    {
        $pageId = $request->route('pageID');
        $new    = 'new' === $pageId;

        $data = [
            'new' => $new,
        ];

        if ($new) {
            $page = new Pages();
            $page->id = 'new';
        } else {
            $page = Pages::find($pageId);
            if ($page) {
                $page->description = Purify::clean($page->description);
            }
        }
        $data['pages'] = $page;

        return view('admin.edit-page', $data);
    }

    public function updatePages(Request $request)
    {
        $pageId = $request->input('id');
        $new    = 'new' === $pageId;

        $data = $request->all();
        if (!isset($data['enabled'])) {
            $data['enabled'] = false;
        }
        if (isset($data['name'])) {
            $data['name'] = strtolower(trim(preg_replace('/[^A-Za-z0-9_]+/', '-', $data['name']), '-'));
        }
        if (isset($data['description'])) {
            $data['description'] = Purify::clean($data['description']);
        }

        if ($new) {
            $page = new Pages($data);
            $page->save();
        } else {
            $page = Pages::where('id', $pageId)->first();
            $page->update($data);
        }

        return redirect('admin/pages');
    }

    public function uploadPages(Request $request)
    {
        return $this->uploadService->uploadImage($request, self::UPLOAD_DIR, null, null, null, true);
    }

    /**************************************************************************
     *  Banners
     */
    public function banners(){
        $banners = Banners::orderBy('created_at', 'desc')->get();
        return view('admin.banners',['banners' => $banners]);
    }
    public function addBanner(){
        return view('admin.add-banner');
    }
    public function editBanner(Request $request){
        $banner = Banners::find($request->route('bannerID'));
        return view('admin.add-banner', ['banner' => $banner]);
    }
    public function postBanner(Request $request){
        $banner = Banners::create($request->input());
        return $banner;
    }
    public function updateBanner(Request $request){
        $banner = Banners::find($request->input('bannerID'));
        $banner->update($request->input());
        return $banner;
    }
    public function bannerUpload(Request $request)
    {

        // Validation rules for each file asset type
        $file = $request->file('image');
        $errors = null;
        $fileName = null;
        $allowedfileExtension=['jpg','png','jpeg','bmp','gif','JPG','PNG','JPEG','BMP','GIF'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension,$allowedfileExtension);
            if ($check) {
                $destinationPath ='uploads/banners';
                $extension = $file->getClientOriginalExtension();
                    $fileName = $file->getClientOriginalName();
                    $oldAvatar = 'uploads/banners/'.$fileName;
                    if (file_exists($oldAvatar))
                    {
                        unlink($oldAvatar);
                    }
                    $upload_success = $file->move($destinationPath, $fileName);
                    if ($upload_success) {
                        $fileName = asset('uploads/banners/'.$fileName);
                    }

            } else {
                $errors = 'The photo must be a file of type: jpeg, jpg, png.';
            }

        return ['errors' => $errors, 'image' => $fileName];
    }
    public function deleteBanners(Request $request)
    {
        $banner = Banners::find($request->route('bannerID'));
        try {
            $banner->delete();
        }
        catch(\Exception $e){
            print $e->getMessage();
            throw $e;
        }
        return redirect('admin/banners/');
    }

    /**************************************************************************
     *  Listings
     */

    public function listings(){
        $listings = Listing::orderBy('created_at', 'desc')->paginate(25);
        return view('admin.listings',['listings' => $listings]);
    }
    public function editListings(Request $request){
        $data['listing'] = Listing::find($request->route('listingID'));
        $data['makes'] = DB::table('taxonomies')->where('taxonomy', '=', 'make')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get ();
        $data['models'] = DB::table('taxonomies')->where('taxonomy', '=', 'serie')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['years'] = DB::table('taxonomies')->where('taxonomy', '=', 'ca-year')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['bodies'] = DB::table('taxonomies')->where('taxonomy', '=', 'body')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('sequence', 'asc')->get();
        $data['transmissions'] = DB::table('taxonomies')->where('taxonomy', '=', 'transmission')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        $data['upholsteries'] = DB::table('taxonomies')->where('taxonomy', '=', 'upholstery')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['interiorColors'] = DB::table('taxonomies')->where('taxonomy', '=', 'interior-color')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['exteriorColors'] = DB::table('taxonomies')->where('taxonomy', '=', 'exterior-color')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*')->orderBy('name')->get();
        $data['fuelTypes'] = DB::table('taxonomies')->where('taxonomy', '=', 'fuel')->join('term', 'taxonomies.termID', '=', 'term.termID')->select('term.*', 'taxonomies.parent')->orderBy('parent', 'asc')->get();
        if(isset($data['listing']['listingPhotos'][0]['name'])){
            $gallery = $data['listing']['listingPhotos'];
            $photos = array();
            foreach($gallery as $photo){
                array_push($photos, $photo['name']);
            }
            $photos = array_unique($photos);
            session(['itemPhotos' => $photos]);
        }else{
            session(['itemPhotos' => array()]);
        }

        return view('admin.edit-listing',$data);
    }
    public function editListing(Request $request){
        $listing = Listing::find($request->input('listingID'));
        $listing->update($request->input());
        $gallery = ListingPhoto::where('listingID', $listing['listingID'])->get();
        foreach ($gallery as $photo){
            $oldPhoto = 'uploads/listings/photos/'.$photo['name'];
            if (file_exists($oldPhoto))
            {
                unlink($oldPhoto);
            }
            $photo->delete();
        }
        $photos = session('itemPhotos');
        foreach ($photos as $photo){
            ListingPhoto::create(['listingID' => $listing['listingID'], 'name' => $photo]);
        }
        return $listing;
    }
    public function deleteListing(Request $request){
        $list = Listing::find($request->route('listingID'));
        try {
            $list->delete();
        }
        catch(\Exception $e){
            print $e->getMessage();
            throw $e;
        }
        return redirect('admin/listings/');
    }


    
    /**************************************************************************
     *  Interval
     */

    public function interval(){
        // $listings = Listing::orderBy('created_at', 'desc')->paginate(25);
        $settings = Settings::first();
        if ($settings == null) {
            $settings = new Settings;
            $settings->interval = 5;
            $settings->save();
        }
        return view('admin.interval',[
            'settings' => $settings
        ]);
    }

        //reset the interval as administrator's option
    public function setInterval(Request $request) {
        $settings = Settings::first();
        $settings->interval = $request->interval;
        if ($settings->save())
            return response()->json(['status' => 1]);
        return response()->json(['status' => 0]);
    }



    /**************************************************************************
     *  Users
     */

    public function users(){
        //$users = User::orderBy('created_at', 'desc')->get();
        $users = User::all();
        return view('admin.users',['users' => $users]);
    }

    public function changeUserType (Request $request) {
        $user = User::find($request->id);
        $user->type = $request->type;
        if ($user->save()) 
            return response()->json(['status' => 1]);
        return response()->json(['status' => 0]);
    }

    public function deleteUsers(Request $request){
        $user = User::find($request->route('userID'));
        try {
            $user->delete();
        }
        catch(\Exception $e){
            print $e->getMessage();
            throw $e;
        }
        return redirect('admin/users/');
    }
    public function editUsers(Request $request)
    {
        $user = User::find($request->route('userID'));
        return view('admin.edit-user', ['users' => $user]);
    }
    public function updateUsers(Request $request){
        $userUpdate  = User::where('userID',$request->input('userID'))->first();
        $user = $userUpdate->update($request->all());
        return redirect('admin/users');
    }

    /**************************************************************************
     *  Gallery
     */

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
}
