<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Redirect;
use Validator;
use Session;
use Image;
use URL;
use Hash;
use App\zipCode;
use App\Order;
class MyAccountController extends Controller
{ 
   public function __construct()
    {
      //$this->middleware('auth')->except('orders');
       $this->middleware('auth');
    }

    public function MyAccountIndex($value='')
    {
    	  $user=Sentinel::getUser();

        $zipcodes=zipCode::get()->pluck('name','id');
    	  return view('frontEnd.myaccount.index',compact('user','zipcodes'));
    }

    public function MyfavouriteProducts($value='')
    {
       $user=Sentinel::getUser();

       return view('frontEnd.myaccount.favourite',compact('user'));
    }

    public function MyOrdersProducts($value='')
    {
        $user=Sentinel::getUser();
        $myorder = Order::where('user_id',Sentinel::getUser()->id)->orderBy('created_at', 'desc')->get();
        
        return view('frontEnd.myaccount.myorders',compact('user','myorder'));
    }

    public function AttachDettachMyfavouriteProducts(Request $request)
    {
        $user=Sentinel::getUser();

        $checkifatached = $user->favourite()->where('id', $request->productId)->exists();
        if ($checkifatached) {
          $user->favourite()->detach($request->productId);
          $message=__('messages.remove_from_favourite_success');
          $type='detach';
        }else{
           $user->favourite()->attach($request->productId);
           $message=__('messages.add_from_favourite_success');
           $type='attach';
        }
        
        return response()->json(['success' => true, 'status' => $message,'type'=>$type]);
    }
    public function MyAccountUpdate(Request $request)
    {
        
        $validation = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'string|max:255',
                'address' => 'required|string|max:255',
                'ort' => 'required|string|max:255',
                'plz' => 'required|numeric',
                'phone_number' => 'required|numeric',
                'email' => Sentinel::inRole('Admin')?'required|email|min:3|max:50|string':(Sentinel::check()?'required|email|min:3|max:50|string|unique:users,email,'.Sentinel::getUser()->id:'required|email|min:3|max:50|unique:users|string'),
            ]);

          if ($validation->fails()) {
                return redirect()->action('MyAccountController@MyAccountIndex')->withErrors($validation)->withInput();
          }
        $user=Sentinel::getUser();
        if ($user) {

              if($request->first_name){
              $user->first_name=$request->first_name;
              }
              if($request->last_name){
              $user->last_name=$request->last_name;
              }
              if($request->email){
              $user->email=$request->email;
              }
              if($request->address){
              $user->address=$request->address;
              }
              if($request->ort){
              $user->ort=$request->ort;
              }
              if($request->plz){
              $user->plz=$request->plz;
              }
              if($request->phone_number){
              $user->phone_number=$request->phone_number;
              }
              if($request->image_64){
              $fileName = $this->uploadFileBas64Thumbnail($request->image_64 , 200, 200);;
              $user->avatar=$fileName;
              $user->path='/upload/avatar/';
              }
              $user->update();
            
            Session::flash('message', __('messages.update_Account_success'));
            Session::flash('status', 'success');
            
        } 


      return redirect()->back();
    }
    public function MyAccountUpdatePassword(Request $request){

         Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {

                return Hash::check($value, current($parameters));

             });
        
            $validation = Validator::make($request->all(), [
                  'password' => 'required|string|min:6|confirmed',
                  'old_password' => 'required|old_password:' .Sentinel::getUser()->password
              ]);

            if ($validation->fails()) {
                  return Redirect::back()->withErrors($validation)->withInput();
            }
           $user=Sentinel::getUser();
           if($request->password){
                $user->password=bcrypt($request->password);
           }
           $user->update();
              
            Session::flash('message',  __('messages.update_password_success'));
            Session::flash('status', 'success');
          return redirect()->back();
    }

    
    function uploadFileBas64Thumbnail($file, $width, $height){

      if(!empty($file)) {
        $destinationPath = public_path() . '/upload/avatar/';

        $file = str_replace('data:image/png;base64,', '', $file);
        $img = str_replace(' ', '+', $file);
        $data = base64_decode($img);
        $filename = Sentinel::getUser()->id.'_avatar' . ".png";
        $file = $destinationPath . $filename;
        $success = file_put_contents($file, $data);

        // THEN RESIZE IT
        $returnData = $destinationPath.$filename;
        $thumb300 = Image::make($returnData)->resize($width,$height);
        $thumb300->save($returnData, 90);

        if($success){
        return $filename;
        }      
      }    
    }


}
