<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AppSetting;
use Carbon\Carbon;
class Cart extends Model
{

  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'carts';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','favourite','favourite_name','status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function order()
    {
        return $this->hasOne('App\Order');
    }

    public function product()
    {
        return $this->belongsToMany('App\Product')->withPivot('attribute','quantity')->orderBy('pivot_created_at', 'desc')->withTimestamps();
    }
    public function voucher()
    {
        return $this->belongsToMany('App\Voucher')->withTimestamps();
    }

    public function getVouchere()
    {
       $couponCode=$this->voucher()->first();
       if (!$couponCode) {
             return number_format(0, 2);
       }
       if($couponCode->is_fixed){
         return number_format($couponCode->discount_amount, 2);
        }
       return  number_format(($couponCode->discount_amount / 100) * $this->CartTotal(), 2);
    }

    public function getStatusTextAttribute($value)
    {   
        $value= $this->attributes['status'];
        if ($value == 1) {
           return  __('messages.completed');
        }
        return  __('messages.pending');
    }
    public function getFavouriteAttribute($value)
    {   
       
        if ($value == 1) {
           return  __('messages.yes');
        }
        return  __('messages.no');
    }

    public function CheckifExistAtrtribute($product='',$attribute='')
    {
         $myAdeddProduct=$this->product()->where('product_id', $product)->get();
          foreach ($myAdeddProduct as $key => $product) {
                if ($product->pivot->attribute == $attribute ) {
                   return true;
                }
          }
         return false;
    }


    public function CartTotal($value='')
    {
    	$products = $this->product;
        $total=0;
        foreach($products as $product){

            $total+=$product->ProductAttributePrice($product->pivot->attribute,$product->pivot->quantity) ;
        }
        return  number_format($total, 2);
    }

    public  function GetMinMaxForDate($addselecteddate='')
    {
        // end
        $appsetting = AppSetting::firstOrCreate(['id' => 1]);
        if ($addselecteddate=='') {
           $data=[
              'min'=>false,
              'max'=>false,
              'message'=>__('messages.you_must_add_a_date_to_this_function'),
              'status'=>'error',
              ];
           return  $data;
        }
        $addDate=$addselecteddate;
        $selectedDate=Carbon::createFromFormat('d/m/Y H:i',$addDate);
        $nowDate=Carbon::now('Europe/Berlin');

        if ($selectedDate->format('d/m/Y') < $nowDate->format('d/m/Y')) {
           $data=[
              'min'=>false,
              'max'=>false,
              'message'=>__('messages.We_can_not_take_orders_for_a_past_day'),
              'status'=>'error',
              ];
           return  $data;
        }



        $disabledDays =str_replace("'","",$appsetting->disabled_dates);
        $ArraydisabledDays=explode(',',$disabledDays );
        $ArrayClosedOnWeek=explode(',', $appsetting->closed_weekdays);

        //check if selected day is on holiday list
        if (in_array($selectedDate->format('m/d/Y'), $ArraydisabledDays)){

          $data=[
              'min'=>false,
              'max'=>false,
              'message'=>__('messages.Selcted_date_is_holiday_date_We_are_closed_on').$selectedDate->format('d/m/Y'),
              'status'=>'error',
              ];
           return  $data;
        }
        //end check this date is holiday

        //Check if is selecte as week free day
        if (in_array($selectedDate->dayOfWeek, $ArrayClosedOnWeek)){

          $data=[
                  'min'=>false,
                  'max'=>false,
                  'message'=>__('messages.We_are_not_working_on').$selectedDate->format('d/m/Y'),
                  'status'=>'error',
                  ];
           return  $data;
        }
        //End check if is selected as week free day
        $GetMinMax= $this->getMinumMax($selectedDate);
        if ($selectedDate->format('d/m/Y') == $nowDate->format('d/m/Y')) {

                if (($selectedDate->toTimeString() > $nowDate->toTimeString()) && ($selectedDate->toTimeString() > $GetMinMax['min']) ) {
                   $minTime=($GetMinMax['min'] > $nowDate->toTimeString()) ? $GetMinMax['min'] :$nowDate->toTimeString();
                      $data=[
                              'min'=> date('H:i', strtotime($minTime)),
                              'max'=>date('H:i', strtotime($GetMinMax['max'])),
                              'message'=>__('messages.All_right_we_can_ake_your_order_for_today_at').$minTime,
                              'status'=>'success',
                              ];
                       return  $data;
                }
                 $minTime=($GetMinMax['min'] > $nowDate->toTimeString()) ? $GetMinMax['min'] :$nowDate->toTimeString();
                $data=[
                      'min'=> date('H:i', strtotime($minTime)),
                      'max'=>date('H:i', strtotime($GetMinMax['max'] )),
                      'message'=>__('messages.We_can_only_take_orders_for_you_today_after').$minTime,
                      'status'=>'error',
                      ];
                return  $data;

        }

        $data=[
              'min'=>date('H:i', strtotime($GetMinMax['min'])),
              'max'=>date('H:i', strtotime($GetMinMax['max'])),
              'message'=>__('messages.We_can_take_orders_for_you_at').$selectedDate,
              'status'=>'success',
              ];

        return  $data;
    }
    public function getMinumMax($selectedDate='')
    {
        $app = AppSetting::firstOrCreate(['id' => 1]);

        $day=$selectedDate->dayOfWeek;
           switch ($day) {
            case 0:
                $data=['min'=>$app->sun_start,'max'=>$app->sun_end];
                return $data;
                break;
            case 1:
                $data=['min'=>$app->mon_start,'max'=>$app->mon_end];
                return $data;
                break;
            case 2:
                $data=['min'=>$app->tue_start,'max'=>$app->tue_end];
                return $data;
                break;
            case 3:
                 $data=['min'=>$app->wed_start,'max'=>$app->wed_end];
                return $data;
                break;
            case 4:
                $data=['min'=>$app->thu_start,'max'=>$app->thu_end];
                return $data;
                break;
            case 5:
                $data=['min'=>$app->fri_start,'max'=>$app->fri_end];
                return $data;
                break;
            case 6:
                $data=['min'=>$app->sat_start,'max'=>$app->sat_end];
                return $data;
                break;
        }
    }
}
