<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Cart;
use Sentinel;

class Product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'category_id', 'description', 'image', 'path'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function attribute()
    {
        return $this->belongsToMany('App\Attribute', 'attribute_product','product_id', 'attribute_id')->withPivot('price');
    }

    public function cart()
    {
        return $this->belongsToMany('App\Cart','cart_product','product_id', 'cart_id')->withPivot('attribute','quantity')->orderBy('pivot_created_at', 'desc');
    }
    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
    public function isfavouriteByUsers()
    {
        return $this->belongsToMany('App\User');
    }
    public function ProductAttributePrice($attribute=false,$quantity=1)
    {
        if ($attribute) {
            $priceforONe= $this->attribute()->where('attribute_id', $attribute)->first();
            return number_format($quantity*$priceforONe->pivot->price , 2);
        }
        return false;
    }
    public function ProductAttributeName($attribute=false)
    {
        if ($attribute) {
            $priceforONe= $this->attribute()->where('attribute_id', $attribute)->first();
            return $priceforONe->name;
        }
        return false;
    }
    public function ProductAttributePriceOne($attribute=false)
    {
        if ($attribute) {
            $priceforONe= $this->attribute()->where('attribute_id', $attribute)->first();
            
            return number_format($priceforONe->pivot->price , 2);
        }
        return false;
    }

    public function CheckIfProductIsOnCurrentCart($attribute='')
    {
         
         try { $cart = Cart::where('user_id',Sentinel::getUser()->id)->where('favourite',0)->where('status',0)->first(); } catch(\Exception $x) {   return false;}
         if ($cart) {
               $myAdeddProduct=$cart->product()->where('product_id', $this->id)->get();
              foreach ($myAdeddProduct as $key => $product) {
                    if ($product->pivot->attribute == $attribute ) {
                       return true;
                    }
              }
             return false;

         }
         return false;
    }

}
