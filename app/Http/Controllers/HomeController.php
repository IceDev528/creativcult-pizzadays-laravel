<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use Datatables;
use App\User;
use App\Order;
use DB;
use Carbon\Carbon;
use App\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontEnd.homepage');
    }

    public function dashboard()
    {

        if(Sentinel::getUser()->inRole('manager')){
            
           
            $user=Sentinel::getUser();


            $user->load(['location.zipcodes.users' => function ($q) use ( &$users ) {
               $users = $q->get()->unique();
            }]);

            $user->load(['location.zipcodes.users.carts' => function ($q) use ( &$cartcheck ) {
               $cartcheck = $q->whereDay('created_at', date('d'))->get()->unique();
            }]);

             $user->load(['location.zipcodes.users.orders' => function ($q) use ( &$order ) {
               $order = $q->whereDay('date_delivery', date('d'))->get()->unique();
            }]);
             $user->load(['location.zipcodes.users.orders' => function ($q) use ( &$orderAll ) {
               $orderAll = $q->get()->unique();
            }]);

            $totalUsers= $users->count();
            $totalProducts = Product::all()->count();
            $todayCountCarts= $cartcheck->count();
            $todayCountOrders= $order->count();
            $todaySumvalue= $order->sum('total');
            $ordersSumvalue= $orderAll->sum('total');
            return view('backEnd.dashboard.dashboardLocation',compact('totalUsers','totalProducts','todayCountCarts','todayCountOrders','todaySumvalue','ordersSumvalue'));
        }
         if(Sentinel::getUser()->inRole('cashier')){
            return view('backEnd.dashboard.dashboardCashier');
         }

        return view('backEnd.dashboard.dashboardAdmin');
    }

    public function OrderStatistics(Request $request,$value='')
    {

        $startDate=$request->startDate;
        $endDate=$request->endDate;
         // If user In role manager

        if(Sentinel::getUser()->inRole('manager')){
           
            $user=Sentinel::getUser();
            //Get all Orders
            $user->load(['location.zipcodes.users.orders' => function ($q) use ( &$order ) {

               $order = $q->get()->unique();
            }]);
            //Add To array all Ids
            $orderArray= $order->pluck('id');


            $allOrder = Order::whereIn('orders.id', $orderArray)
                        ->leftjoin('users', 'orders.user_id', '=', 'users.id')
                         ->where(function ($query) use ($request,$startDate,$endDate)  {
                                if (isset($request->methode)) {
                                    $query->where('orders.method', 'like', '%'.$request->methode.'%');
                                }
                                if ( isset($request->email)) {
                                    $query->where('users.email', 'like', '%'.$request->email.'%');
                                }
                                if (isset($request->name)) {
                                    $query->where('users.first_name', 'like', '%'.$request->name.'%');
                                    $query->orwhere('users.last_name', 'like', '%'.$request->name.'%');
                                }
                            })
                        ->select([
                            'orders.id',
                            'users.first_name',
                            'users.last_name',
                            DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name'),
                            'users.email',
                            'user_id',
                            'method',
                            'total',
                            'status',
                            'date_delivery'
                        ]);
            }
          
            //Add To filter
            $orders= Datatables::of($allOrder)
                    ->filter(function ($allOrder) use ($request,$startDate,$endDate) {

                        if ($startDate) {
                           $startDate=Carbon::createFromFormat('Y-m-d',$startDate);
                           $startDate=$startDate->startOfDay();

                           $allOrder->where('date_delivery','>=',$startDate);
                        }
                        if ($endDate) {
                           $endDate=Carbon::createFromFormat('Y-m-d',$endDate);
                           $endDate=$endDate->endOfDay();

                           $allOrder->where('date_delivery','<=',$endDate);
                        }
                    })
                     ->addColumn('status_text', function ($order) {
                        return $order->status_text;
                    });


            return $orders->with('total', $allOrder->sum('total'))->make(true);
        

    }

    public function OrderTodayToDoOrders(Request $request,$value='')
    {
      if(Sentinel::getUser()->inRole('manager')){
            $user=Sentinel::getUser();
            $user->load(['location.zipcodes.users.orders' => function ($q) use ( &$order ) {
               $order = $q->where('date_delivery','>=',Carbon::now('Europe/Berlin'))->with('cart.product')->orderBy('date_delivery','asc')->get()->unique();
            }]);
         }else{
           $order = Order::where('date_delivery','>=',Carbon::now('Europe/Berlin'))->with('cart.product')->orderBy('date_delivery','asc')->get();
         }

       return response()->json(['success' => true, 'orders' => $order]);
    }
}
