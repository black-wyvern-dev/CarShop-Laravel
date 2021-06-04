<?php

namespace App\Http\Controllers;

use App\UserAvailableAdvert;
use Illuminate\Http\Request;

class PaymentsController extends Controller
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
        return view('pages.payments.packages');
    }

    public function packageConfirm(Request $request)
    {
        $packID = $request->route('packID');
        $type = $request->route('type');

        $data['pack'] = config('cc-app.depositPackages.' . $type)[$packID];
        $data['packID'] = $packID;


        return view('pages.payments.package-confirm',$data);
    }

    public function stripeDepositCompleteCharge(Request $request)
    {
        $details = $request->input('depositPack');
        $res=(explode("#",$details));
        $pkgID=$res[0];
        $userID=$res[3];

        UserAvailableAdvert::create(['userID' => $userID, 'advertPackageID' => $pkgID]);
        return view('pages.payments.success');
    }
}
