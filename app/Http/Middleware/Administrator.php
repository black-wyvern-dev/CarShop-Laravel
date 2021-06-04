<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;


class Administrator {



    /**
     * Create a new filter instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!$request->get('loginRedirect')) {
            if (!session('isAdmin')) {
                Redirect::route('adminLogin', ['loginRedirect' => 1])->send();
            }
        }


        return $next($request);

    }

}
