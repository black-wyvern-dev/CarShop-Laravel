<?php

namespace App\Http\Controllers\Auth;

use App\Rules\ValidRecaptcha;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Providers\MailerServiceProvider as Mailer;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'g-recaptcha-response' => ['g-recaptcha-response' => ['required', new ValidRecaptcha]],
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createCompany(Request $request)
    {
        $data = $request->all();
        $validator = $this->validator($data);
        if(!$validator->fails()){
            $token = substr(md5($data['firstName'] . $data['lastName']. rand(1,999)),0,24);
            $user = User::create([
                'type' => 2,
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'businessName' => $data['businessName'],
                'mobileNumber' => $data['mobileNumber'],
                'phoneNumber' => $data['phoneNumber'],
                'street' => $data['street'],
                'street2' => $data['street2'],
                'town' => $data['town'],
                'country' => $data['country'],
                'postCode' => $data['postCode'],
                //'vatNumber' => $data['vatNumber'],
                'website' => $data['website'],
                'currency' => $data['currency'],
                'email' => $data['email'],
                'validationToken' => $token,
                'password' => Hash::make($data['password']),
            ]);
            Auth::login($user);
            Mailer::sendConfirmationEmail($data['email'], $data['firstName'], $data['lastName'], $token);
            return response()->json(['status' => 1, 'url' => url($this->redirectPath())]);
        }else{
            return response()->json(['status' => 0, 'errors' => $validator->errors()->all()]);
        }

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createPrivate(Request $request)
    {
        $data = $request->all();
        $validator = $this->validator($data);
        if(!$validator->fails()){
            $token = substr(md5($data['firstName'] . $data['firstName']. rand(1,999)),0,24);
            $user = User::create([
                'type' => 1,
                'firstName' => $data['firstName'],
                'lastName' => $data['lastName'],
                'country' => $data['country'],
                'postCode' => $data['postCode'],
                'phoneNumber' => $data['phoneNumber'],
                'currency' => $data['currency'],
                'email' => $data['email'],
                'validationToken' => $token,
                'password' => Hash::make($data['password']),
            ]);
            Auth::login($user);
            // Adding a validation code for the user to confirm he's email address

            Mailer::sendConfirmationEmail($data['email'], $data['firstName'], $data['lastName'], $token);
            return response()->json(['status' => 1, 'fname'=>$token, 'url' => url($this->redirectPath())]);
        }else{
            return response()->json(['status' => 0, 'errors' => $validator->errors()->all()]);
        }
    }

}
