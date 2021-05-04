<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Redirect;
use Sentinel;
use Session;
use Activation;
use App\zipCode;
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    
    public function showRegistrationForm()
    {   
        $zipcodes=zipCode::get()->pluck('name','id');
        return view('auth.register',compact('zipcodes'));
    }

    public function register(Request $request){

        $validation = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'ort' => 'required|string|max:255',
                'plz' => 'required|numeric',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

          if ($validation->fails()) {
                return Redirect::back()->withErrors($validation)->withInput();
         }

        $user = Sentinel::register($request->all());
        //Activate the user ** 
         $activation = Activation::create($user);
         $activation = Activation::complete($user, $activation->code);
        //End activation

        if($user){

            $user->roles()->sync([2]); // 2 = client
            Session::flash('message',  __('messages.register_success'));
            Session::flash('status', 'success');
            return redirect('login'); 
        }
         Session::flash('message', __('messages.register_error') );
         Session::flash('status', 'error');
         return Redirect::back();
    }



}
