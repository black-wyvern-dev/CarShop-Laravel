<?php

namespace App\Http\Controllers;

use App\Services\UploadService;
use App\User;
use App\Listing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    const LOGO_DIR    = 'uploads/users/logos';
    const LOGO_WIDTH  = 236;
    const LOGO_HEIGHT = 60;
    const NO_LOGO_DIR = 'uploads/users/photos';

    /**
     * @var UploadService
     */
    protected $uploadService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UploadService $uploadService)
    {
        $this->middleware('auth');

        $this->uploadService = $uploadService;
    }

    /**
     * Confirmation link clicked
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function emailConfirmation(Request $request)
    {
        if (base64_decode($request->token) == Auth::user()->validationToken){
            Auth::user()->update(['email_verified_at' => date("Y-m-d H:i:s")]);
        }
        else{
            return redirect('/home');
        }
        return redirect('/home');
    }

    public function userProfile(Request $request)
    {
        $user = User::find(Auth::user()->userID);
        return view('pages.user-profile', ['users' => $user]);
    }


    public function removeUser() {
        $user = User::find(Auth::user()->userID);
        $lists = Listing::where('userID', $user->userID)->get();
        foreach($lists as $list) {
            $list->delete();
        }
        Auth::logout();
        if($user->delete())
            return response()->json(['status' => 1]);
        return response()->json(['status' => 0]);
    }




    public function updateProfile(Request $request)
    {
        $userId = Auth::user()->userID;

        /** @var User $user */
        $user = User::where('userID', $userId)->first();

        $data = $request->all();
        foreach (['website', 'twitter', 'facebook', 'instagram'] as $name) {
            if (isset($data[$name]) && '' != $data[$name]) {
                $data[$name] = preg_replace('/^[A-Za-z0-9]+:\/\/?/', '', $data[$name]);
                $data[$name] = 'http://' . $data[$name];
            }
        }

        $oldLogo = null;
        if (empty($data['logo'])) {
            unset($data['logo']);
        } else {
            $data['logo'] = preg_replace('/[^\pL\pN_.-]+/', '', basename($data['logo']));
            $directory = public_path(self::LOGO_DIR . '/');
            if (file_exists($directory . $data['logo'])) {
                if (!empty($user->logo) && $data['logo'] !== $user->logo) {
                    $oldLogo = $directory . $user->logo;
                    if (!file_exists($oldLogo)) {
                        $oldLogo = null;
                    }
                }
            }
        }
        if (empty($data['logo']) && empty($user->logo)) {
            $data['logo'] = 'no-logo.png';
        }

        $user = $user->update($data);
        if ($oldLogo) {
            @unlink($oldLogo);
        }

        return view('pages.user-profile', ['users' => $user]);
    }

    public function logo(Request $request)
    {
        $userId = Auth::user()->userID;
        $user   = User::find($userId);

        return $this->uploadService->uploadImage($request, self::LOGO_DIR, self::LOGO_WIDTH, self::LOGO_HEIGHT, 'logo', true, $user, true);
    }
}
