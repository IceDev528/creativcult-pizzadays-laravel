<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\CartItem;
use Sentinel;
use Session;
use Illuminate\View\View;
use App\zipCode;
use Carbon\Carbon;
class CartController extends Controller
{
    public function __construct()
    {
      //$this->middleware('auth')->except('orders');
       $this->middleware('auth');
    }

    public function index(){
         $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->first();

        // if(!$cart){
        //     $cart =  new Cart();
        //     $cart->user_id=Sentinel::getUser()->id;
        //     $cart->save();
        // }
        $zipcodes=zipCode::get()->pluck('name','id');
        
        return view('frontEnd.cart.index',compact('cart','zipcodes'));
    }


    public function shareCart(View $view,$value='')
    {
        $total='0.00';
        if (Sentinel::guest()) {
           $view->with('MyCartTotal',  '0.00');
        }else{

          try {
                $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->first();
                if ( $cart) {
                   $total=$cart->CartTotal();
                }
              } catch(\Exception $x) {

              }

          $view->with('MyCartTotal',  $total);
        }
    }
    public function AllowedMinMaxDate(Request $request)
    {

        $addDate=$request->SelectedDate;
        if (!$addDate) {
         $data=[
              'min'=>false,
              'max'=>false,
              'message'=>__('messages.you_must_add_a_date_to_this_function'),
              'status'=>'error',
              ];
           return  $data;
        }
        $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->first();
        return $cart->GetMinMaxForDate($addDate);
    }


     public function addItem (Request $request){

        $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->first();

        if(!$cart){
            $cart =  new Cart();
            $cart->user_id=Sentinel::getUser()->id;
            $cart->save();
        }

       $exists = $cart->product->contains($request->product_id);
       //check if product and attribute is actually on cart
       if ($exists && $cart->CheckifExistAtrtribute($request->product_id,$request->attribute_id) ) {

         $message=__('messages.Your_product_is_now_already_on_your_cart');
          if($request->ajax()){
                return response()->json(['success' => false, 'message' => $message]);
          }
          return redirect('/cart');
       }

        $cart->product()->attach([$request->product_id => ['attribute'=>$request->attribute_id,'quantity'=>1] ] );

        $message=__('messages.This_product_is_sucesfully_added_to_your_cart');
        $updatedCart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->first();
        if($request->ajax()){
                 $cartTotal=$updatedCart->CartTotal();
               return response()->json(['success' => true, 'message' => $message,'cartTotal'=>$cartTotal]);
         }

        return redirect('/cart');

    }


    public function removeItem(Request $request,$id){

        $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->where('id',$id)->first();

        $cart->product()->where('id', $request->product)->wherePivot('attribute', $request->attribute)->detach($request->product);

        Session::flash('message', __('messages.This_product_is_sucessfully_deleted'));
        Session::flash('status', 'success');

        return redirect('cart');
    }
    public function updateItem(Request $request,$id)
    {
        $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->where('id',$id)->first();
        //Remove
        $cart->product()->where('id', $request->product)->wherePivot('attribute', $request->attribute)->detach($request->product);
        //Add New
        $cart->product()->attach([$request->product => ['attribute'=>$request->attribute,'quantity'=>$request->quantity] ] );
        Session::flash('message', __('messages.This_product_is_sucessfully_updated'));
        Session::flash('status', 'success');

        return redirect('cart');
    }


}
