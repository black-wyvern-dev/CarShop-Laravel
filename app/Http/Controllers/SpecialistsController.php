<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SpecialistsController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $specialists = User::orderBy('businessName')->paginate(25);
        return view('pages.specialists',['specialists'=>$specialists]);
    }

    public function showNumber(Request $request){
        $userId   = strtok($request->input('id'), '-');
        $postfix  = strtok('');
        $doMobile = 'm' === $postfix;

        $user = User::where('userID', $userId)->get();
        return response()->json(['phoneNumber'=>$user[0][$doMobile ? 'mobileNumber' : 'phoneNumber']]);
    }

    public function specialist(Request $request)
    {
        $userId   = $request->route('userId');
        $user     = User::find($userId);
        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }

        $data = $this->searchService->searchFromRequest($request);
        $data['specialist'] = $user;
        return view('pages.specialist', $data);
    }
}
