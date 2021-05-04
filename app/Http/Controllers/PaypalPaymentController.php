<?php


namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Sentinel;
use App\User;
use Session;
use Redirect;
use Input;
use Carbon\Carbon;
use App\AppSetting;
use App\Transaction as OrderTransaction;
use App\Cart;
use App\Order;
use Mail;
use Log;
use DB;
use PDF;
use App\Mail\OrderConfirmedEmail;
use App\Notifications\NewOrderNotifyLocation;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\PayerInfo;

class PaypalPaymentController extends HomeController
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // parent::__construct();

        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {

      $data=array(
          'address' => Sentinel::getUser()->address,
          'ort' => Sentinel::getUser()->ort,
          'zipcode' => (Sentinel::getuser()->zipcode)?Sentinel::getuser()->zipcode->name:'',
          'phone_number' => Sentinel::getUser()->phone_number,
          'cart_id' => $request->cart_id,
          'date' => $request->date,
           );

       $validator = Validator::make($data, [
            'address' => 'required|min:2|max:255',
            'ort' => 'required|min:2|max:255',
            'zipcode' => 'required|min:2|max:255',
            'phone_number' => 'required|min:2|max:255',
            'cart_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
                    $data['message'] = null;
                    $errorMesssages = $validator->errors()->all();
                    foreach($errorMesssages as $error){
                        $data['message'] .=  __('messages.eror_on_check'). addslashes($error) . '<br />';
                    }
                 Session::flash('message', $data['message']);
                 Session::flash('status', 'error');
                 return redirect('cart');
        }

      $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->where('id',$request->cart_id)->first();

      if (!$cart) {
           Session::flash('message',  __('messages.cart_does_not_Exist'));
                 Session::flash('status', 'error');
                 return redirect('cart');
      }

        //Check if date is allowed for order
	    $dateValid = $cart->GetMinMaxForDate($request->date);
	    if ($dateValid['status'] =='error') {
	    		 Session::flash('message',  $dateValid['message']);
                 Session::flash('status', 'error');
                 return redirect('cart');
	    }
        // end date check

      	if ($request->paymentMethod !='paypal') {
      		 $updateOrder= $this->PaymentMethod($request->cart_id,$request->date,$request->paymentMethod);
      		  Session::flash('message',  $updateOrder['message']);
            Session::flash('status', $updateOrder['status']);

            //Update coupon code
            $voucher= $cart->voucher()->first();
            if ($voucher) {
                 Sentinel::getUser()->voucher()->attach($voucher->id);
                 $voucher->increment('uses');
            }
            return redirect('cart');

      	}
        $i =0;
        foreach ($cart->product as  $product) {

            $items[$i] = new Item();
            $items[$i]->setName('Name: '.$product->name. ' Type: '. $product->ProductAttributeName($product->pivot->attribute))
                        ->setCurrency('EUR')
                        ->setQuantity($product->pivot->quantity)
                        ->setSku("SKU-".$cart->id."-".$product->id."-".$product->pivot->attribute) // Similar to `item_number` in Classic API
                        ->setPrice($product->ProductAttributePrice($product->pivot->attribute,$product->pivot->quantity));
            $i++;
        }

        $totalPrice=$cart->CartTotal();
        //Check if this cart have a vouchare code included
        if ($cart->getVouchere() !='0.00') {
          $voucher= $cart->voucher()->first();
            $items[$i] = new Item();
            $items[$i]->setName('Vochare')
                        ->setCurrency('EUR')
                        ->setQuantity(1)
                        ->setSku("SKU-".$cart->id.'-'.$voucher->code) // Similar to `item_number` in Classic API
                        ->setPrice(-$cart->getVouchere());
           $totalPrice= $totalPrice-$cart->getVouchere();
          Session::put('voucher-code', $voucher );
        }
        //End check
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $itemList = new ItemList();
        $itemList->setItems($items);
        //Calculate the tax
        $appsetting = AppSetting::firstOrCreate(['id' => 1]);

        $new_tax = ($appsetting->tax / 100) * $cart->CartTotal();
        $totaltax= number_format($new_tax, 2);
        $details = new Details();
        $details->setTax($totaltax)
                ->setSubtotal($totalPrice); //->setShippingDiscount(2)  stho  ne setTotal( -2)

        $amount = new Amount();
        $amount->setCurrency('EUR')
               ->setTotal( $totalPrice+$totaltax)
               ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Pizza Days Order');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('paypal')) /** Specify return URL **/
            ->setCancelUrl(url('paypal'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


       // return $payment;
            /** dd($payment->create($this->_api_context));exit; **/
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                 Session::flash('message',  __('messages.payment_time_out') .$ex->getMessage());
                 Session::flash('status', 'error');
                 return redirect('cart');                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                 Session::flash('message',__('messages.payment_some_error_accured'));
                 Session::flash('status', 'error');
                 return redirect('cart');                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }
        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        Session::put('paypal_cart_id', $cart->id);
        Session::put('delivery_time',$request->date);
        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
         Session::flash('message',  __('messages.payment_some_error_accured_admin_re'));
         Session::flash('status', 'error');
         return redirect('cart');

     }
    public function getPaymentStatus(Request $request)
    {

        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $cart_id = Session::get('paypal_cart_id');
        $delivery_time = Session::get('delivery_time');
        $code_vochare = Session::get('voucher-code');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        Session::forget('paypal_cart_id');
        Session::forget('delivery_time');
        Session::forget('voucher-code');
        if (empty(Input::get('PayerID')) || empty(Input::get('token')) ) {

                Session::flash('message', __('messages.payment_not_completed'));
                Session::flash('status', 'error');
                return redirect('cart');

        }


        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);


        // dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') {

            $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->where('id',$cart_id)->first();


             if ($code_vochare) {
               Sentinel::getUser()->voucher()->attach($code_vochare->id);
               $code_vochare->increment('uses');
             }

            $transactions = $result->getTransactions();
            $resources = $transactions[0]->getRelatedResources();

            $sale = $resources[0]->getSale();
            $transactionID = $sale->getId();

            $total= $payment->transactions[0]->amount->total;
            $selectedDate=Carbon::createFromFormat('d/m/Y H:i',$delivery_time);
            //Store Order
    	 	    $order= new Order;
            $order->cart_id=$cart_id;
            $order->user_id=Sentinel::getUser()->id;
            $order->method='paypal';
            $order->total=number_format($total, 2);
            $order->status=1;
            $order->date_delivery=$selectedDate->format('Y-m-d H:i');
            $order->save();
            //End Order Store

            if ($cart) {
            	$cart->status=1;
                $cart->update();
            }

            //Trasnaction Store
            $transaction = new OrderTransaction;
            $transaction->cart_id=$cart_id;
            $transaction->method='paypal';
            $transaction->transaction_id=($transactionID)?$transactionID:null;
            $transaction->save();
            //End transaction store

            //Generate Invoice

            $invoiceName= $this->GenerateInvocie($cart_id,$order);

            $data = [
                     "name"=>Sentinel::getUser()->first_name .' ' .Sentinel::getUser()->last_name,
                     "invoiceName"=>$invoiceName,
                     "email"=>Sentinel::getUser()->email,
                 ];
             $this->SendThanksEmail($data);
            //End ivoice generate

            Session::flash('message',__('messages.payment_completed'));
            Session::flash('status', 'success');
            Session::flash('type', 'thanks');

            //Send notification To LOCATION MANAGER

              $manager= Sentinel::getUser()->zipCode->location->manager();
              $manager->notify(new NewOrderNotifyLocation($order));

            //end send notification To LOCATION MANAGER


            return redirect('cart');
        }


          Session::flash('message', __('messages.payment_some_error_accured_admin_re'));
          Session::flash('status', 'error');
          return redirect('cart');

    }

    public function PaymentMethod($cart_id='',$date='',$method='')
    {
    	    $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->where('id',$cart_id)->first();
    	    $appsetting = AppSetting::firstOrCreate(['id' => 1]);
    	    $selectedDate=Carbon::createFromFormat('d/m/Y H:i',$date);
    	    $totalPrice=$cart->CartTotal();
            $new_tax = ($appsetting->tax / 100) * $totalPrice;
            //Store Order

    	    	$order= new Order;
            $order->cart_id=$cart_id;
            $order->user_id=Sentinel::getUser()->id;
            $order->method=$method;
            $order->total=number_format($totalPrice+$new_tax, 2);
            $order->status=0;
            $order->date_delivery=$selectedDate->format('Y-m-d H:i');

            $order->save();
            //End Order Store
            //Update Cart
            if ($cart) {
            	$cart->status=1;
                $cart->update();
            }
            //end Update cart
            //Generate Invoice

          $invoiceName= $this->GenerateInvocie($cart_id,$order);

          $data = [
                   "name"=>Sentinel::getUser()->first_name .' ' .Sentinel::getUser()->last_name,
                   "invoiceName"=>$invoiceName,
                   "email"=>Sentinel::getUser()->email,
               ];
           $this->SendThanksEmail($data);
          //End ivoice generate

          //Send notification To LOCATION MANAGER

          $manager= Sentinel::getUser()->zipCode->location->manager();
          $manager->notify(new NewOrderNotifyLocation($order));

          //end send notification To LOCATION MANAGER


    	 	$data=[
                'message'=>__('messages.order_is_stored_on_db'),
                'status'=>'success',
              ];
           return  $data;
    }

     public function getHtmlInvoice($cart_id='', $order='')
    {

        $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('id',$cart_id)->first();

       return view('vendor.invoice.paypalPaid',compact('cart','order'));
    }
    public function GenerateInvocie($cart_id='', $order=''){

    	 //    $cart_id=6;
    		// $transaction = new OrderTransaction;
		    // $transaction->cart_id = 6;
		    // $transaction->method = 'paypal';
		    // $transaction->transaction_id = '8X261516LH067583X';
		    // $transaction->id = 2;

          $pdf_name='INV-'.Sentinel::getUser()->id.'-'.$order->id;
          $html = $this->getHtmlInvoice($cart_id,$order);
          PDF::loadHTML($html)->setPaper('a4')->setWarnings(false)->save(public_path().'/upload/invoice/'.$pdf_name.'.pdf');
          return   $pdf_name;
    }

    public function SendThanksEmail($data){

	    	 $content = [
			    		'title'=> 'Here is your Invoice generated ',
			    		'body'=> 'The content from your',
			    		'button' => 'Check your Invoice',
			    		'invoice' => $data['invoiceName']
			    		];

	    	 $receiverAddress = $data['email'];

	    	 Mail::to($receiverAddress)->send(new OrderConfirmedEmail($content));

    }

   }
