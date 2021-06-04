<?php

namespace App\Http\Controllers;

use App\Providers\MailerServiceProvider as Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\User;


use App\Rules\ValidRecaptcha;
use Illuminate\Support\Facades\Validator;


class HelpController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function emailConfirmation()
    {
        return view('pages.email-confirmation');
    }



    public function getRates()
    {
        return view('pages.rates');
    }
    public function getAboutUs()
    {
        return view('pages.about-us');
    }
    public function getRestoration()
    {
        return view('pages.restoration');
    }
    public function getInsurance()
    {
        return view('pages.insurance');
    }
    public function getWorkingWithUs()
    {
        return view('pages.working-with-us');
    }
    public function getConditions()
    {
        return view('pages.conditions');
    }
    public function getContact()
    {
        return view('pages.contact');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sendEmailConfirmation()
    {
        Mailer::sendConfirmationEmail(Auth::user()->email, Auth::user()->firstName, Auth::user()->lastName, Auth::user()->validationToken);
        return response()->json(1);
    }


    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'g-recaptcha-response' => ['g-recaptcha-response' => ['required', new ValidRecaptcha]],
        ]);
    }


    /**
     * Send Email to User
     * @return view
     */

    public function sendEmailToSeller(Request $request) {
        $emailData = $request->all();
        $validator = $this->validator($emailData);
        if($validator->fails()){
            return response()->json(['status' => 0, 'errors' => $validator->errors()->all()]);
        }
        $seller = User::find($request->userid);
        // dd($seller->email);
        Mail::to($seller->email)->send(new SendMailable($emailData));
        return response()->json(['status' => 1]);
    }
}
