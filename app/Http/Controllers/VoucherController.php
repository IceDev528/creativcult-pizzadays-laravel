<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Voucher;
use App\Location;
use App\zipCode;
use App\User;
use App\Cart;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Sentinel;
use DB;
class VoucherController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $voucher = Voucher::all();

        return view('backEnd.voucher.index', compact('voucher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $locations=Location::get()->pluck('name','id');
        $zipcodes=zipCode::get()->pluck('name','id');
        $users = User::get()->pluck('email','id');
        return view('backEnd.voucher.create',compact('locations','zipcodes','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Voucher::create($request->all());

        Session::flash('message', 'Voucher added!');
        Session::flash('status', 'success');

        return redirect('voucher');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $voucher = Voucher::findOrFail($id);

        return view('backEnd.voucher.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $voucher = Voucher::findOrFail($id);
        $locations=Location::get()->pluck('name','id');
        $zipcodes=zipCode::get()->pluck('name','id');
        $users = User::get()->pluck('email','id');
        return view('backEnd.voucher.edit', compact('voucher','locations','zipcodes','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        
        $voucher = Voucher::findOrFail($id);
        $voucher->code=$this->uniquesCoupone($request->code,$voucher->id);
        $voucher->name=$request->name;
        $voucher->description=$request->description;
        $voucher->max_uses=$request->max_uses;
        $voucher->max_uses_user=$request->max_uses_user;
        $voucher->discount_amount=$request->discount_amount;
        $voucher->is_fixed=$request->is_fixed;
        $voucher->starts_at=$request->starts_at;
        $voucher->expires_at=$request->expires_at;
        if ($request->voucher_type) {
            if ($request->voucher_type =='location') {
               $voucher->location_id=$request->location_id;
               //Hide this
               $voucher->zip_code_id=null;
               $voucher->user_id=null;

            }elseif ($request->voucher_type =='zip_code') {
                $voucher->zip_code_id=$request->zip_code_id;
                //Hide this
               $voucher->location_id=null;
               $voucher->user_id=null;

            }elseif ($request->voucher_type =='single_user') {
                $voucher->user_id=$request->user_id;
                //Hide this
               $voucher->location_id=null;
               $voucher->zip_code_id=null;

            }
            $voucher->voucher_type=$request->voucher_type;
        }else{
            Session::flash('message', 'error select the vuchare type');
            Session::flash('status', 'error');

            return redirect()->back();
        }

       
        
              
        $voucher->update();

        Session::flash('message', 'Voucher updated!');
        Session::flash('status', 'success');

        return redirect('voucher');
    }
    public function uniquesCoupone($code='',$notIn=false)
    {
        $check='';
        if($code){
            do
            {
                
                $ThisCode =$code.$check;
                if ($notIn) {
                  $Voucher = Voucher::where('code', $ThisCode)->whereNotIn('id',[$notIn])->get();
                }else{
                    $Voucher = Voucher::where('code', $ThisCode)->get();
                }
                
                $check++; 
            }
            while(!$Voucher->isEmpty());

            return $ThisCode;
        }

        return false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $voucher = Voucher::findOrFail($id);
        $voucher->delete();
        Session::flash('message', 'Voucher deleted!');
        Session::flash('status', 'success');

        return redirect('voucher');
    }

    public function VouchereApplyNow(Request $request)
    {
        //Check if field is completed
            if (!$request->coupon || $request->coupon=='' ) {
                    Session::flash('message', 'Please add a coupon code');
                    Session::flash('status', 'error');
                    return redirect()->back();
            }
        //end field check

        //Check if this code is on DB
            $voucher = Voucher::where('code',$request->coupon)->first();
            if (!$voucher) {
                Session::flash('message', 'There is no coupon code like: '.$request->coupon );
                Session::flash('status', 'error');
                return redirect()->back()->with('coupon', $request->coupon);
            }
        //End db check
       $vucherStart= $voucher->starts_at; //get start coupon time date
       $vucherEnd= $voucher->expires_at;    //get end coupon time date

       $NowDate=Carbon::now()->format('d/m/Y H:i');
        
        //Check if coupon is valid 
        if (!($vucherStart <= $NowDate && $vucherEnd >=  $NowDate)) {
         
          Session::flash('message', 'Error this vouchare Started on  : '.$vucherStart.' now Date is:'.$NowDate.' and it will end on : '.$vucherEnd);
          Session::flash('status', 'error');
          return redirect()->back()->with('coupon', $request->coupon);

        }
        //Check if this coupon is valid
        //Are there more time to user this ?
        if ($voucher->max_uses <= $voucher->uses) {
             Session::flash('message', 'We are sorry this coupon code is no more active  it is used by more than. '.$voucher->max_uses .' times');
            Session::flash('status', 'error');
           return redirect()->back()->with('coupon', $request->coupon);
        }
        //End check 
        $canIUse= $this->CanIUseThisCoupon($voucher);

        if (!$canIUse['status']) {
             Session::flash('message', $canIUse['message']);
             Session::flash('status', 'error');
             return redirect()->back()->with('coupon', $request->coupon);
        }
        //Check Cart 
         $user=Sentinel::getUser();
        // $count=$voucher->user($user->id)->count();
      
        $count = DB::table('user_voucher')->where('user_id',$user->id)->where('voucher_id',$voucher->id)->count();
        if ($voucher->max_uses_user <= $count) {
            Session::flash('message', 'Sorry you have used this coupon code before, you canot use it more than'.$voucher->max_uses_user .' times');
            Session::flash('status', 'error');
            return redirect()->back()->with('coupon', $request->coupon);
        }
       
       //Add this when you complete the  : $user->voucher()->attach($voucher->id);

        //Sync cart coupon code
        $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->first();
        $cart->voucher()->sync($voucher->id);
        //End sync Coupon Code
        
        Session::flash('message', 'Your coupon code is sucefully added to your cart');
        Session::flash('status', 'success');
        return redirect()->back()->with(['coupon'=>$request->coupon,'coupon_staus'=>true]);
        
            
    }

    public function CanIUseThisCoupon($voucher='')
    {
        $user=Sentinel::getUser();

        $can_I=['status'=>false,'message'=>'Something went wrong you can not use this code'];
        switch ($voucher->voucher_type) {
            case 'all_users':
                  $can_I=['status'=>true,'message'=>''];
                break;
            case 'location':
                    $can_I=['status'=>false,'message'=>'You must be on the location: '.$voucher->location->name];
                   if ($user->zipcode->location->id == $voucher->location_id) {
                      $can_I=['status'=>true,'message'=>''];
                   }
                break;
            case 'zip_code':
                     $can_I=['status'=>false,'message'=>'You must be on the zip Code: '.$voucher->zipcode->name];
                   if ($user->zipcode->id == $voucher->zip_code_id) {
                        $can_I=['status'=>true,'message'=>''];
                   }
                break;
            case 'single_user':
                $can_I=['status'=>false,'message'=>'This is a personal coupon code you must be the account owner to use this'];
                if ($user->id == $voucher->user_id) {
                       $can_I=['status'=>true,'message'=>''];
                }
                break;
            default:
               $can_I=['status'=>true,'message'=>'Something is wrong you can not use this code please contact administrator'];
                break;
        }
        return  $can_I ;
    }
    public function VouchereRemoveCouponCode($cart_id='',$code_id='')
    {
        if($cart_id && $code_id ){
         $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->where('id',$cart_id)->first();
         $cart->voucher()->detach($code_id);
         Session::flash('message', 'Your coupon code is now removed from your cart');
         Session::flash('status', 'success');
         return redirect()->back();
        }
         return redirect()->back();
    }

}
