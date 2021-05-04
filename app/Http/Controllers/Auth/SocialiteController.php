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
use Auth;
use Socialite;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
class SocialiteController extends Controller
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


     /**
     * Redirect the user to the OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.  Check if the user already exists in our
     * database by looking up their provider_id in the database.
     * If the user exists, log them in. Otherwise, create a new user then log them in. After that 
     * redirect them to the authenticated users homepage.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        

        try{
           $user = Socialite::driver($provider)->user();
        } 
        catch(\Exception $x){
             
             Session::flash('message', __('messages.Social_login_error') .$x->getMessage());
             Session::flash('status', 'error');
             return redirect('/'); 
        }
        catch (ThrottlingException $e) {
             $delay = $e->getDelay();
             Session::flash('message', __('messages.temporary_suspended') .' '. $delay .' seconds');
             Session::flash('status', 'error');
             return redirect('/'); 
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Sentinel::authenticate($authUser, true);

        Session::flash('message', __('messages.You_are_logedin'));
        Session::flash('status', 'success');

        if ( $authUser->inRole('admin') || $authUser->inRole('manager')){
                    return redirect('dashboard'); 
         }else{
                   return redirect('my-account'); 
        }
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->orwhere('email', $user->email)->first();
        if ($authUser) {
            return $authUser;
        }

        $password = bcrypt(str_random(10)); 
        $data= [
            'first_name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'password' => $password,
            'provider_id' => $user->id
            ];   
         $user = Sentinel::register($data);
        //Activate the user ** 
         $activation = Activation::create($user);
         $activation = Activation::complete($user, $activation->code);
        //End activation
         if($user){ //add to role
            $user->roles()->sync([2]); // 2 = client
            }
        return $user;
    }
   



}
