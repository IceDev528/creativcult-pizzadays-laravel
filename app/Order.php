<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'method', 'total', 'status','date_delivery'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function cart()
    {
        return $this->belongsTo('App\Cart','cart_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function getStatusTextAttribute($value)
    {   
        $value= $this->attributes['status'];
       if ($value == 1) {
           return  __('messages.completed');
        }
        return  __('messages.pending');
    }
     public function getMethodAttribute($value)
    {   
       
       if ($value == 'at_pizzadays') {
           return  __('invoice.at_pizzadays');
        }elseif ($value == 'paypal') {
            return  __('invoice.paypal');
        }elseif ($value == 'in_hand') {
            return  __('invoice.in_hand');
        }
        return   $value;
    }

}
