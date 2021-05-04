<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cart as CartCheck ;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Sentinel;

class CartCheckController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        

        if(Sentinel::getUser()->inRole('manager')){
            $user=Sentinel::getUser();
            $user->load(['location.zipcodes.users.carts' => function ($q) use ( &$cartcheck ) {
               $cartcheck = $q->get()->unique();
            }]);
         }else{
            $cartcheck = CartCheck::all();
         }
        return view('backEnd.cartcheck.index', compact('cartcheck'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.cartcheck.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        CartCheck::create($request->all());

        Session::flash('message', __('messages.cart_Added'));
        Session::flash('status', 'success');

        return redirect('cartcheck');
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
        $cartcheck = CartCheck::findOrFail($id);

        if (Sentinel::getUser()->inRole('manager') ) {
           $UserManager= ($cartcheck->user->zipCode)?$cartcheck->user->zipCode->location->user : false;
           if($UserManager && ($UserManager->id != Sentinel::getUser()->id )  ){
             Session::flash('message',  __('messages.cart_ups_error'));
             Session::flash('status', 'error');
             return redirect()->back();
          }
        }

        return view('backEnd.cartcheck.show', compact('cartcheck'));
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
        $cartcheck = CartCheck::findOrFail($id);
         $users=User::get()->pluck('email','id');
        return view('backEnd.cartcheck.edit', compact('cartcheck','users'));
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
        
        $cartcheck = CartCheck::findOrFail($id);
        $cartcheck->update($request->all());

        Session::flash('message',  __('messages.cart_updated'));
        Session::flash('status', 'success');

        return redirect('cartcheck');
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
        $cartcheck = CartCheck::findOrFail($id);

        $cartcheck->delete();

        Session::flash('message', __('messages.cart_deleted'));
        Session::flash('status', 'success');

        return redirect('cartcheck');
    }

}
