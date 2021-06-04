<?php

namespace App\Http\Controllers;

use App\User;
use App\UserGallery;
use DemeterChain\A;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Javascript;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['gallery'] = UserGallery::where('userID','=', Auth::user()->userID)->get();
        if(Auth::user()->specialism) {
            $specialists = explode(",", Auth::user()->specialism);
            foreach ($specialists as $specialist) {
                $data['specialists'][$specialist] = true;
            }
        }
        if(Auth::user()->weSpeak){
            $weSpeaks = explode(",", Auth::user()->weSpeak);
            foreach ($weSpeaks as $weSpeak){
                $data['weSpeak'][$weSpeak] = true;
            }
        }
        return view('pages.settings', $data);
    }
    public function saveSettings(Request $request)
    {
        $data = $request->input();
        $user = User::find(Auth::user()->userID);

        //Description change
        if($request->input('description')){
            try {
                $user->update($data);
            }
            catch(\Exception $e){
                print $e->getMessage();
                throw $e;
            }
            return response()->json(['status' => 1]);
        }

        //General change
        if($data['email']) {
            if ($data['email'] == Auth::user()->email)
                $terms = [
                    'firstName' => 'required|max:255',
                ];
            else
                $terms = [
                    'firstName' => 'required|max:255',
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                ];
            $validation = Validator::make($data, $terms);
            if (!$validation->fails()) {
                try {
                    $user->update($data);
                } catch (\Exception $e) {
                    print $e->getMessage();
                    throw $e;
                }
                return response()->json(['status' => 1]);

            } else {
                return response()->json(['status' => 0, 'errors' => $validation->errors()->all()]);
            }
        }
    }

    public function logoUpload(Request $request)
    {

        // Validation rules for each file asset type
        $rules = array(
            'logo' => 'mimes:jpeg,jpg,png| max:1000',
        );

        // Validating the rules

        $validator = Validator::make($request->file(), $rules);
        if (!$validator->fails()) {

            $user = Auth::user();
            $file = $request->file('logo');

            $destinationPath ='uploads/users/logos';
            $extension = $file->getClientOriginalExtension();
            $fileName = $user->userID.'-'.rand(1,9999).'.'.$extension;
            $oldAvatar = 'uploads/users/logos/'.$fileName;
            if (file_exists($oldAvatar))
            {
                unlink($oldAvatar);
            }
            $upload_success = $file->move($destinationPath, $fileName);
            if ($upload_success) {
                $user->logo = $fileName;
                $user->update();
                return response()->json(['status' => 1, 'fileName' => $fileName]);
            }
        } else {
            return response()->json(['status' => 0, 'errors' => $validator->errors()->all()]);

        }


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
        return ['total' => count($files), 'photos' => $photo];
    }
    public function uploadGallery($check, $file){
        // Validating the rules
        if ($check) {

            $user = Auth::user();
            $countGallery = UserGallery::where('userID', Auth::user()->userID)->count();

            $destinationPath ='uploads/users/photos';
            $extension = $file->getClientOriginalExtension();
            if($countGallery<5){
                $fileName = rand(1,9999).'-'.$user->userID.'-'.rand(1,9999).'.'.$extension;
                $oldAvatar = 'uploads/users/photos/'.$fileName;
                if (file_exists($oldAvatar))
                {
                    unlink($oldAvatar);
                }
                $upload_success = $file->move($destinationPath, $fileName);
                if ($upload_success) {
                    $photo = UserGallery::create(['userID' => $user->userID, 'name' => $fileName]);
                    return  ['fileName'=>$fileName, 'count'=>$countGallery+1, 'id' => $photo['userGalleryID']];
                }
            }else{
                $lastPhoto = UserGallery::where('userID', Auth::user()->userID)->orderBy('created_at', 'DESC')->first()->delete();
                $fileName = rand(1,9999).'-'.$user->userID.'-'.rand(1,9999).'.'.$extension;
                $oldAvatar = 'uploads/users/photos/'.$fileName;
                if (file_exists($oldAvatar))
                {
                    unlink($oldAvatar);
                }
                $upload_success = $file->move($destinationPath, $fileName);
                if ($upload_success) {
                    $photo = UserGallery::create(['userID' => $user->userID, 'name' => $fileName]);
                    return  ['fileName'=>$fileName, 'count'=>$countGallery, 'id' => $photo['userGalleryID']];
                }
            }
        } else {
            return ['errors' => 'The photo must be a file of type: jpeg, jpg, png.'];
        }

    }
    public function deletePhoto(Request $request){
        $photo = UserGallery::where('userID', Auth::user()->userID)->where('userGalleryID', $request->input('id'))->first();
        if($photo['name']){
            $oldPhoto = 'uploads/users/photos/'.$photo['name'];
            if (file_exists($oldPhoto))
            {
                unlink($oldPhoto);
            }
            $photo->delete();
        }
        return $request->input('id');

    }


}
