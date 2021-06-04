<?php
/**
 * Copyright (c) 2020 Derks.IT / Jeroen Derks <jeroen@derks.it> All rights reserved.
 * Unauthorized copying of this file, via any medium is strictly prohibited.
 * Proprietary and confidential.
 */

namespace App\Http\Controllers;

use App\Pages;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stevebauman\Purify\Facades\Purify;

class PageController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $name = $request->route('name');
        $page = Pages::where('name', $name);

        // check if user is administrator or if the page is enabled
        if (!Session::get('isAdmin')) {
            $page = $page->where('enabled', 1);
        }

        $page = $page->first();
        if (!$page) {
            abort(404);
        }

        $page->description = Purify::clean($page->description);

        // render view
        return view('pages.content', ['pages' => $page]);
    }
}
