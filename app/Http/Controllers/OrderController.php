<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Sentinel;

class OrderController extends Controller
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
            $user->load(['location.zipcodes.users.orders' => function ($q) use ( &$order ) {
               $order = $q->get()->unique();
            }]);
         }else{
           $order = Order::all();
         }

        return view('backEnd.order.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        
        Order::create($request->all());

        Session::flash('message', 'Order added!');
        Session::flash('status', 'success');

        return redirect('order');
    }
    public function StatusEnableDesable(Request $request,$id='')
    {
        $order = Order::findOrFail($id);

        if (Sentinel::getUser()->inRole('manager') ) {
           $UserManager= ($order->user->zipCode)?$order->user->zipCode->location->user : false;
           if($UserManager && ($UserManager->id != Sentinel::getUser()->id )  ){
             Session::flash('message',  __('messages.cart_ups_error'));
             Session::flash('status', 'error');
             return redirect()->back();
          }
        }
        
        $order->status=( $order->status < 1)?'1':'0';
        $order->update();
        Session::flash('message',   __('messages.order_marked_as') . $order->status_text);
        Session::flash('status', 'success');
        return redirect()->back();
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
        $order = Order::findOrFail($id);

        if (Sentinel::getUser()->inRole('manager') ) {
           $UserManager= ($order->user->zipCode)?$order->user->zipCode->location->user : false;
           if($UserManager && ($UserManager->id != Sentinel::getUser()->id )  ){
             Session::flash('message', __('messages.cart_ups_error'));
             Session::flash('status', 'error');
             return redirect()->back();
          }
        }

        return view('backEnd.order.show', compact('order'));
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
        $order = Order::findOrFail($id);

        if (Sentinel::getUser()->inRole('manager') ) {
           $UserManager= ($order->user->zipCode)?$order->user->zipCode->location->user : false;
           if($UserManager && ($UserManager->id != Sentinel::getUser()->id )  ){
             Session::flash('message', __('messages.cart_ups_error'));
             Session::flash('status', 'error');
             return redirect()->back();
          }
        }

        return view('backEnd.order.edit', compact('order'));
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
        
        $order = Order::findOrFail($id);

        if (Sentinel::getUser()->inRole('manager') ) {
           $UserManager= ($order->user->zipCode)?$order->user->zipCode->location->user : false;
           if($UserManager && ($UserManager->id != Sentinel::getUser()->id )  ){
             Session::flash('message', __('messages.cart_ups_error'));
             Session::flash('status', 'error');
             return redirect()->back();
          }
        }

        $order->update($request->all());

        Session::flash('message',  __('messages.order_updated'));
        Session::flash('status', 'success');

        return redirect('order');
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
        $order = Order::findOrFail($id);

        if (Sentinel::getUser()->inRole('manager') ) {
           $UserManager= ($order->user->zipCode)?$order->user->zipCode->location->user : false;
           if($UserManager && ($UserManager->id != Sentinel::getUser()->id )  ){
             Session::flash('message',  __('messages.cart_ups_error'));
             Session::flash('status', 'error');
             return redirect()->back();
          }
        }

        $order->delete();

        Session::flash('message',  __('messages.order_deleted'));
        Session::flash('status', 'success');

        return redirect('order');
    }

}
