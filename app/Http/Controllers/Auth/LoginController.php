<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Sentinel;
use Illuminate\Http\Request;
use Activation;
use Redirect;
use Session;
use Illuminate\Support\Facades\Input;
use Mail;
use Carbon\Carbon;
use Mailchimp;
use App\zipCode;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   use  ThrottlesLogins;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    protected function login(Request $request)
    {


        try {

            // Validation
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validation->fails()) {
                return redirect()->route('login')->withErrors($validation)->withInput();
            }
            $remember = (Input::get('remember') == 'on') ? true : false;
            if ($user = Sentinel::authenticate($request->all(), $remember)) {
                
                if ($user->inRole('admin') || $user->inRole('manager') ){
                    return redirect('dashboard'); 
                }else{
                   return redirect('my-account'); 
                }
                
            }
            Session::flash('message',__('messages.invalid_password_or_user'));
           Session::flash('status', 'error');

            return redirect()->route('login')->withErrors(['global' => __('messages.invalid_password_or_user') ]);

        } catch (NotActivatedException $e) {
             Session::flash('message', 'This user is not activated');
           Session::flash('status', 'error');
            return redirect()->route('login')->withErrors(['global' => __('messages.not_Activated'),'activate_contact'=>1]);

        }
        catch (ThrottlingException $e) {
            $delay = $e->getDelay();
             Session::flash('message', 'You are temporary susspended' .' '. $delay .' seconds');
           Session::flash('status', 'error');
            return redirect()->route('login')->withErrors(['global' => __('messages.temporary_suspended') .' '. $delay .' seconds','activate_contact'=>1]);
        }

       return redirect()->route('login')->withErrors(['global' =>  __('messages.serios_error')]);

        
    }
    

    protected function logout()
    {
        Sentinel::logout();
        return redirect('/');
    }
    protected function activate($id){
        $user = Sentinel::findById($id);

        $activation = Activation::create($user);
        $activation = Activation::complete($user, $activation->code);
        Session::flash('message', trans('messages.activation'));
        Session::flash('status', 'success');
        return redirect('login');
    }

}
